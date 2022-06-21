<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Faq\FaqRequest;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function index()
    {
        if (!request()->ajax()) {
            $faqs = Faq::latest()->paginate(100);
            return view('dashboard.faq.index',compact('faqs'));
        }
    }


    public function create()
    {
        if (!request()->ajax()) {
            return view('dashboard.faq.create');
        }
    }


    public function store(FaqRequest $request)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
                Faq::create($request->validated());
                \DB::commit();
                return redirect(route('dashboard.faq.index'))->withTrue(trans('dashboard.messages.success_add'));
            }catch (\Exception $e) {
                \DB::rollback();
                return redirect(route('dashboard.faq.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
            }
        }
    }

    public function show($id)
    {
        abort(404);
    }


    public function edit(Faq $faq)
    {
        if (!request()->ajax()) {
            return view('dashboard.faq.edit',compact('faq'));
        }
    }


    public function update(FaqRequest $request, Faq $faq)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
                $faq->update($request->validated());
                \DB::commit();
                return redirect(route('dashboard.faq.index'))->withTrue(trans('dashboard.messages.success_update'));
            }catch (\Exception $e) {
                \DB::rollback();
                return redirect(route('dashboard.faq.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
            }
        }
    }


    public function destroy(Faq $faq)
    {
        if ($faq->delete()) {
            return response()->json(['value' => 1]);
        }
    }
}
