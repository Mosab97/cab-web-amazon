<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Package extends Model implements TranslatableContract
{
    use SoftDeletes, Translatable;
    protected $guarded=['id','created_at','updated_at','deleted_at'];
    protected $attributes = ['free_duration' => 1 , 'is_active' => false];
    protected $dates = ['start_discount_at','end_discount_at','start_extend_at','end_extend_at'];
    public $translatedAttributes = ['name','desc'];
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return @$this->translate()->name ?? trans('api.package.package_name',[
            'price' => @$this->attributes['package_price'],
            'currency' => trans('dashboard.currency.rs'),
            'duration' => in_array(@$this->attributes['duration'],[1,2]) ?  trans('api.package.months.'.$this->getTransOfMonth(@$this->attributes['duration'])) : @$this->attributes['duration'] . " " . trans('api.package.months.more'),
            'free' => (@$this->attributes['free_duration'] ? " + " . (!in_array(@$this->attributes['free_duration'] ,[1,2]) ? (@$this->attributes['free_duration'] . " " .  trans('api.package.months.'.$this->getTransOfMonth(@$this->attributes['free_duration']))) : trans('api.package.months.'.$this->getTransOfMonth(@$this->attributes['free_duration']))) ." ". trans('api.package.free') : null),
           'commission' => trans('api.package.commission',['commission' => @$this->attributes['commission']])]);
    }

    // Scopes
    public function scopeActive($query)
    {
        $query->where(['is_active' => 1]);
    }

    public function drivers()
    {
        return $this->belongsToMany(User::class,'package_drivers','package_id','driver_id')->withPivot('subscribed_at','end_at','is_paid','subscribe_status')->withTimestamps();
    }

    public function subscribers()
    {
        return $this->hasMany(PackageDriver::class,'package_id');
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
