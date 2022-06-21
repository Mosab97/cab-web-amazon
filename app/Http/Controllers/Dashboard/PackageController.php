<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Package\{PackageRequest};

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!request()->ajax()) {
          $packages = Package::latest()->when($request->status,function ($q) use($request) {
              switch ($request->status) {
                  case 'active':
                      $q->where('is_active',1);
                      break;
              }
          })->paginate(100);
          return view('dashboard.package.index',compact('packages'));
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
        return view('dashboard.package.create');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               Package::create(array_except($request->validated(),['image']));
               \DB::commit();
               return redirect(route('dashboard.package.index'))->withTrue(trans('dashboard.messages.success_add'));
           }catch (\Exception $e) {
               \DB::rollback();
               dd($e->getMessage());
               return redirect(route('dashboard.package.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        if (!request()->ajax()) {
           return view('dashboard.package.show',compact('package'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        if (!request()->ajax()) {
           return view('dashboard.package.edit',compact('package'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, Package $package)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               $package->update(array_except($request->validated(),['image']));
               \DB::commit();
               return redirect(route('dashboard.package.index'))->withTrue(trans('dashboard.messages.success_update'));
           }catch (\Exception $e) {
               \DB::rollback();
               return redirect(route('dashboard.package.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        if ($package->delete()) {
          return response()->json(['value' => 1]);
        }
    }
}
