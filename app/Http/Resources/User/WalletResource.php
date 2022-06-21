<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (auth('api')->user()->user_type == 'client') {
            $finished_orders = auth('api')->user()->clientOrders()->whereIn('order_status',['admin_finish','driver_finish','client_finish']);
        }else{
            $finished_orders = auth('api')->user()->driverOrders()->whereIn('order_status',['admin_finish','driver_finish','client_finish']);
        }
        $cash_query = clone($finished_orders);
        $wallet_query = clone($finished_orders);
        $cash_finished_orders = $cash_query->where('pay_type','cash');
        $wallet_finished_orders = $wallet_query->where('pay_type','wallet');

        return [
            'id' => $this->id,
            'wallet' => (float) $this->wallet,
            'tax' => (float) setting('tax'),
            'min_amount_charge_driver' => (float) setting('min_amount_charge_driver'),
            'min_amount_charge_client' => (float) setting('min_amount_charge_client'),
            'free_wallet_balance' => (float) $this->free_wallet_balance,
            'min_limit_withdrawal' => (float) (setting('min_limit_withdrawal') ?? 50),
            'dept_amount' => auth('api')->user()->user_dept_to_app ?  - (float) auth('api')->user()->user_dept_to_app : 0,
            'amount_of_on_account_for_user' => (float) setting('amount_of_on_account_for_user'),
            'can_borrow' => (float) setting('amount_of_on_account_for_user') - (float) auth('api')->user()->user_dept_to_app > 0,
            'amount_borrow' => (float) setting('amount_of_on_account_for_user') - (float) auth('api')->user()->user_dept_to_app,

            // All Transactions
            'history' => [
                [
                    'label' => trans('dashboard.history.created_at',['date' => auth('api')->user()->created_at->format("Y-m-d")])
                ],
                [
                    'label' => trans('dashboard.history.finished_orders',['count' => $finished_orders->count(),'total_price' => $finished_orders->sum('total_price')])
                ],
                [
                    'label' => trans('dashboard.history.cash_finished_orders', ['count' => $cash_finished_orders->count(), 'total_price' => $cash_finished_orders->sum('total_price')])
                ],
                [
                    'label' => trans('dashboard.history.wallet_finished_orders', ['count' => $wallet_finished_orders->count(), 'total_price' => $wallet_finished_orders->sum('total_price')])
                ],
                [
                    'label' => trans('dashboard.history.balance_lucky_box', ['count' => auth('api')->user()->luckyBoxes->where('gift_type','balance')->count(), 'total_price' => auth('api')->user()->luckyBoxes()->where('gift_type','balance')->sum('balance')])
                ],
                [
                    'label' => trans('dashboard.history.points_lucky_box', ['count' => auth('api')->user()->luckyBoxes->where('gift_type','points')->count(), 'total_price' => auth('api')->user()->luckyBoxes()->where('gift_type','points')->sum('points')])
                ],
                [
                    'label' => trans('dashboard.history.balance_withdrawal', [
                        'count' => auth('api')->user()->walletTransactions()->whereNotNull('iban_number')->where('transaction_type','withdrawal')->count(),
                        'refused' => auth('api')->user()->walletTransactions()->whereNotNull('iban_number')->where('transaction_type','withdrawal')->refused()->count(),
                        'total_price' => auth('api')->user()->walletTransactions()->whereNotNull('iban_number')->where('transaction_type','withdrawal')->transfered()->sum('amount')])
                ],
                [
                    'label' => trans('dashboard.history.balance_point_package', [
                        'count' => auth('api')->user()->walletTransactions()->where(['transaction_type' => 'charge', 'app_typeable_type' => 'App\Models\PointPackage'])->count(),
                        'total_price' => auth('api')->user()->walletTransactions()->where(['transaction_type' => 'charge', 'app_typeable_type' => 'App\Models\PointPackage'])->sum('amount')])
                ],
            ]
        ];
    }
}
