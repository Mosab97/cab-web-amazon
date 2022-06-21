<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageDriver extends Model
{
    protected $guarded=['id','created_at','updated_at'];

    protected $dates=['subscribed_at','end_at'];
    protected $appends = ['name'];

    public function scopeCurrent($query)
    {
        $query->whereDate('end_at',  '>=', date('Y-m-d'));
    }

    public function scopeFinished($query)
    {
        $query->whereDate('end_at',  '<', date('Y-m-d'));
    }

    public function getSubscribeStatusAttribute()
    {
        $status = trans('dashboard.package.subscribe_statuses.finished');

        if (now()->lt($this->attributes['end_at']) && $this->attributes['subscribe_status'] == 'extended') {
            $status = trans('dashboard.package.subscribe_statuses.extended');
        }elseif (now()->lt($this->attributes['end_at']) && $this->attributes['subscribe_status'] == 'subscribed') {
            $status = trans('dashboard.package.subscribe_statuses.subscribed');
        }elseif (now()->gt($this->attributes['end_at']) && $this->attributes['subscribe_status'] == 'finished') {
            $status = trans('dashboard.package.subscribe_statuses.finished');
        }elseif (now()->lt($this->attributes['end_at']) && $this->attributes['subscribe_status'] == 'hold') {
            $status = trans('dashboard.package.subscribe_statuses.hold');
        }

        return $status;
    }

    public function getSubscribeStatusCssAttribute()
    {
        $status = 'badge-danger';

        if (now()->lt($this->attributes['end_at']) && $this->attributes['subscribe_status'] == 'extended') {
            $status = 'badge-primary';
        }elseif (now()->lt($this->attributes['end_at']) && $this->attributes['subscribe_status'] == 'subscribed') {
            $status = 'badge-success';
        }elseif (now()->gt($this->attributes['end_at']) && $this->attributes['subscribe_status'] == 'finished') {
            $status = 'badge-danger';
        }elseif (now()->lt($this->attributes['end_at']) && $this->attributes['subscribe_status'] == 'hold') {
            $status = 'badge-warning';
        }

        return $status;
    }
    public function getPaidStatusCssAttribute()
    {
        $status = 'text-danger';
        if ($this->attributes['is_paid']) {
            $status = 'text-success';
        }
        return $status;
    }

    public function getNameAttribute()
    {
        return trans('api.package.package_name',[
            'price' => @$this->package_data_array['package_price'],
            'currency' => trans('dashboard.currency.rs'),
            'duration' => in_array(@$this->package_data_array['duration'],[1,2]) ?  trans('api.package.months.'.$this->getTransOfMonth(@$this->package_data_array['duration'])) : @$this->package_data_array['duration'] . " " . trans('api.package.months.more'),
            'free' => (@$this->package_data_array['free_duration'] ? " + " . (!in_array(@$this->package_data_array['free_duration'] ,[1,2]) ? (@$this->package_data_array['free_duration'] . " " .  trans('api.package.months.'.$this->getTransOfMonth(@$this->package_data_array['free_duration']))) : trans('api.package.months.'.$this->getTransOfMonth(@$this->package_data_array['free_duration']))) ." ". trans('api.package.free') : null),
            'commission' => trans('api.package.commission',['commission' => @$this->package_data_array['commission']])
        ]);
    }

    public function getPackageDataArrayAttribute()
    {
        return json_decode($this->attributes['package_data'],true);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function drivers()
    {
        return $this->hasMany(User::class,'driver_id');
    }


    protected function getTransOfMonth($month)
    {
        $month_value = 'more';
        switch ($month) {
            case 1:
                $month_value = 'one';
                break;
            case 2:
                $month_value = 'two';
                break;
        }

        return $month_value;
    }
}
