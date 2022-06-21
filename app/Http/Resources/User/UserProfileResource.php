<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Help\{CityResource,CountryResource};
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
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
            'phone' => (string)$this->phone,
            'email' => (string)$this->email,
            'image' => (string)$this->avatar,
            'test_version' => (string)setting('test_version'),
            'unread_notifications' => $this->unreadnotifications->count(),
            'is_subscribed_expired' => $this->when($this->user_type == 'driver',$this->driverPackages()->where('subscribe_status','subscribed')->whereDate('end_at',"<",date("Y-m-d"))->exists()),
            'date_of_birth' => $this->when($this->user_type == 'driver',optional($this->date_of_birth)->format("Y-m-d")),
            'date_of_birth_hijri' => $this->when($this->user_type == 'driver',optional($this->date_of_birth_hijri)->format("Y-m-d")),
            'identity_number' => $this->when($this->user_type == 'driver',$this->identity_number),
            'is_payment_showing' => setting('is_payment_showing') == 'enable' ? true : false,
            'wallet' => (float) $this->wallet,
            'user_points' => (int) $this->points,
            'free_wallet_balance' => (float) $this->free_wallet_balance,
            'dept_amount' => (float) $this->user_dept_to_app,
            'user_type' => (string)$this->user_type,
            'referral_code' => (string)$this->referral_code,
            'is_infected' => (boolean)$this->is_infected,
            'is_with_special_needs' => (boolean)$this->is_with_special_needs,
            'is_on_default_package' => $this->when($this->user_type == 'driver' , (boolean)(optional($this->driver)->is_on_default_package)),
            'is_driver_available' => $this->when($this->user_type == 'driver' , (boolean)(optional($this->driver)->is_driver_available)),
            'token' => $this->when($this->token,$this->token),
            'country' => optional($this->profile)->country_id ? new CountryResource($this->profile->country) : null,
            'city' => optional($this->profile)->city_id ? new CityResource($this->profile->city) : null,

        ];
    }
}
