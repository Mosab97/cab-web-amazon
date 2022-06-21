<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{LuckyBox, User};
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\LuckyBox\{LuckyBoxRequest};
use App\Http\Resources\Dashboard\LuckyBox\{UserResource};
use Carbon\Carbon;

class LuckyBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) {
          $lucky_boxes = LuckyBox::latest()->paginate(100);
          return view('dashboard.lucky_box.index',compact('lucky_boxes'));
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
        return view('dashboard.lucky_box.create');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LuckyBoxRequest $request)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               LuckyBox::create(array_except($request->validated(),['image']));
               \DB::commit();
               return redirect(route('dashboard.lucky_box.index'))->withTrue(trans('dashboard.messages.success_add'));
           }catch (\Exception $e) {
               \DB::rollback();
               return redirect(route('dashboard.lucky_box.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LuckyBox  $lucky_box
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,LuckyBox $lucky_box)
    {
        Carbon::setWeekStartsAt(Carbon::SATURDAY);
	    Carbon::setWeekEndsAt(Carbon::FRIDAY);

        $from_date = '';
        $to_date = '';
        if ($request->from_date && $request->to_date) {
            $from_date = date("Y-m-d",strtotime($request->from_date));
            $to_date = date("Y-m-d",strtotime($request->to_date));
        }elseif ($request->from_date) {
            $from_date = date("Y-m-d",strtotime($request->from_date));
        }elseif ($request->to_date) {
            $to_date = date("Y-m-d",strtotime($request->to_date));
        }

        $query = $lucky_box->users()->when($request->user_type,function ($q) use($request) {
            if ($request->user_type == 'client_and_driver') {
                $q->whereIn('user_type',['client','driver']);
            }else{
                $q->where('user_type',$request->user_type);
            }
        })->when($request->get_date,function ($q) use($request,$from_date,$to_date) {
            $q->whereHas('luckyBoxes',function ($q) use($request,$from_date,$to_date) {
                switch ($request->get_date) {
                    case 'today':
                        $q->whereDate('gift_user.created_at',date("Y-m-d"));
                    break;
                    case 'yesterday':
                        $q->whereDate('gift_user.created_at',date("Y-m-d",strtotime("-1 day")));
                    break;
                    case 'this_week':
                        $q->whereBetween('gift_user.created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                        break;
                    case 'this_month':
                        $q->whereMonth('gift_user.created_at',date("m"))->whereYear('gift_user.created_at',date("Y"));
                        break;
                    case 'duration':
                        $q->when($request->from_date || $request->to_date,function($q)use($from_date,$to_date){
                            if ($from_date && $to_date) {
                                $q->whereDate('gift_user.created_at',">=",$from_date)->whereDate('gift_user.created_at',"<=",$to_date);
                            }elseif ($from_date) {
                                $q->whereDate('gift_user.created_at',">=",$from_date);
                            }elseif ($to_date) {
                                $q->whereDate('gift_user.created_at',"<=",$to_date);
                            }
                        });
                        break;
                }

            });
        })->latest();

        // $user_list = $query->pluck('gift_user.user_id')->toArray();

        $user_count = $query->count();
        $client_side_cols = [
            'id','image','fullname','email','phone',"wallet",'created_at'
        ];
        if (request()->ajax()) {
            $keyword = $request->search['value'];
            $users = $query->when($keyword,function($q)use($keyword){
                $q->where(function($q)use($keyword){
                    $q->where('fullname',"LIKE","%{$keyword}%")->orWhere('email',"LIKE","%{$keyword}%")->orWhere('phone',"LIKE","%{$keyword}%")->orWhere('wallet',"LIKE","%{$keyword}%");
                });
            })->when(isset($client_side_cols[$request['order'][0]['column']]),function ($q) use($request , $client_side_cols) {
                $col = 'users.'.$client_side_cols[$request['order'][0]['column']];
                $q->orderBy($col,$request['order'][0]['dir']);
            })->when(!isset($client_side_cols[$request['order'][0]['column']]),function ($q) {
                $q->latest('users.created_at');
            })->skip($request['start'])->take($request['length'] == '-1' ? $user_count : $request['length'])->get();

            return (new UserResource($users))->additional(['client_count' => $user_count]);
        }

        return view('dashboard.lucky_box.show',compact('lucky_box','user_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LuckyBox  $lucky_box
     * @return \Illuminate\Http\Response
     */
    public function edit(LuckyBox $lucky_box)
    {
        if (!request()->ajax()) {
           return view('dashboard.lucky_box.edit',compact('lucky_box'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LuckyBox  $lucky_box
     * @return \Illuminate\Http\Response
     */
    public function update(LuckyBoxRequest $request, LuckyBox $lucky_box)
    {
        if (!request()->ajax()) {
            \DB::beginTransaction();
            try {
               $lucky_box->update(array_except($request->validated(),['image']));
               \DB::commit();
               return redirect(route('dashboard.lucky_box.index'))->withTrue(trans('dashboard.messages.success_update'));
           }catch (\Exception $e) {
               \DB::rollback();
               return redirect(route('dashboard.lucky_box.index'))->withFalse(trans('dashboard.messages.something_went_wrong_please_try_again'));
           }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LuckyBox  $lucky_box
     * @return \Illuminate\Http\Response
     */
    public function destroy(LuckyBox $lucky_box)
    {
        if ($lucky_box->delete()) {
          return response()->json(['value' => 1]);
        }
    }
}
