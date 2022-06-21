<?php

namespace App\Http\Controllers\Api\Driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Driver\{CarResource};
use App\Http\Requests\Api\Driver\Car\{CarRequest};
use App\Models\{Car , User , CarDriver , UpdateRequest};

class CarController extends Controller
{

    public function getCarData()
    {
        $car = auth('api')->user()->car;
        if (!$car) {
            return response()->json(['status' => 'success' , 'data' => null , 'message' => trans('api.messages.u_havnt_car')]);
        }
        return (new CarResource($car))->additional(['status' => 'success' , 'message' => '']);

    }

    public function updateDriver(CarRequest $request)
    {

        \DB::beginTransaction();
        try {
            $car = auth('api')->user()->car;
            $driver = auth('api')->user();
            $is_not_updated = true;
            $msg = trans('dashboard.messages.success_update');
            if (!$car) {
                $driver->driver()->update(['is_admin_accept' => 0]);
            }else{
                if (($request->brand_id && $request->brand_id != $car->brand_id) || ($request->car_model_id && $request->car_model_id != $car->car_model_id) || ($request->car_type_id && $request->car_type_id != $car->car_type_id) || ($request->license_serial_number && $request->license_serial_number != $car->license_serial_number) || ($request->manufacture_year && $request->manufacture_year != $car->manufacture_year) || ($request->plate_number && $request->plate_number != $car->plate_number) || ($request->plate_type && $request->plate_type != $car->plate_type) || $request->hasFile('car_licence_image') || $request->hasFile('car_form_image') || $request->hasFile('car_front_image') || $request->hasFile('car_back_image') || $request->hasFile('car_insurance_image')) {
                    $update_request = $driver->updateRequests()->where(['update_status' => 'pending','user_id' => $driver->id])->first();
                    if ($update_request) {
                        $update_type = in_array($update_request->update_type,['personal_data' , 'personal_car_data']) ? 'personal_car_data' : 'car_data';

                         $update_request->update(array_except($request->validated(),['plate_letters'])+['user_type' => 'driver' , 'update_status' => 'pending' , 'update_type' => $update_type]);
                     }else{
                         $driver->updateRequests()->create(array_except($request->validated(),['plate_letters'])+['user_type' => 'driver' , 'update_status' => 'pending' , 'update_type' => 'car_data']);

                     }
                     $is_not_updated = false;
                     $msg = "جاري مراجعة بياناتك من قبل الادارة نظرا لتغيير بيانات المركبة";
                }

            }
            if ($is_not_updated) {
                $car = $driver->car()->updateOrCreate(['driver_id' => auth('api')->id()],array_filter(array_except($request->validated(),['plate_letters'])));
            }
            \DB::commit();
           return (new CarResource($car))->additional(['status' => 'success' , 'message' => $msg]);
        }catch (\Exception $e) {
           \DB::rollback();
           return response()->json(['status' => 'fail' , 'message' => trans('dashboard.messages.something_went_wrong_please_try_again') , 'data' => null],500);
        }

    }

    public function getMinManufactureYears()
    {
        return response()->json(['status' => 'success' , 'data' => ['year' => "2005"] , 'message' => '']);
    }

    public function getPlateTypes()
    {
        $data = [
            [
                'id' => 1,
                'name' => trans('api.car.plate_types.private')
            ],
            [
                'id' => 6,
                'name' => trans('api.car.plate_types.taxi')
            ],
        ];
        return response()->json(['status' => 'success' , 'data' => $data , 'message' => '']);
    }

}
