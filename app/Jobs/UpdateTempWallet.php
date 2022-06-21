<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\{TemporaryWallet,User};
use Carbon\Carbon;

class UpdateTempWallet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 6000;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $wallet_temps = TemporaryWallet::finished()->where('is_expired',0)->chunk(100,function ($wallet_temps) {
            foreach ($wallet_temps as $wallet) {
                \DB::table('temporary_wallets')->where('id',$wallet->id)->update(['is_expired' => 1]);
                if ($wallet->rest_amount && ($wallet->user->wallet - $wallet->rest_amount) >= 0) {
                    $new_wallet = wallet_transaction($wallet->user, $wallet->rest_amount, 'withdrawal', $wallet);
                    \DB::table('users')->where('id',$wallet->user_id)->update(['wallet' => $new_wallet]);
                }elseif ($wallet->rest_amount && ($wallet->user->wallet - $wallet->rest_amount) < 0) {
                    $new_wallet = wallet_transaction($wallet->user, $wallet->user->wallet, 'withdrawal', $wallet);
                    \DB::table('users')->where('id',$wallet->user_id)->update(['wallet' => $new_wallet]);
                }
            }
        });
    }
}
