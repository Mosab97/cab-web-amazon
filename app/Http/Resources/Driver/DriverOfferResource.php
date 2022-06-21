<?php

namespace App\Http\Resources\Driver;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverOfferResource extends JsonResource
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
          'offer_id' => (int)$this->id,
          'driver_id' => (int)$this->driver_id,
          'created_at' => $this->created_at->format('Y-m-d'),
          'offer_price' => (string)$this->offer_price,
          'offer_status' => $this->price_offer_status,
          'cost_reason' => $this->cost_reason,
         ];
    }
}
