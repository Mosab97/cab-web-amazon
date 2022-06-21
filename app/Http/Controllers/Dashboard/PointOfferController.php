<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{PointOffer , User};
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Package\{PointOfferRequest};
use App\Notifications\General\{FCMNotification};
use App\Jobs\SendFCMNotification;

class PointOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) {
          $point_offers = PointOffer::latest()->paginate(100);
          return view('dashboard.point_offer.index',compact('point_offers'));
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
        return view('dashboard.point_offer.create');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PointOfferRequest $request)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               $point_offer = PointOffer::create(array_except($request->validated(),['image']));
               \DB::commit();
               if ($point_offer->is_active) {
                   $users = User::when($point_offer->user_type,function ($q) use($point_offer) {
                       switch ($point_offer->user_type) {
                           case 'client_and_driver':
                           $q->whereIn('user_type',['client','driver']);
                           break;

                           default:
                           $q->where('user_type',$point_offer->user_type);
                           break;
                       }
                   })->active()->get();
                   $user_list = $users->pluck('id')->toArray();
                   $pushFcmNotes    = [
                       'notify_type'         => 'management',
                       'title'        => trans('dashboard.point_offer.fcm_title'),
                       'body'         => $point_offer->fcm_notification,
                   ];
                   \Notification::send($users,new FCMNotification($pushFcmNotes,['database']));
                   SendFCMNotification::dispatch($pushFcmNotes , $user_list)->onQueue('wallet');
               }
               return redirect(route('dashboard.point_offer.index'))->withTrue(trans('dashboard.messages.success_add'));
           }catch (\Exception $e) {
               \DB::rollback();

               return redirect(route('dashboard.point_offer.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PointOffer  $point_offer
     * @return \Illuminate\Http\Response
     */
    public function show(PointOffer $point_offer)
    {
        if (!request()->ajax()) {
           return view('dashboard.point_offer.show',compact('point_offer'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PointOffer  $point_offer
     * @return \Illuminate\Http\Response
     */
    public function edit(PointOffer $point_offer)
    {
        if (!request()->ajax()) {
           return view('dashboard.point_offer.edit',compact('point_offer'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PointOffer  $point_offer
     * @return \Illuminate\Http\Response
     */
    public function update(PointOfferRequest $request, PointOffer $point_offer)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               $point_offer->update(array_except($request->validated(),['image']));
               \DB::commit();
               if ($point_offer->is_active) {
                   $users = User::when($point_offer->user_type,function ($q) use($point_offer) {
                       switch ($point_offer->user_type) {
                           case 'client_and_driver':
                           $q->whereIn('user_type',['client','driver']);
                           break;

                           default:
                           $q->where('user_type',$point_offer->user_type);
                           break;
                       }
                   })->active()->get();
                   $user_list = $users->pluck('id')->toArray();
                   $pushFcmNotes    = [
                       'notify_type'         => 'management',
                       'title'        => trans('dashboard.point_offer.fcm_title'),
                       'body'         => $point_offer->fcm_notification,
                   ];
                   \Notification::send($users,new FCMNotification($pushFcmNotes,['database']));
                   SendFCMNotification::dispatch($pushFcmNotes , $user_list)->onQueue('wallet');
               }
               return redirect(route('dashboard.point_offer.index'))->withTrue(trans('dashboard.messages.success_update'));
           }catch (\Exception $e) {
               \DB::rollback();
               return redirect(route('dashboard.point_offer.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PointOffer  $point_offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(PointOffer $point_offer)
    {
        if ($point_offer->delete()) {
          return response()->json(['value' => 1]);
        }
    }
}
