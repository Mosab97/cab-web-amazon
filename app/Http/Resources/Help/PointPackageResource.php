<?php

namespace App\Http\Resources\Help;

use Illuminate\Http\Resources\Json\JsonResource;

class PointPackageResource extends JsonResource
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
            'name' => $this->name,
            'image' => $this->image,
            'desc' => $this->desc,
            'type' => $this->transfer_type,
            'amount' => (float) $this->amount,
            'points' => (int) $this->points,
        ];
    }
}
