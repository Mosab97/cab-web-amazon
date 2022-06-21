<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PointUseController extends Controller
{

    public function index(Request $request)
    {
        if (!request()->ajax()) {
            $created_from_date = '';
            $created_to_date = '';
            if ($request->created_from_date && $request->created_to_date) {
                $created_from_date = Carbon::parse($request->created_from_date)->format('Y-m-d');
                $created_to_date = Carbon::parse($request->created_to_date)->format('Y-m-d');
            }elseif ($request->created_from_date) {
                $created_from_date = Carbon::parse($request->created_from_date)->format('Y-m-d');
            }elseif ($request->created_to_date) {
                $created_to_date = Carbon::parse($request->created_to_date)->format('Y-m-d');
            }
            $user_type=$request->user_type;

            $users = User::where('user_type', $request->user_type)->whereHas('userPoints',function($q){
                $q->where('is_used',true);
            }) ->when($created_from_date || $created_to_date,function ($q) use($created_to_date,$created_from_date){
                if ($created_from_date && $created_to_date) {
                    $q->whereBetween('created_at',[$created_from_date , $created_to_date]);
                }elseif ($created_from_date) {
                    $q->whereDate('created_at',">=",$created_from_date);
                }elseif ($created_to_date) {
                    $q->whereDate('created_at',"<=",$created_to_date);
                }
            })->latest()->paginate(100);


            return view('dashboard.point_use.index', compact('users','user_type'));

        }
    }





    public function show($id)
    {
        //
    }


}
