<?php

namespace App\Http\Controllers\Api\Driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Driver\Location\{UpdateLocationRequest};

class LocationController extends Controller
{

    public function updateLocation(UpdateLocationRequest $request)
    {
        auth('api')->user()->driver()->updateOrCreate(['user_id' => auth('api')->id()],['lat' => $request->lat , 'lng' => $request->lng , 'location' => $request->location]);

        return response()->json(['data' => null , 'status' => 'success' , 'message' => trans('dashboard.messages.success_update')]);
    }

}
