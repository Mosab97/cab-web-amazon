<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{Car , Brand , CarModel , CarType , User , Driver};
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Car\{CarRequest};
use App\Http\Resources\Dashboard\Car\{CarResource};

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $query = Car::latest();
      $car_count = $query->count();
      $car_side_cols = [
          'id','brand_id','car_model_id','car_type_id','driver_name','created_at'
      ];
      if (request()->ajax()) {
          $keyword = $request->search['value'];
          $cars = $query->when($keyword,function($q)use($keyword){
              $q->whereHas('carModel',function($q)use($keyword){
                  $q->whereTranslationLike('name',"%{$keyword}%",'ar')
                  ->orWhereTranslationLike('name',"%{$keyword}%",'en');
              })
              ->orWhereHas('brand',function ($q) use($keyword) {
                  $q->whereTranslationLike('name',"%{$keyword}%",'ar')
                  ->orWhereTranslationLike('name',"%{$keyword}%",'en');
              })
              ->orWhereHas('carType',function ($q) use($keyword) {
                   $q->whereTranslationLike('name',"%{$keyword}%",'ar')
                   ->orWhereTranslationLike('name',"%{$keyword}%",'en');
                })
              ->orWhereHas('driver',function ($q) use($keyword) {
                     $q->where('fullname',"LIKE","%{$keyword}%")->orWhere('email',"LIKE","%{$keyword}%")->orWhere('phone',"LIKE","%{$keyword}%");
                });
          })->when(isset($car_side_cols[$request['order'][0]['column']]),function ($q) use($request , $car_side_cols) {
              $q->orderBy($car_side_cols[$request['order'][0]['column']],$request['order'][0]['dir']);
          })->when(!isset($car_side_cols[$request['order'][0]['column']]),function ($q) {
              $q->latest();
          })->skip($request['start'])->take($request['length'] == '-1' ? $car_count : $request['length'])->get();
          return (new CarResource($cars))->additional(['car_count' => $car_count]);
      }

        if (!request()->ajax()) {
            return view('dashboard.car.index',compact('car_count'));
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
          $data['brands'] = Brand::latest()->get()->pluck('name','id');
          $data['car_types'] = CarType::latest()->get()->pluck('name','id');
          $data['plate_types'] = [
              1  => trans('api.car.plate_types.private'),
              6  => trans('api.car.plate_types.taxi')
          ];
          return view('dashboard.car.create',$data);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarRequest $request)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               Car::create(array_except($request->validated(),['plate_letters']));
               \DB::commit();
               return redirect(route('dashboard.car.index'))->withTrue(trans('dashboard.messages.success_add'));
           }catch (\Exception $e) {
               \DB::rollback();
               return back()->withInput()->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        if (!request()->ajax()) {
            $driver = Driver::where('user_id',$car->driver_id)->first();
            $related_cars = Car::where('brand_id',$car->brand_id)->inRandomOrder()->take(10)->get();
            return view('dashboard.car.show',compact('car','related_cars','driver'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        if (!request()->ajax()) {
            $data['brands'] = Brand::latest()->get()->pluck('name','id');
            $data['car_models'] = CarModel::where('brand_id',$car->brand_id)->latest()->get()->pluck('name','id');
            $data['car_types'] = CarType::latest()->get()->pluck('name','id');
            $data['plate_types'] = [
                1  => trans('api.car.plate_types.private'),
                6  => trans('api.car.plate_types.taxi')
            ];
            $data['car'] = $car;

            return view('dashboard.car.edit',$data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(CarRequest $request, Car $car)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               $car->update(array_except($request->validated(),['plate_letters']));
               \DB::commit();
               return redirect(route('dashboard.car.index'))->withTrue(trans('dashboard.messages.success_update'));
           }catch (\Exception $e) {
               \DB::rollback();
               dd($e->getMessage());
               return back()->withInput()->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        if ($car->delete()) {
          return response()->json(['value' => 1]);
        }
    }
}
