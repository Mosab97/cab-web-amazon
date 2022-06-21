<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AppOffer\AppOfferRequest;
use App\Models\AppOffer;
use Illuminate\Http\Request;

class AppOfferController extends Controller
{

    public function index()
    {
        if (!request()->ajax()) {
            $app_offers = AppOffer::latest()->paginate(100);
            return view('dashboard.app_offer.index',compact('app_offers'));
        }
    }


    public function create()
    {
        if (!request()->ajax()) {
            return view('dashboard.app_offer.create');
        }
    }


    public function store(AppOfferRequest $request)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
                AppOffer::create(array_except($request->validated(),['image_ar','image_en']));

                \DB::commit();
                return redirect(route('dashboard.app_offer.index'))->withTrue(trans('dashboard.messages.success_add'));
            }catch (\Exception $e) {
                \DB::rollback();
                return redirect(route('dashboard.app_offer.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
            }
        }
    }


    public function show($id)
    {
        abort(404);
    }

    public function edit(AppOffer $app_offer)
    {
        if (!request()->ajax()) {
            return view('dashboard.app_offer.edit',compact('app_offer'));
        }
    }


    public function update(AppOfferRequest $request, AppOffer $app_offer)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
                $app_offer->update(array_except($request->validated(),['image_ar','image_en']));
                \DB::commit();
                return redirect(route('dashboard.app_offer.index'))->withTrue(trans('dashboard.messages.success_update'));
            }catch (\Exception $e) {
                \DB::rollback();
                return redirect(route('dashboard.app_offer.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
            }
        }
    }


    public function destroy(AppOffer $app_offer)
    {
        if ($app_offer->delete()) {
            return response()->json(['value' => 1]);
        }
    }
}
