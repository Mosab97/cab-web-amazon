<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\{User};
use App\Services\{WaslElmService};

class UpdateDriverLocation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels , WaslElmService;

    public $data;
    public $timeout = 600;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->data as $driver){
            if ($driver) {
                $user = User::where('user_type','driver')->find($driver->driver_id);
                if($user){
                    $user->driver()->updateOrCreate(['user_id' => $user->id],['lat' => $driver->lat , 'lng' => $driver->lng]);
                    if (in_array(optional($driver)->type,['ios','android']) && optional($driver)->device_token) {
                        if (optional($user->profile)->last_login_at) {
                            $user->driver()->updateOrCreate(['user_id' => $user->id],['type' => $driver->type , 'device_token' => $driver->device_token]);
                        }
                    }
                    // if (@$user->driver->is_signed_to_elm && $user->driverOrders()->whereIn('order_status',['shipped','start_trip'])->count()) {
                    //     $this->updateDriverLocation($user);
                    // }
                }
            }
        }
    }
}
