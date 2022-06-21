<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderOffer extends Model
{
    protected $guarded = ['id','created_at','updated_at'];

    public function getPriceOfferStatusCssAttribute()
    {
        return @[
            'pending' => 'badge-primary',
            'accepted' => 'badge-success',
            'rejected' => 'badge-danger',
        ][$this->attributes['price_offer_status']];
    }

    public function driver()
    {
        return $this->belongsTo(User::class,'driver_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function acceptedOrder()
    {
        return $this->hasOne(Order::class,'accepted_offer_id');
    }
}
