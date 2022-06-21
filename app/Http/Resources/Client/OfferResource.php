<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'order_id' => $this->order_id,
          'created_at' => $this->created_at->format('Y-m-d'),
          'offer_status' => $this->price_offer_status ?? 'pending',
          'cost_reason' => $this->cost_reason,
          'offer_price' => (string)$this->offer_price,

          'driver_data' => [
              'driver_id' => $this->driver_id,
              'fullname' => optional($this->driver)->fullname,
              'phone' => optional($this->driver)->phone,
              'avatar' => optional($this->driver)->avatar,
              'is_infected' => (boolean)optional($this->driver)->is_infected,
              'is_with_special_needs' => (boolean)optional($this->driver)->is_with_special_needs,
              'rate_percentage' => (float)optional($this->driver)->user_rate_percentage,
              'rate' => (float)optional($this->driver)->rate_avg,
          ],
          'car_data' => [
              'id' => optional(@$this->driver->car)->id,
              'brand_id' => optional(@$this->driver->car)->brand_id,
              'car_model_id' => optional(@$this->driver->car)->car_model_id,
              'brand_name' => optional(optional(@$this->driver->car)->brand)->name,
              'car_model_name' => optional(optional(@$this->driver->car)->carModel)->name,
              'car_image' => optional(@$this->driver->car)->car_front_image,
              'car_type_id' => optional(optional(@$this->driver->car)->carType)->id,
              'car_type_name' => optional(optional(@$this->driver->car)->carType)->name,
              'plate_number' =>optional(@$this->driver->car)->plate_number,
          ],
        ];
    }
}
