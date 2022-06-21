<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\General\FCMNotification;
use App\Models\{User , PackageDriver , Driver , WalletHelp};

class CheckSubscribtionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribtion:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Drivers Subscribtion for renew or not.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Artisan::call('optimize:clear');
        \DB::table('notifications')->whereDate('created_at',"<=",now()->subDays(10)->format("Y-m-d"))->delete();
        \DB::statement('OPTIMIZE TABLE notifications');
        $drivers = User::where('user_type','driver')->whereHas('driver',function ($q) {
            $q->whereHas('subscribedPackage',function ($q) {
                $q->whereDate('package_drivers.end_at',"<=",now()->addDays(3)->format("Y-m-d"));
            });
        })->get();

        if (((float)setting('amount_of_special_needs_help')) > 0 && ((int)setting('number_of_days_to_update_special_needs_client_wallet')) > 0) {
            $wallet_users_id = WalletHelp::latest()->distinct('user_id')->whereDate('created_at',">",now()->subDays((int)setting('number_of_days_to_update_special_needs_client_wallet'))->format("Y-m-d"))->pluck('user_id');
            $special_clients = User::where(['user_type' => 'client' , 'is_with_special_needs' => 1])->where(function ($q) use($wallet_users_id) {
                $q->doesntHave('walletHelps')->orWhereIn('users.id',$wallet_users_id);
            })->get();

            $special_clients->update(['wallet' => \DB::raw('wallet + '. ((float)setting('amount_of_special_needs_help')))]);

            foreach ($special_clients as $client) {
                $client->walletHelps()->create(['amount' => ((float)setting('amount_of_special_needs_help'))]);
            }

        }

        // Driver::whereHas('subscribedPackage',function ($q) {
        //         $q->whereDate('package_drivers.end_at',"<",now()->format("Y-m-d"));
        //     })->update(['is_on_default_package' => true]);

        PackageDriver::where('subscribe_status','subscribed')->whereDate('end_at',"<",now()->format("Y-m-d"))->update(['subscribe_status' => 'finished']);

        $fcm_data = [
            'title' => trans('dashboard.fcm.sub_package_title'),
            'body' => trans('dashboard.fcm.sub_package_body'),
            'notify_type' => 'subscribtion_check',
        ];
        if ($drivers->count()) {
            pushFcmNotes($fcm_data,$drivers->pluck('id')->toArray());
            \Notification::send($drivers,new FCMNotification($fcm_data,['database']));
        }
    }
}
