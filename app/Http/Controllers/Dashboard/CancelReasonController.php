<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CancelReason;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\CancelReason\{CancelReasonRequest};

class CancelReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) {
          $cancel_reasons = CancelReason::latest()->paginate(100);
          return view('dashboard.cancel_reason.index',compact('cancel_reasons'));
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
        return view('dashboard.cancel_reason.create');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CancelReasonRequest $request)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               CancelReason::create($request->validated());
               \DB::commit();
               return redirect(route('dashboard.cancel_reason.index'))->withTrue(trans('dashboard.messages.success_add'));
           }catch (\Exception $e) {
               \DB::rollback();
               return redirect(route('dashboard.cancel_reason.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CancelReason  $cancel_reason
     * @return \Illuminate\Http\Response
     */
    public function show(CancelReason $cancel_reason)
    {
        if (!request()->ajax()) {
           return view('dashboard.cancel_reason.show',compact('cancel_reason'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CancelReason  $cancel_reason
     * @return \Illuminate\Http\Response
     */
    public function edit(CancelReason $cancel_reason)
    {
        if (!request()->ajax()) {
           return view('dashboard.cancel_reason.edit',compact('cancel_reason'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CancelReason  $cancel_reason
     * @return \Illuminate\Http\Response
     */
    public function update(CancelReasonRequest $request, CancelReason $cancel_reason)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               $cancel_reason->update($request->validated());
               \DB::commit();
               return redirect(route('dashboard.cancel_reason.index'))->withTrue(trans('dashboard.messages.success_update'));
           }catch (\Exception $e) {
               \DB::rollback();
               return redirect(route('dashboard.cancel_reason.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CancelReason  $cancel_reason
     * @return \Illuminate\Http\Response
     */
    public function destroy(CancelReason $cancel_reason)
    {
        if ($cancel_reason->delete()) {
          return response()->json(['value' => 1]);
        }
    }
}
