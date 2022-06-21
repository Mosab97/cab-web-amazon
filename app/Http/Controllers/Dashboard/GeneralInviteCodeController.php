<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{User , GeneralCodeUser , GeneralInviteCode};
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\GeneralInviteCode\GeneralInviteCodeRequest;

class GeneralInviteCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!request()->ajax()) {
            $invite_codes = GeneralInviteCode::latest()->paginate(50);
            return view('dashboard.invite_code.index',compact('invite_codes'));
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
          return view('dashboard.invite_code.create');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GeneralInviteCodeRequest $request)
    {
        if (!request()->ajax()) {
           GeneralInviteCode::create(array_except($request->validated(),['image'])+['added_by_id' => auth()->id()]);
           return redirect(route('dashboard.invite_code.index'))->withTrue(trans('dashboard.messages.success_add'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GeneralInviteCode  $invite_code
     * @return \Illuminate\Http\Response
     */
    public function show(GeneralInviteCode $invite_code)
    {
        if (!request()->ajax()) {
            $users = $invite_code->users()->paginate(20);
            return view('dashboard.invite_code.show',compact('invite_code','users'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GeneralInviteCode  $invite_code
     * @return \Illuminate\Http\Response
     */
    public function edit(GeneralInviteCode $invite_code)
    {
        if (!request()->ajax()) {
            $countries = GeneralInviteCode::get()->pluck('name','id');
            return view('dashboard.invite_code.edit',compact('countries','invite_code'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GeneralInviteCode  $invite_code
     * @return \Illuminate\Http\Response
     */
    public function update(GeneralInviteCodeRequest $request, GeneralInviteCode $invite_code)
    {
        if (!request()->ajax()) {
           $invite_code->update(array_except($request->validated(),['image']));
           return redirect(route('dashboard.invite_code.index'))->withTrue(trans('dashboard.messages.success_update'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GeneralInviteCode  $invite_code
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeneralInviteCode $invite_code)
    {
        if ($invite_code->delete()) {
            return response()->json(['value' => 1]);
        }
    }
}
