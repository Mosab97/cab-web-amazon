<?php

namespace App\Http\Controllers\Api\Help;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Help\{PointPackageResource};
use App\Http\Resources\User\{UserProfileResource};
use App\Http\Requests\Api\Package\{RedeemPointsRequest};
use App\Models\{PointPackage};

class PointPackageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth('api')->user();
        $point_packages = PointPackage::active()->whereIn('user_type',[$user->user_type,'client_and_driver'])->latest()->get();
        return PointPackageResource::collection($point_packages)->additional(['status' => 'success','message'=>'','my_points' => (float) $user->points]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$point_package)
    {
        $user = auth('api')->user();
        $point_package = PointPackage::active()->whereIn('user_type',[$user->user_type,'client_and_driver'])->findOrFail($point_package);
        return (new PointPackageResource($point_package))->additional(['status' => 'success','message'=>'' ,'my_points' => (float) $user->points]);
    }

    public function store(RedeemPointsRequest $request)
    {
        $user = auth('api')->user();
        $package = PointPackage::active()->whereIn('user_type',[$user->user_type,'client_and_driver'])->findOrFail($request->package_id);
        // if ($user->userPoints()->where(['point_package_id' => $package->id, 'is_used' => true, 'transfer_type' => 'wallet'])->exists()) {
        //     return response()->json(['status' => 'fail','message' => trans('api.messages.u_used_before'),'data' => null],422);
        // }
        if ($user->points < $package->points) {
             return response()->json(['status' => 'fail','message' => trans('api.messages.ur_pnts_not_enough'),'data' => null],422);
        }

        \DB::beginTransaction();
        try {

            $point_package = $user->userPoints()->create([
                'point_package_id' => $package->id,
                'amount' => $package->amount,
                'points' => $package->points,
                'transfer_type' => $package->transfer_type,
                'is_used' => in_array($package->transfer_type , ['wallet']),
                'package_data' => $package->toJson(),
                'status' => 'sub',
                'reason' => 'point_package',
                'added_by_id' => $user->id,
            ]);
            $user_data = ['points' => ($user->points - $package->points)];
            if (in_array($package->transfer_type , ['wallet'])) {
                $new_wallet = wallet_transaction($user , $package->amount , 'charge' , $package);
                $user_data += ['wallet' => $new_wallet];
            }
            $user->update($user_data);
            \DB::commit();
           return (new PointPackageResource($point_package))->additional(['status' => 'success' , 'message' => trans('api.messages.success_redeem') ,'my_points' => (float) $user->points]);
        }catch (\Exception $e) {
           \DB::rollback();
           \Log::info($e->getMessage());
           return response()->json(['status' => 'fail' , 'message' => trans('dashboard.messages.something_went_wrong_please_try_again') , 'data' => null],500);
        }

    }


}
