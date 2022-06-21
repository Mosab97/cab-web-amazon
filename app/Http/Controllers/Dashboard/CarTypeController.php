<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CarType;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\CarType\{CarTypeRequest};

class CarTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) {
        //   $car_types = CarType::latest()->paginate(100);
          $car_types = CarType::paginate(100);
          return view('dashboard.car_type.index',compact('car_types'));
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
        return view('dashboard.car_type.create');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarTypeRequest $request)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               CarType::create(array_except($request->validated(),['image']));
               \DB::commit();
               return redirect(route('dashboard.car_type.index'))->withTrue(trans('dashboard.messages.success_add'));
           }catch (\Exception $e) {
               \DB::rollback();
               return redirect(route('dashboard.car_type.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarType  $car_type
     * @return \Illuminate\Http\Response
     */
    public function show(CarType $car_type)
    {
        if (!request()->ajax()) {
           return view('dashboard.car_type.show',compact('car_type'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarType  $car_type
     * @return \Illuminate\Http\Response
     */
    public function edit(CarType $car_type)
    {
        if (!request()->ajax()) {
           return view('dashboard.car_type.edit',compact('car_type'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarType  $car_type
     * @return \Illuminate\Http\Response
     */
    public function update(CarTypeRequest $request, CarType $car_type)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               $car_type->update(array_except($request->validated(),['image']));
               \DB::commit();
               return redirect(route('dashboard.car_type.index'))->withTrue(trans('dashboard.messages.success_update'));
           }catch (\Exception $e) {
               \DB::rollback();
               return redirect(route('dashboard.car_type.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarType  $car_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarType $car_type)
    {
        if ($car_type->delete()) {
          return response()->json(['value' => 1]);
        }
    }
}
