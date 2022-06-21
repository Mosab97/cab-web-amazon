<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\{WalletResource , WalletTransactionResource};
use App\Http\Requests\Api\Client\{ClientBorrowFromAppRequest};
use App\Models\{AppAd, User};

class ClientController extends Controller
{
    public function borrowFromApp(ClientBorrowFromAppRequest $request)
    {
        $user = auth('api')->user();
        if ($user->user_dept_to_app) {
            $message = trans('api.messages.please_charge_wallet_to_pay_off',['amount' => $user->user_dept_to_app]);
            return (new WalletResource($user))->additional(['status' => 'fail','message'=> $message ,'tax' => (float) setting('tax') ,'min_amount_charge_client' => (float) setting('min_amount_charge_client') ,'min_amount_charge_driver' => (float) setting('min_amount_charge_driver') ],422);
        }elseif ($user->wallet > (float)setting('min_amount_in_wallet_to_use_salfni')) {
            $message = trans('api.messages.ur_wallet_balance_not_prmit_use_salfni',['amount' => (float)setting('min_amount_in_wallet_to_use_salfni')]);
            return (new WalletResource($user))->additional(['status' => 'fail','message'=> $message ,'tax' => (float) setting('tax') ,'min_amount_charge_client' => (float) setting('min_amount_charge_client') ,'min_amount_charge_driver' => (float) setting('min_amount_charge_driver') ],422);
        }
        \DB::beginTransaction();
        try {
            if (($user->user_dept_to_app + $request->dept_amount) <= ((float) setting('amount_of_on_account_for_user'))) {
                $user->update(['user_dept_to_app' => ($user->user_dept_to_app + $request->dept_amount) , 'wallet' => ($user->wallet + $request->dept_amount)]);


                 $user->salfnyLogs()->create([
                     'amount' => $request->dept_amount,
                     'wallet_before' => $user->wallet,
                     'wallet_after' => ($user->wallet+$request->dept_amount),
                     'setting_salfny_amount' => (float)setting('amount_of_on_account_for_user')
                  ]);

                \DB::commit();
                return (new WalletResource($user))->additional([
                    'status' => 'success',
                    'message'=> trans('api.messages.success_add_amount_to_ur_wallet',['amount' => $request->dept_amount]),
                    'tax' => (float) setting('tax'),
                    'min_amount_charge_client' => (float) setting('min_amount_charge_client') ,
                    'min_amount_charge_driver' => (float) setting('min_amount_charge_driver')
                ]);
            }
            return response()->json(['status' => 'fail' , 'message' => trans('api.messages.reach_max_withdrawal_limit') , 'data' => null],422);
        }catch (\Exception $e) {
           \DB::rollback();
           \Log::info($e->getMessage());
           return response()->json(['status' => 'fail' , 'message' => trans('dashboard.messages.something_went_wrong_please_try_again') , 'data' => null],500);
        }

    }


    public function getAdd(){
        $adds =  AppAd::get();
        $adds_ = [];
        foreach ($adds as $as){
            $as['image_ar'] = $as->image_ar;
            $as['image_en'] = $as->image_en;

            array_push($adds_ , $as);

        }
        return response()->json([
            'code' => 1,
            'message' => "success",
            'errors' => [],
            'data' => $adds_
        ]);
    }


}
