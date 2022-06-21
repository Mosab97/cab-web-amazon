<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
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
          'fullname' => $this->fullname,
          'avatar' => $this->avatar,
          'lat' => $this->driver->lat,
          'lng' => $this->driver->lng,
          'is_infected' => (boolean)$this->driver->is_infected,
        ];
    }
}
