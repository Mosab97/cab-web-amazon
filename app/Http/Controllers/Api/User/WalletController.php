<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Wallet\{ChargeWalletRequest , WithDrawalWalletRequest};
use App\Http\Resources\User\{WalletResource , WalletTransactionResource};
use App\Models\{User , WalletTransaction};

class WalletController extends Controller
{
    public function index()
    {
        $user = auth('api')->user();
        $message = '';
        if ($user->user_type == 'client' && $user->user_dept_to_app) {
            $message = trans('api.messages.please_charge_wallet_to_pay_off',['amount' => $user->user_dept_to_app]);
        }
        return (new WalletResource($user))->additional(['status' => 'success','message'=> $message ,'tax' => (float) setting('tax')]);
    }

    public function getIbans()
    {
        $user = auth('api')->user();
        $ibans = $user->walletTransactions()->whereNotNull('iban_number')->distinct('iban_number')->pluck('iban_number')->toArray();
        return response()->json(['data' => ['ibans' => $ibans] , 'status' => 'success','message'=>'']);
    }


    public function chargeWallet(ChargeWalletRequest $request)
    {
        $user = auth('api')->user();
        $amount = $request->amount;
        $dept = $user->user_dept_to_app;
        $wallet_data = [];
        if ($dept) {
            $rest_dept = max(($dept - $amount),0);
            $wallet_data = ['user_dept_to_app' => $rest_dept];
            $amount = max(($amount - $dept),0);

            if ($rest_dept == 0 && $user->salfnyLogs()->where('is_paid',0)->exists()) {
               $user->salfnyLogs()->update(['is_paid' => 1, 'paid_at' =>now()]);
            }
        }

        $wallet = $user->wallet;
        $before_wallet_charge = ['wallet_before' => $wallet, 'wallet_after' => ($wallet + $amount) , 'transaction_type' => 'charge' , 'added_by_id' => $user->id];
        $transaction = $user->walletTransactions()->create($request->validated()+$before_wallet_charge);

        $user->update($wallet_data + ['wallet' => $transaction->wallet_after]);

        return (new WalletTransactionResource($transaction))->additional(['status' => 'success','message'=> trans('api.messages.success_charge')]);
    }

    public function withdrawalWallet(WithDrawalWalletRequest $request)
    {
        $user = auth('api')->user();
        if ($user->wallet < $request->amount) {
            return response()->json(['status' => 'fail' , 'data' => null , 'message' => trans('api.messages.ur_wallet_lt_amount')],422);
        }
        $free_wallet_balance = ($user->free_wallet_balance - $request->amount) <= 0 ? 0 : ($user->free_wallet_balance - $request->amount);
        $withdrawal_free = 0;
        if ($request->amount >= $user->free_wallet_balance) {
            $withdrawal_free = $request->amount;
        }else{
            $withdrawal_free = $user->free_wallet_balance;
        }
        $before_wallet_charge = ['wallet_before' => $user->wallet , 'wallet_after' => ($user->wallet - $request->amount) , 'transaction_type' => 'withdrawal' ,'free_wallet_balance' => $withdrawal_free, 'added_by_id' => $user->id];
        $transaction = $user->walletTransactions()->create($request->validated()+$before_wallet_charge);
        $user->update(['wallet' => $transaction->wallet_after,'free_wallet_balance' => $free_wallet_balance]);
        return (new WalletTransactionResource($transaction))->additional(['status' => 'success','message'=> trans('api.messages.success_withdrawal')]);
    }
}
