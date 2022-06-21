<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\{Order , User};

class SendOrderRequestToDriver implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    public $drivers;
    public $number_of_drivers;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order , $drivers , $number_of_drivers)
    {
        $this->order = $order;
        $this->drivers = $drivers;
        $this->number_of_drivers = $number_of_drivers;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         if (!$this->order->driver_id /*&& $this->order->offers->count()*/ && in_array($this->order->order_status ,['pending','client_recieve_offers']) && count($this->drivers) > 0) {
            if ($this->order->driverNotifiedOrders()->where('driver_order.status','notify')
            ->whereIn('driver_order.driver_id',$this->drivers)->exists()) {
                $drivers = User::where('user_type','driver')->whereIn('id',$this->drivers)->get();

                 $notified_drivers = $drivers->mapWithKeys(function ($item) {
                     $count = @optional($item->orderNotifiedDrivers()->firstWhere('driver_order.order_id',$this->order->id))->pivot->notify_number ?? 0;
                     if ($count >= ((int)convertArabicNumber(setting('driver_notify_count_to_refuse')) ?? 2)) {
                         return [$item['id'] => ['status' => 'refuse_reply' , 'notify_number' => ++$count]];
                     }else{
                         return [$item['id'] => ['status' => 'notify' , 'notify_number' => ++$count]];
                     }
                  })->toArray();

                $this->order->driverNotifiedOrders()->syncWithoutDetaching($notified_drivers);

                $new_drivers = $this->order->driverNotifiedOrders()->where('driver_order.status','notify')->pluck('users.id')->toArray();

                getOtherDrivers($this->order , $new_drivers , $this->number_of_drivers);
            }
        }
    }
}
