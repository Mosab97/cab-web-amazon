<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Client\{DriverResource};
use App\Models\{User , Driver};

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nearestDrivers(Request $request,$number_of_drivers = 5)
    {
        $drivers = Driver::whereHas('user',function ($q) {
            $q->whereHas('car');
        })/*->whereIn('user_id',online_users()->pluck('id'))*/->where(['is_driver_available' => 1 , 'is_admin_accept' => 1])
        ->where(function ($q) {
            $q->where(function ($q) {
                $q->where('is_on_default_package',false)->whereHas('subscribedPackage',function ($q) {
                    $q->whereDate('end_at',">=",date("Y-m-d"))->where('is_paid',1);
                });
            })->orWhere(function ($q) {
                $q->where(function ($q) {
                    $q->where('is_on_default_package',true)->where('free_order_counter',"<",((int)setting('number_of_free_orders_on_default_package')))->orWhere(function ($q) {
                       $q->where('is_on_default_package',true)->whereHas('user',function ($q) {
                           $q->where('wallet',">",-(setting('min_wallet_to_recieve_order') ?? 10));
                       });
                   });
                });
            })->orWhereHas('user',function ($q) {
                $q->where('is_with_special_needs',true);
            });
        })->when($request->lat && $request->lng,function ($q) use($request) {
            $q->nearest($request->lat ,$request->lng);
        })->take(((int) setting('number_of_cars_on_map') ? (int) setting('number_of_cars_on_map') : $number_of_drivers))->pluck('user_id');
        $users = User::whereIn('id',$drivers)->get();
        return DriverResource::collection($users)->additional(['status' => 'success','message'=>'']);
    }

}
