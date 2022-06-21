<?php

namespace App\Http\Controllers\Api\Driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\{UserProfileResource};
use App\Http\Requests\Api\Driver\Driver\{DriverAvailableRequest};
use App\Models\{Driver , User};

class DriverController extends Controller
{

    public function toggleAvailable(DriverAvailableRequest $request)
    {
        \DB::beginTransaction();
        try {
            $driver = Driver::firstWhere('user_id' , auth('api')->id());
            $driver->update(['is_driver_available' => ! $driver->is_driver_available]);
            \DB::commit();
           return (new UserProfileResource($driver->user))->additional(['status' => 'success' , 'message' => trans('dashboard.messages.success_update')]);
        }catch (\Exception $e) {
           \DB::rollback();
           return response()->json(['status' => 'fail' , 'message' => trans('dashboard.messages.something_went_wrong_please_try_again') , 'data' => null],500);
        }

    }


}
