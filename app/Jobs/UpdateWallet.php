<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\User;

class UpdateWallet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user_type;
    public $amount;
    public $timeout = 600;
    public $user_list;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_type , $amount , $user_list = [])
    {
        $this->user_type = $user_type;
        $this->amount = $amount;
        $this->user_list = $user_list;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::where('user_type',$this->user_type)->when($this->user_list,function ($q) {
            $q->whereIn('users.id',$this->user_list);
        })->chunk(100,function ($users) {
            foreach ($users as $user) {
                $new_wallet = wallet_transaction($user, $this->amount, 'charge');
                $user->update(['wallet' => $new_wallet,'free_wallet_balance' => $this->amount]);
            }
        });

    }
}
