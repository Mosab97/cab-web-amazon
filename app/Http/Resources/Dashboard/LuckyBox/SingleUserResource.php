<?php

namespace App\Http\Resources\Dashboard\LuckyBox;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleUserResource extends JsonResource
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
            'avatar' => $this->avatar,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'wallet' => $this->wallet,
            'notify_link' => route('dashboard.notification.store'),
            'show_link' => route('dashboard.'.$this->user_type.'.show',$this->id),
            'edit_link' => route('dashboard.'.$this->user_type.'.edit',$this->id),
            'destroy_link' => route('dashboard.'.$this->user_type.'.destroy',$this->id),
            'created_at' => $this->created_at->format("Y-m-d")
        ];
    }
}
