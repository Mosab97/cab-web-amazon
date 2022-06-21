<?php

namespace App\Http\Resources\Help;

use Illuminate\Http\Resources\Json\JsonResource;

class AppAdResource extends JsonResource
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
            'media_type' => $this->video_url ? 'video' : 'image',
            'image' => $this->image,
            'media_url' => $this->video_url ?? $this->image,
        ];
    }
}
