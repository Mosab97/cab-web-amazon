<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{UpdateRequest , User};
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\UpdateRequest\{UpdateRequestRequest};
use App\Services\{WaslElmService};

class UpdateRequestController extends Controller
{
    use WaslElmService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $update_requests = UpdateRequest::where('update_status','pending')->latest()->paginate(50);
        return view('dashboard.update_request.index',compact('update_requests'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UpdateRequest  $car
     * @return \Illuminate\Http\Response
     */
    public function show(UpdateRequest $update_request)
    {
        if (!request()->ajax()) {
            return view('dashboard.update_request.show',compact('update_request'));
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UpdateRequest  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestRequest $request, UpdateRequest $update_request)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               $update_request->update($request->validated());
               if ($update_request->update_status == 'accepted') {
                    $personal_data = array_filter($update_request->only(['phone','identity_number','date_of_birth','date_of_birth_hijri']));

                    $car_data = array_filter($update_request->only(['brand_id','car_model_id','car_type_id','car_licence_image','car_back_image','car_form_image','car_front_image','car_insurance_image','license_serial_number','plate_letter_left','plate_letter_right','plate_letter_middle','plate_number','plate_numbers_only','plate_type','manufacture_year']));

                   if (count($personal_data) && ! count($car_data)) {
                       $update_request->user()->update($personal_data);
                       if ($update_request->driver_type) {
                           $update_request->user->driver()->update(['driver_type' => $update_request->driver_type]);
                       }
                       $notify_body = trans('dashboard.fcm.accepted_personal_data_updated');
                   }elseif (count($personal_data) && count($car_data)) {
                       $update_request->user()->update($personal_data);
                       $update_request->user->car()->update($car_data);
                       if ($update_request->driver_type) {
                           $update_request->user->driver()->update(['driver_type' => $update_request->driver_type]);
                       }
                       $notify_body = trans('dashboard.fcm.accepted_car_personal_data_updated');
                   }elseif (!count($personal_data) && count($car_data)) {
                       $notify_body = trans('dashboard.fcm.accepted_car_data_updated');
                       $update_request->user->car()->update($car_data);
                   }

                   if ($update_request->user_type == 'driver' && optional(@$update_request->user->driver)->is_admin_accept && setting('register_in_elm') == 'with_accept_data') {
                       $elm_reply = $this->registerDriver($update_request->user);
                       $update_request->user->driver()->update(['elm_reply' => $elm_reply]);
                   }

               }elseif ($update_request->update_status == 'refused') {
                   $notify_body =  trans('dashboard.fcm.refuse_request_update',['reason' => $update_request->refuse_reason]);
               }
               \DB::commit();
               if (isset($notify_body)) {
                   $fcm_data = [
                       'title' => trans('dashboard.fcm.update_request_title'),
                       'body' => $notify_body,
                       'notify_type' => 'management'
                   ];
                   pushFcmNotes($fcm_data,[$update_request->user_id]);
               }
               return redirect(route('dashboard.update_request.index'))->withTrue(trans('dashboard.messages.success_update'));
           }catch (\Exception $e) {
               \DB::rollback();
               return redirect(route('dashboard.update_request.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UpdateRequest  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(UpdateRequest $update_request)
    {
        if ($update_request->delete()) {
          return response()->json(['value' => 1]);
        }
    }
}
