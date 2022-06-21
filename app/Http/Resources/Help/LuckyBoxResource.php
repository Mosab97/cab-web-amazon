<?php

namespace App\Http\Resources\Help;

use Illuminate\Http\Resources\Json\JsonResource;

class LuckyBoxResource extends JsonResource
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
            'desc' => $this->desc,
            'image' => $this->image,
            'gift_type' => $this->gift_type,
            'points' => $this->points,
            'balance' => $this->balance
        ];
    }
}
