<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\User;
use Carbon\Carbon;

class UpdateWalletByTempBalance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user_type;
    public $data;
    public $timeout = 6000;
    public $user_list;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_type , $data , $user_list = [])
    {
        $this->user_type = $user_type;
        $this->data = $data;
        $this->user_list = $user_list;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $start_at = Carbon::parse($this->data['start_at']);
        $end_at = Carbon::parse($this->data['end_at']);
        $temp = $end_at->diffInMinutes($start_at);
        $minutes = $start_at->addMinutes($temp);
        $users = User::where('user_type',$this->user_type)->when($this->user_list,function ($q) {
            $q->whereIn('users.id',$this->user_list);
        })->chunk(100,function ($users) use($minutes){
            foreach ($users as $user) {
                $temp_wallet = $user->temporaryWallets()->create(array_except($this->data,['user_type'])+['wallet_before' => $user->wallet ,'wallet_after' => $user->wallet + $this->data['amount'],'rest_amount' => $this->data['amount']]);
                $new_wallet = wallet_transaction($user, $this->data['amount'], 'charge', $temp_wallet);
                // $user->update(['wallet' => $new_wallet]);
                \DB::table('users')->where('users.id',$user->id)->update(['wallet' => $new_wallet]);
            }
            UpdateTempWallet::dispatch()->delay($minutes)->onQueue('temp_balance');
        });
    }
}
