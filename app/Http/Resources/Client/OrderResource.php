<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Driver\CarResource;
use App\Models\LuckyBox;
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $status_trans = trans('dashboard.order.client.'.$this->order_type.".".$this->order_status);
        // if ($this->order_status == 'shipped' && $this->order_type == 'delivery') {
        //     $status_trans = trans('dashboard.order.statuses.driver_receive_order');
        // }elseif ($this->order_status == 'shipped' && $this->order_type == 'ride') {
        //     $status_trans = trans('dashboard.order.statuses.driver_shipped');
        // }elseif ($this->order_status == 'start_trip' && $this->order_type == 'delivery') {
        //     $status_trans = trans('dashboard.order.statuses.driver_has_order');
        // }elseif (in_array($this->order_status ,['client_finish','driver_finish','admin_finish']) && auth('api')->user()->user_type == 'client' && $this->order_type == 'delivery') {
        //     $status_trans = trans('dashboard.order.statuses.client_order_delivered');
        // }elseif (in_array($this->order_status ,['client_finish','driver_finish','admin_finish']) && auth('api')->user()->user_type == 'driver' && $this->order_type == 'delivery') {
        //     $status_trans = trans('dashboard.order.statuses.driver_order_delivered');
        // }
            $can_show_lucky_box = false;
        $user_types = [auth('api')->user()->user_type , 'client_and_driver'];
        $lucky_boxs = LuckyBox::whereIn('user_type',$user_types)->active()->live()->count();
        if($this->created_at->isToday() && $this->finished_at && $this->luckyBoxes()->where('gift_user.user_id',$this->client_id)->doesntExist() && $lucky_boxs){
            $can_show_lucky_box = true;
        }

        return [
          'id' => $this->id,
          'created_at' => $this->created_at->format('Y-m-d'),

          'total_price' => (string)$this->total_price,
          'order_status' => $this->order_status,
          'order_status_trans' => $status_trans,

          'order_type' => $this->order_type,
          'order_types_trans' => trans('dashboard.order.order_types.'.$this->order_type),
          'order_details' => (string) $this->order_details,

          'start_location' => $this->start_location_data,
          'end_location' => $this->end_location_data,

          'tip' => is_null($this->tip) ? $this->tip :(float)$this->tip,

          'badget' => (string)$this->budget,
          'expected_order_price' => (float)$this->expected_order_price,
          'pay_type' => (string)$this->pay_type,
          'share_link_uuid' => (string)$this->share_link_uuid,
          'share_link' => "",
          'is_client_recieved_order' => (boolean)$this->client_recieved_order,
          'has_offers' => $this->offers()->exists(),
          'is_client_rate' => $this->rates()->where('rates.client_id',auth('api')->id())->exists(),
        //   'can_show_lucky_boxes' => $this->created_at->isToday() && $this->finished_at && $this->luckyBoxes()->where('gift_user.user_id',$this->client_id)->doesntExist(),
          'can_show_lucky_boxes'=>$can_show_lucky_box,
          'offers_count' => $this->offers->count(),
          'offers' => OfferResource::collection($this->offers->take(5)),
          'accepted_offer' => new OfferResource($this->offers()->firstWhere('price_offer_status','accepted')),
          'driver' => $this->driver_id ? [
              'driver_id' => $this->driver_id,
              'city_id' => optional(optional($this->driver)->profile)->city_id,
              'city_name' => optional($this->driver)->city_name,
              'phone' => optional($this->driver)->phone,
              'fullname' => optional($this->driver)->fullname,
              'image' => optional($this->driver)->avatar,
              'is_infected' => (boolean)optional($this->driver)->is_infected,
              'is_with_special_needs' => (boolean)$this->is_with_special_needs,
              'rate' => (float)optional($this->driver)->rate_avg,
          ] : null,
          'car_data' => $this->car_id ? [
              'id' => @$this->car_id,
              'brand_id' => @$this->car->brand_id,
              'car_model_id' => @$this->car->car_model_id,
              'brand_name' => optional(@$this->car->brand)->name,
              'car_model_name' => optional(@$this->car->carModel)->name,
              'car_image' => @$this->car->car_front_image,
              'car_type_id' => optional(@$this->car->carType)->id,
              'car_type_name' => optional(@$this->car->carType)->name,
              'plate_number' => @$this->car->plate_number,
              ] : null
        ];
    }
}
