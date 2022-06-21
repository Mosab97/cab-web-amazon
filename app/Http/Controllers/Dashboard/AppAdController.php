<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AppAd;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\AppAd\{AppAdRequest};

class AppAdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!request()->ajax()) {
          $app_ads = AppAd::latest()->paginate(100);
          return view('dashboard.app_ad.index',compact('app_ads'));
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
        return view('dashboard.app_ad.create');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppAdRequest $request)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               AppAd::create(array_except($request->validated(),['image_ar','image_en']));
               \DB::commit();
               return redirect(route('dashboard.app_ad.index'))->withTrue(trans('dashboard.messages.success_add'));
           }catch (\Exception $e) {
               \DB::rollback();
               return redirect(route('dashboard.app_ad.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppAd  $app_ad
     * @return \Illuminate\Http\Response
     */
    public function show(AppAd $app_ad)
    {
        if (!request()->ajax()) {
           return view('dashboard.app_ad.show',compact('app_ad'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppAd  $app_ad
     * @return \Illuminate\Http\Response
     */
    public function edit(AppAd $app_ad)
    {
        if (!request()->ajax()) {
           return view('dashboard.app_ad.edit',compact('app_ad'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppAd  $app_ad
     * @return \Illuminate\Http\Response
     */
    public function update(AppAdRequest $request, AppAd $app_ad)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               $app_ad->update(array_except($request->validated(),['image_ar','image_en']));
               \DB::commit();
               return redirect(route('dashboard.app_ad.index'))->withTrue(trans('dashboard.messages.success_update'));
           }catch (\Exception $e) {
               \DB::rollback();

               dd($e->getMessage());

               return redirect(route('dashboard.app_ad.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppAd  $app_ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppAd $app_ad)
    {
        if ($app_ad->delete()) {
          return response()->json(['value' => 1]);
        }
    }
}
