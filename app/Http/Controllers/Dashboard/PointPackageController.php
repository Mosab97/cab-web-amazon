<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PointPackage;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Package\{PointPackageRequest};

class PointPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) {
          $point_packages = PointPackage::latest()->paginate(100);
          return view('dashboard.point_package.index',compact('point_packages'));
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
        return view('dashboard.point_package.create');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PointPackageRequest $request)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               PointPackage::create(array_except($request->validated(),['image']));
               \DB::commit();
               return redirect(route('dashboard.point_package.index'))->withTrue(trans('dashboard.messages.success_add'));
           }catch (\Exception $e) {
               \DB::rollback();
               return redirect(route('dashboard.point_package.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PointPackage  $point_package
     * @return \Illuminate\Http\Response
     */
    public function show(PointPackage $point_package)
    {
        if (!request()->ajax()) {
           return view('dashboard.point_package.show',compact('point_package'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PointPackage  $point_package
     * @return \Illuminate\Http\Response
     */
    public function edit(PointPackage $point_package)
    {
        if (!request()->ajax()) {
           return view('dashboard.point_package.edit',compact('point_package'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PointPackage  $point_package
     * @return \Illuminate\Http\Response
     */
    public function update(PointPackageRequest $request, PointPackage $point_package)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               $point_package->update(array_except($request->validated(),['image']));
               \DB::commit();
               return redirect(route('dashboard.point_package.index'))->withTrue(trans('dashboard.messages.success_update'));
           }catch (\Exception $e) {
               \DB::rollback();
               return redirect(route('dashboard.point_package.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PointPackage  $point_package
     * @return \Illuminate\Http\Response
     */
    public function destroy(PointPackage $point_package)
    {
        if ($point_package->delete()) {
          return response()->json(['value' => 1]);
        }
    }
}
