<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Wallet\{TransferWalletRequest};
use App\Http\Resources\User\{MoneyTransferResource , MoneyTransferCollection};
use App\Models\{User , MoneyTransfer};

class WalletTransfersController extends Controller
{
    public function index(Request $request)
    {
        $user = auth('api')->user();
        $transfers = MoneyTransfer::where('transfer_to_id',$user->id)->orWhere('transfer_from_id',$user->id)->paginate(10);
        return (new MoneyTransferCollection($transfers))->additional(['status' => 'success','message'=> '', 'min_amount' => (float)setting('min_amount_in_transfer_transaction')]);
    }

    public function show($transfer_id)
    {
        $user = auth('api')->user();
        $transfer = MoneyTransfer::where(function ($q) use($user){
                $q->where('transfer_to_id',$user->id)->orWhere('transfer_from_id',$user->id);
            })->findOrFail($transfer_id);

        return (new MoneyTransferResource($transfer))->additional(['status' => 'success','message'=> '' , 'min_amount' => (float)setting('min_amount_in_transfer_transaction')]);
    }

    public function store(TransferWalletRequest $request)
    {
        $another_user = User::firstWhere('phone',$request->phone);

        $user = auth('api')->user();
        if ($user->id == $another_user->id) {
            return response()->json(['status' => 'fail' , 'data' => null , 'message' => trans('api.messages.cant_transfer_to_me')],422);
        }
        $temp_balance = $user->temporaryWallets()->live()->sum('rest_amount');
        if (($user->wallet - $temp_balance) < $request->amount) {
            return response()->json(['status' => 'fail' , 'data' => null , 'message' => trans('api.messages.cant_transfer_temp_balance')],422);
        }

        $transaction = $user->moneyTransfersTo()->create([
            'transfer_to_id' => $another_user->id,
            'amount' => $request->amount,
            'wallet_before' => $user->wallet,
            'wallet_after' => ($user->wallet - $request->amount),
        ]);

        // if ($user->temporaryWallets()->live()->where('rest_amount',">",0)->count() && $request->amount) {
        //     $temp_wallet = $user->temporaryWallets()->live()->where('rest_amount',">",0)->first();
        //
        //     $temp_wallet->update(['rest_amount' => max(0,($temp_wallet->rest_amount - $request->amount))]);
        // }

        $user_wallet = wallet_transaction($user , $request->amount , 'withdrawal' , $transaction);
        $another_user_wallet = wallet_transaction($another_user , $request->amount , 'charge' , $transaction);

        $user->update(['wallet' => $user_wallet]);
        $another_user->update(['wallet' => $another_user_wallet]);
        $fcm_data = [
            'title' => trans('api.messages.new_transfer_transaction_title'),
            'body' => trans('api.messages.new_transfer_transaction_body',['from' => $user->fullname ?? $user->phone , 'amount' => $request->amount]),
            'notify_type' => 'transfer_transaction',
            'transaction_id' => $transaction->id
        ];
        pushFcmNotes($fcm_data,[$another_user->id]);
        return (new MoneyTransferResource($transaction))->additional(['status' => 'success','message'=> trans('api.messages.success_transfer_from_ur_wallet_to_another',['amount' => $request->amount, 'another_user' => $another_user->fullname]), 'min_amount' => (float)setting('min_amount_in_transfer_transaction')]);
    }
}
