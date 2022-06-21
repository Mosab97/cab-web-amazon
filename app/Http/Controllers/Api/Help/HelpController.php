<?php

namespace App\Http\Controllers\Api\Help;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Help\{AppOfferResource,
    CarTypeResource,
    FaqResource,
    PackageResource,
    CancelReasonResource,
    AppAdResource};
use App\Models\{AppOffer, CarType, Faq, Package, CancelReason, AppAd, LuckyBox};

class HelpController extends Controller
{
    public function carTypes()
    {
        // $car_types = CarType::latest()->get();
        $car_types = CarType::get();
        return CarTypeResource::collection($car_types)->additional(['status' => 'success','message'=>'']);
    }

    public function getCancelReasons()
    {
        $user_types = [auth('api')->user()->user_type , 'client_and_driver'];
        $cancel_reasons = CancelReason::whereIn('user_type',$user_types)->latest()->get();
        return CancelReasonResource::collection($cancel_reasons)->additional(['status' => 'success','message'=>'']);
    }


    public function getPackages()
    {
        if (auth('api')->check() && auth('api')->user()->user_type == 'driver' && !auth('api')->user()->driver->is_admin_accept) {
            return response()->json(['status' => 'fail' , 'data' => null , 'message' => trans('api.messages.admin_not_accept_ur_data')],422);
        }
        $packages = Package::active()->latest()->get();
        return PackageResource::collection($packages)->additional(['status' => 'success','message'=>'','tax' => (float) setting('tax')]);
    }

    public function getAppAd()
    {
        $app_ad = AppAd::active()->live()->inRandomOrder()->latest()->first();
        if (!$app_ad) {
            return response()->json(['data' => null , 'status' => 'success' , 'message' => '']);
        }
        return (new AppAdResource($app_ad))->additional(['status' => 'success','message'=>'']);
    }

    public function appOffers(){
        $user_types = [auth('api')->user()->user_type , 'client_and_driver'];
        $app_offers = AppOffer::active()->whereIn('user_type',$user_types)->latest()->get();;
        return AppOfferResource::collection($app_offers)->additional(['status' => 'success','message'=>'']);

    }

    public function getFaqs(){
        $faqs=Faq::active()->latest()->get();
        return FaqResource::collection($faqs)->additional(['status' => 'success','message'=>'']);
    }




}
