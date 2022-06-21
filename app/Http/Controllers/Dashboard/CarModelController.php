<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{CarModel , Brand};
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\CarModel\{CarModelRequest};
use App\Http\Resources\Dashboard\CarModel\{CarModelResource};

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
           $query = CarModel::latest();
           $car_model_count = $query->count();
           $car_model_side_cols = [
               'id','name','brand_id','cars_count','created_at'
           ];
           if (request()->ajax()) {
               $keyword = $request->search['value'];
               $car_models = $query->when($keyword,function($q)use($keyword){
                   $q->where(function($q)use($keyword){
                       $q->whereTranslationLike('name',"%{$keyword}%",'ar')
                       ->orWhereTranslationLike('name',"%{$keyword}%",'en');
                   })->orWhereHas('brand',function ($q) use($keyword) {
                       $q->whereTranslationLike('name',"%{$keyword}%",'ar')
                       ->orWhereTranslationLike('name',"%{$keyword}%",'en');
                    });
               })->when(isset($car_model_side_cols[$request['order'][0]['column']]),function ($q) use($car_model_side_cols , $request) {
                   if ($car_model_side_cols[$request['order'][0]['column']] == 'name') {
                       $q->orderByTranslation('name',$request['order'][0]['dir']);
                   }elseif($car_model_side_cols[$request['order'][0]['column']] == 'cars_count'){
                       $q->withCount('cars')->orderBy('cars_count',$request['order'][0]['dir']);
                   }else{
                       $q->orderBy($car_model_side_cols[$request['order'][0]['column']],$request['order'][0]['dir']);
                   }
               })->skip($request['start'])->take($request['length'] == '-1' ? $car_model_count : $request['length'])->get();
               return (new CarModelResource($car_models))->additional(['car_model_count' => $car_model_count]);
           }

         if (!request()->ajax()) {
             return view('dashboard.car_model.index',compact('car_model_count'));
         }

     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (!request()->ajax()) {
          $brands = Brand::latest()->get()->pluck('name','id');
          return view('dashboard.car_model.create',compact('brands'));
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarModelRequest $request)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               CarModel::create(array_except($request->validated(),['image']));
               \DB::commit();
               return redirect(route('dashboard.car_model.index'))->withTrue(trans('dashboard.messages.success_add'));
           }catch (\Exception $e) {
               \DB::rollback();
               return redirect(route('dashboard.car_model.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarModel  $car_model
     * @return \Illuminate\Http\Response
     */
    public function show(CarModel $car_model)
    {
        if (!request()->ajax()) {
           return view('dashboard.car_model.show',compact('car_model'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarModel  $car_model
     * @return \Illuminate\Http\Response
     */
    public function edit(CarModel $car_model)
    {
        if (!request()->ajax()) {
            $brands = Brand::latest()->get()->pluck('name','id');
            return view('dashboard.car_model.edit',compact('car_model' , 'brands'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarModel  $car_model
     * @return \Illuminate\Http\Response
     */
    public function update(CarModelRequest $request, CarModel $car_model)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               $car_model->update(array_except($request->validated(),['image']));
               \DB::commit();
               return redirect(route('dashboard.car_model.index'))->withTrue(trans('dashboard.messages.success_update'));
           }catch (\Exception $e) {
               \DB::rollback();
               return redirect(route('dashboard.car_model.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarModel  $car_model
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarModel $car_model)
    {
        if ($car_model->delete()) {
          return response()->json(['value' => 1]);
        }
    }
}
