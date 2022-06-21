<?php

namespace App\Http\Controllers\Api\Help;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Help\{LuckyBoxResource};
use App\Http\Requests\Api\User\{LuckyBoxRequest};
use App\Models\{LuckyBox};

class LuckyBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_types = [auth('api')->user()->user_type , 'client_and_driver'];
        $lucky_boxes = LuckyBox::whereIn('user_type',$user_types)->active()->live()->inRandomOrder()->get();
        return LuckyBoxResource::collection($lucky_boxes)->additional(['status' => 'success' , 'message' => '']);
    }

    public function store(LuckyBoxRequest $request)
    {
        $lucky_box = LuckyBox::active()->live()->findOrFail($request->lucky_box_id);
        $user  = auth('api')->user();
        if ($user->luckyBoxes()->where('gift_user.order_id',$request->order_id)->exists()) {
            return response()->json(['status' => 'fail', 'data' => null, 'message' => trans('api.messages.cant_catch_gift_more_times_on_same_order')]);
        }

        $user->luckyBoxes()->attach([$request->lucky_box_id => ['order_id' => $request->order_id]]);
        switch ($lucky_box->gift_type) {
            case 'points':
                $user->userPoints()->create([
                    'points' => $lucky_box->points,
                    'is_used' => false,
                    'status' => 'add',
                    'reason' => 'lucky_box',
                    'transfer_type' => 'point',
                    'added_by_id' => auth('api')->id() ?? auth()->id(),
                ]);
                $user->update(['points' => $user->points + $lucky_box->points]);
                break;
            case 'balance':
                    $new_wallet = wallet_transaction($user , $lucky_box->balance , 'charge' , $lucky_box);
                    $user->update(['wallet' => $new_wallet]);
                break;
        }

        return response()->json(['status' => 'success','message'=> trans('dashboard.messages.success_update')]);
    }

}
