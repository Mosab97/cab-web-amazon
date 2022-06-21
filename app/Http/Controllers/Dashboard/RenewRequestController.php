<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{RenewRequest , User};
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\RenewRequest\{RenewRequestRequest};

class RenewRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $renew_subscribtion_requests = RenewRequest::where('renew_status','pending')->latest()->paginate(50);
        return view('dashboard.renew_subscribtion_request.index',compact('renew_subscribtion_requests'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RenewRequest  $car
     * @return \Illuminate\Http\Response
     */
    public function show(RenewRequest $renew_subscribtion_request)
    {
        if (!request()->ajax()) {
            return view('dashboard.renew_subscribtion_request.show',compact('renew_subscribtion_request'));
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RenewRequest  $car
     * @return \Illuminate\Http\Response
     */
    public function update(RenewRequestRequest $request, RenewRequest $renew_subscribtion_request)
    {
        if (!request()->ajax()) {
            $package = $renew_subscribtion_request->package;
            $driver = $renew_subscribtion_request->driver;
            $tax = (float) (setting('tax')/100);
            $package_price = $package->package_price + ($package->package_price * $tax);
            if (!$package->is_active && $renew_subscribtion_request->renew_status != 'accepted') {
                return back()->withInput()->withFalse(trans('dashboard.package.package_not_active'));
            }elseif ($driver->wallet < $package_price && $renew_subscribtion_request->renew_status == 'accepted') {
                return back()->withInput()->withFalse(trans('dashboard.package.driver_wallet_lt_package_price'));
            }
            \DB::beginTransaction();
            try {
               $renew_subscribtion_request->update($request->validated());
               if ($renew_subscribtion_request->renew_status == 'accepted') {
                    $driver->update(['wallet' => ($driver->wallet-$package_price)]);
                    $package = $driver->driverPackages()->create([
                        'package_id' => $package->id,
                        'subscribed_at' => now(),
                        'end_at' => now()->addMonths(($package->duration + $package->free_duration)),
                        'price' => $package->package_price,
                        'tax' => $tax,
                        'is_paid' => true,
                        'is_paid_by_wallet' => true,
                        'subscribe_status' => 'subscribed',
                        'package_data' => $package->toJson(),
                        'driver_id' => $driver->id,
                    ]);

                    $driver->driver->update(['subscribed_package_id' => $package->id,'is_on_default_package' => false]);
                    $notify_body =  trans('dashboard.fcm.success_accept_renew_request');
               }elseif ($renew_subscribtion_request->renew_status == 'refused') {
                    $notify_body =  trans('dashboard.fcm.refuse_request_update',['reason' => $renew_subscribtion_request->refuse_reason]);
               }
               \DB::commit();
               $fcm_data = [
                   'title' => trans('dashboard.fcm.renew_subscribtion_request_title'),
                   'body' => $notify_body,
                   'notify_type' => 'management'
               ];
               pushFcmNotes($fcm_data,[$renew_subscribtion_request->driver_id]);
               return redirect(route('dashboard.renew_subscribtion_request.index'))->withTrue(trans('dashboard.messages.success_update'));
           }catch (\Exception $e) {
               \DB::rollback();
               return redirect(route('dashboard.renew_subscribtion_request.index'))->withInput()->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RenewRequest  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(RenewRequest $renew_subscribtion_request)
    {
        if ($renew_subscribtion_request->delete()) {
          return response()->json(['value' => 1]);
        }
    }
}
