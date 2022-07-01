<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodTrackResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => (string)$this->name,
            'description' => (string)$this->description,
            'rate' => (float)$this->rate,
            'image' => $this->image,
            'cover_image' => $this->cover_image,
        ];
    }
}
