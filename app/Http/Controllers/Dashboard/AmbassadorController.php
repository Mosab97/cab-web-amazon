<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{ User , Referral};
use Illuminate\Http\Request;
use App\Http\Resources\Dashboard\User\UserResource;

class AmbassadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::where('user_type' , $request->user_type)->has('myReferrals')->latest();
        $user_count = $query->count();
        $user_side_cols = [
            'id','image','fullname','email','phone','referral_code','created_at'
        ];
        if (request()->ajax()) {
            $keyword = $request->search['value'];
            $users = $query->when($keyword,function($q)use($keyword){
                $q->where(function($q)use($keyword){
                    $q->where('fullname',"LIKE","%{$keyword}%")->orWhere('email',"LIKE","%{$keyword}%")->orWhere('phone',"LIKE","%{$keyword}%");
                });
            })->when(isset($user_side_cols[$request['order'][0]['column']]),function ($q) use($request , $user_side_cols) {
                $q->orderBy($user_side_cols[$request['order'][0]['column']],$request['order'][0]['dir']);
            })->skip($request['start'])->take($request['length'] == '-1' ? $user_count : $request['length'])->get();
            return (new UserResource($users))->additional(['user_count' => $user_count]);
        }

        if (!request()->ajax()) {
          return view('dashboard.ambassador.index',compact('user_count'));
        }
    }

    public function show($user_id)
    {
        if (!request()->ajax()) {
            $user = User::whereNotIn('user_type',['admin','superadmin'])->findOrFail($user_id);
            $users = Referral::where('parent_user_id',$user->id)->paginate(20);
            return view('dashboard.ambassador.show',compact('user','users'));
        }
    }
}
