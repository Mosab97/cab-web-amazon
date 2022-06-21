<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\{Driver , Package , User};

class ChangePackageOfDrivers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $sub_data;
    public $timeout = 600;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($sub_data)
    {
        $this->sub_data = $sub_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $package = Package::findOrFail($this->sub_data['package_id']);
        $drivers = User::where('user_type','driver')->when(isset($this->sub_data['driver_list']) && $this->sub_data['driver_list'],function ($q) {
            $q->whereIn('id',$this->sub_data['driver_list']);
        })->when(isset($this->sub_data['status']) && $this->sub_data['status'],function ($q) {
            switch ($this->sub_data['status']) {
                case 'deactive':
                    $q->where('is_active',0);
                    break;
                case 'ban':
                    $q->where('is_ban',1);
                    break;
                case 'with_special_needs':
                    $q->where('is_with_special_needs',1);
                    break;
                case 'accepted':
                    $q->whereHas('driver',function ($q) {
                        $q->where('is_admin_accept',1);
                    });
                    break;
                case 'paid':
                    $q->whereHas('subscribedPackage',function ($q) {
                        $q->whereDate('package_drivers.end_at',">",date("Y-m-d"))->where('is_paid',1);
                    });
                    break;
                case 'wait_accept_drivers':
                    $q->whereHas('driver',function ($q) {
                        $q->where('is_admin_accept',0)->where(function ($q) {
                            $q->whereNull('accepted_status')->orWhere('accepted_status','waiting');
                        });
                    });
                    break;
                case 'refused_drivers':
                    $q->whereHas('driver',function ($q) {
                        $q->where('is_admin_accept',0)->where('accepted_status','refused');
                    });
                    break;
                case 'available':
                    $q->where(function ($q) {
                        $q->whereHas('driver',function ($q) {
                                $q->where('drivers.is_on_default_package',1)->where(['is_available' => 1 , 'is_driver_available' => 1 , 'is_admin_accept' => 1]);
                            })->where('wallet',">",-((float)setting('min_wallet_to_recieve_order')));
                    });
                    break;
                case 'disable_to_recieve_orders':
                    $q->where(function ($q) {
                        $q->whereHas('driver',function ($q) {
                            $q->where(['is_available' => 0]);
                        });
                    });
                    break;
                case 'enable_to_recieve_orders':
                    $q->where(function ($q) {
                        $q->whereHas('driver',function ($q) {
                            $q->where(['is_available' => 1]);
                        });
                    });
                    break;
                case 'not_developer_available':
                    $q->whereHas('driver',function ($q) {
                        $q->where(['is_available' => 1]);
                     });
                    break;
                case 'not_available':
                    // $q->whereHas('driver',function ($q) {
                    //     $q->where(['is_on_default_package' => true , 'is_admin_accept' => 1])
                    //         ->whereHas('user',function ($q) {
                    //              $q->where('wallet',"<=",-(setting('min_wallet_to_recieve_order') ?? 10));
                    //        });
                    //    });
                    $q->whereHas('driver',function ($q) {
                        $q->whereHas('subscribedPackage',function ($q) {
                            $q->whereDate('package_drivers.end_at',"<",date("Y-m-d"))->orWHere('package_drivers.is_paid',false);
                        })->orWhereNull('subscribed_package_id');
                    });
                    break;
                case 'drivers_subscribed_this_week':
                    $q->whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'both_type':
                    $q->whereHas('driver',function ($q) {
                        $q->where(['driver_type' => 'both']);
                     });
                    break;
                case 'delivery':
                    $q->whereHas('driver',function ($q) {
                        $q->where(['driver_type' => 'delivery']);
                     });
                    break;
                case 'ride':
                    $q->whereHas('driver',function ($q) {
                        $q->where(['driver_type' => 'ride']);
                     });
                    break;
                case 'monthly_drivers':
                    $q->whereHas('driver',function ($q) {
                        $q->where(['is_on_default_package' => 0]);
                     });
                    break;
                case 'on_order_drivers':
                    $q->whereHas('driver',function ($q) {
                        $q->where(['is_on_default_package' => 1]);
                     });
                    break;
                case 'has_balance_in_wallet':
                    $q->where('wallet',">",0);
                    break;
            }
        })->get();

        foreach ($drivers->chunk(100) as $chunk) {
            foreach ($chunk as $user) {
                $old_package = @$user->driver->subscribedPackage;
                if ($old_package && optional($old_package->end_at)->gt(now())) {
                    $old_package->update(['subscribe_status' => 'finished' , 'end_at' => now()]);
                }
                $sub_package = $user->driverPackages()->create([
                    'package_id' => $package->id,
                    'added_by_id' => auth()->id(),
                    'subscribed_at' => now(),
                    'end_at' => $this->sub_data['is_paid'] ? now()->addMonths(($package->duration + $package->free_duration)) : now(),
                    'price' => $package->package_price,
                    'is_paid' => $this->sub_data['is_paid'],
                    'is_paid_by_wallet' => false,
                    'subscribe_status' => 'subscribed',
                    'package_data' => $package->toJson(),
                    'driver_id' => $user->id,
                ]);
                \DB::table('drivers')->where('user_id',$user->id)->update(['subscribed_package_id' => $sub_package->id,'is_on_default_package' => 0]);
            }
        }
    }
}
