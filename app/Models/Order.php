<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $guarded = ['id','created_at','updated_at','deleted_at'];
    protected $dates = ['finished_at'];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
          
            if ($model->order_type == 'delivery') {
                $model->load('carType');
                
                $model->budget = round(($model->distance * $model->carType->kilo_price) + $model->carType->counter_open); 
            
            }
        });
    }

    public function setOrderStatusAttribute($value)
    {
        $this->attributes['order_status'] = $value;
        if (isset($this->attributes['responsible_status_times']) && $this->attributes['responsible_status_times']) {
            $statuses = [];
            $old_statuses = json_decode($this->attributes['responsible_status_times'],true) ?? [];
            foreach ($old_statuses as $status) {
                $statuses[] = $status;
            }
            $statuses[] = ['status' => $value,'time' => date("Y-m-d H:i"),'responsible' => auth('api')->check() ? auth('api')->id() : (auth()->check() ? auth()->id() : null)];
            $this->attributes['responsible_status_times'] = json_encode($statuses);
        }else{
            $this->attributes['responsible_status_times'] = json_encode([
                [
                    'status' => $value,
                    'time' => date("Y-m-d H:i"),
                    'responsible' => auth('api')->check() ? auth('api')->id() : (auth()->check() ? auth()->id() : null)
                ]
            ]);
        }
    }


    public function setOrderStatusTimesAttribute($arr_value)
    {
        if (isset($this->attributes['order_status_times']) && $this->attributes['order_status_times']) {
            $statuses = json_decode($this->attributes['order_status_times']);
            foreach ($arr_value as $key => $value) {
                data_set($statuses , $key , $value);
            }
            $this->attributes['order_status_times'] = json_encode($statuses);
        }else{
            $this->attributes['order_status_times'] = json_encode($arr_value);
        }
    }

    public function setStartLocationAttribute($value)
    {
        if ($value) {
            $this->attributes['start_location'] = json_encode($value);
        }
    }

    public function setCarTypeIdAttribute($value)
    {
        if ($value) {
            $this->attributes['car_type_id'] = $value;
            $this->attributes['car_type_data'] = CarType::find($value)->toJson();
        }
    }
    public function setElmReplyAttribute($value)
    {
        if ($value) {
            $this->attributes['elm_reply'] = json_encode($value);
        }
    }

    public function getElmReplyAttribute()
    {
        return json_decode($this->attributes['elm_reply'],true);
    }


    public function setEndLocationAttribute($value)
    {
        if ($value) {
            $this->attributes['end_location'] = json_encode($value);
        }
    }

    public function getExpectedRouteAttribute()
    {
        if ($this->attributes['expected_route']) {
            $routes = json_decode($this->attributes['expected_route'],true);
            $new_routes = [];
            $new_routes[] = ['lat' => $this->start_location_data['lat'] , 'lng' => $this->start_location_data['lng'] ];
            if (is_array($routes)) {
                foreach ($routes as $route) {
                    $new_routes[] = ['lat' => $route['latitude'] , 'lng' => $route['longitude']];
                }
            }
            $new_routes[] = ['lat' => $this->end_location_data['lat'] , 'lng' => $this->end_location_data['lng'] ];
            return array_reverse($new_routes);
        }
    }

    public function getStartLocationDataAttribute()
    {
        if (is_string($this->attributes['start_location'])) {
            $start_location = json_decode($this->attributes['start_location'],true);
            foreach ($start_location as $key => $value) {
                if (in_array($key,['lat','lng'])) {
                    $start_location[$key] = (float) $value;
                }
            }
            return $start_location;
        }
        return [];
    }

    public function getEndLocationDataAttribute()
    {
        if (is_string($this->attributes['end_location'])) {
            $end_location = json_decode($this->attributes['end_location'],true);
            foreach ($end_location as $key => $value) {
                if (in_array($key,['lat','lng'])) {
                    $end_location[$key] = (float) $value;
                }
            }
            return $end_location;
        }
        return [];
    }

    public function getStartLatAttribute()
    {
        if ($this->start_location_data && isset($this->start_location_data['lat'])) {
            return $this->start_location_data['lat'];
        }
        return 0;
    }

    public function getStartLngAttribute()
    {
        if ($this->start_location_data && isset($this->start_location_data['lng'])) {
            return $this->start_location_data['lng'];
        }
        return 0;
    }

    public function getEndLatAttribute()
    {
        if ($this->end_location_data && isset($this->end_location_data['lat'])) {
            return $this->end_location_data['lat'];
        }
        return 0;
    }

    public function getEndLngAttribute()
    {
        if ($this->end_location_data && isset($this->end_location_data['lng'])) {
            return $this->end_location_data['lng'];
        }
        return 0;
    }

    public function getOrderStatusTimesAttribute()
    {
        return $this->attributes['order_status_times'] ? json_decode($this->attributes['order_status_times']) : [];
    }

    public function driverNotifiedOrders()
    {
        return $this->belongsToMany(User::class,'driver_order','order_id','driver_id')->withPivot('status','notify_number')->withTimestamps();
    }
    //order belongs to one user
    public function client()
    {
        return $this->belongsTo(User::class,"client_id");
    }

    public function driver()
    {
        return $this->belongsTo(User::class,'driver_id');
    }

    public function acceptedOffer()
    {
        return $this->belongsTo(OrderOffer::class,'accepted_offer_id');
    }

    public function cancelReason()
    {
        return $this->belongsTo(CancelReason::class,'cancel_reason_id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function offers()
    {
        return $this->hasMany(OrderOffer::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function messages()
    {
        return $this->hasManyThrough(Message::class,Chat::class);
    }

    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }

    //==========================Rates==================

    public function rates()
    {
        return $this->hasMany(Rate::class,'order_id');
    }

    public function walletTransactions()
    {
    	return $this->morphMany(WalletTransaction::class,'modelTypes','app_typeable_type','app_typeable_id');
    }

    public function luckyBoxes()
    {
        return $this->belongsToMany(LuckyBox::class,'gift_user','order_id','lucky_box_id')->withPivot('user_id')->withTimestamps();
    }
}
