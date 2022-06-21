<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $guarded = ['id','created_at','updated_at'];
    protected $attributes = ['is_available' => 1];

    protected static function boot()
    {
        parent::boot();
        static::deleted(function ($data) {
            if (file_exists(storage_path('app/public/images/driver/'. $data->car_image))) {
                \File::delete(storage_path('app/public/images/driver/'. $data->car_image));
            }

            if (file_exists(storage_path('app/public/images/driver/'. $data->licence_image))) {
                \File::delete(storage_path('app/public/images/driver/'. $data->licence_image));
            }
        });
    }
    // Setter & Getter Attributes

    public function setCarImageAttribute($value)
    {
        if ($value) {
            if (isset($this->attributes['car_image']) && $this->attributes['car_image']) {
                if (file_exists(storage_path('app/public/images/driver/'. $this->attributes['car_image']))) {
                    \File::delete(storage_path('app/public/images/driver/'. $this->attributes['car_image']));
                }
            }
            $image = uploadImg($value,'driver');
            $this->attributes['car_image'] = $image;
        }
    }

    public function setLicenceImageAttribute($value)
    {
        if ($value) {
            if (isset($this->attributes['licence_image']) && $this->attributes['licence_image']) {
                if (file_exists(storage_path('app/public/images/driver/'. $this->attributes['licence_image']))) {
                    \File::delete(storage_path('app/public/images/driver/'. $this->attributes['licence_image']));
                }
            }
            $image = uploadImg($value,'driver');
            $this->attributes['licence_image'] = $image;
        }
    }

    public function getCarImageAttribute()
    {
        $image = $this->attributes['car_image'] ? 'storage/images/driver/'.$this->attributes['car_image'] : 'dashboardAsset/global/images/default.jpg';
        return asset($image);
    }

    public function getLicenceImageAttribute()
    {
        $image = $this->attributes['licence_image'] ? 'storage/images/driver/'.$this->attributes['licence_image'] : 'dashboardAsset/global/images/default.jpg';
        return asset($image);
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

    // Scope

    public function scopeNearest($query, $lat, $lng)
    {
        $lat = (float)$lat;
        $lng = (float)$lng;
        $space_search_by_kilos = (double)(convertArabicNumber(setting('search_distance')) ?? 2);
        $query->select(\DB::raw("*,
                (6371 * ACOS(COS(RADIANS($lat))
                * COS(RADIANS(lat))
                * COS(RADIANS($lng) - RADIANS(lng))
                + SIN(RADIANS($lat))
                * SIN(RADIANS(lat)))) AS distance"))
            ->having('distance', '<=', $space_search_by_kilos)
            ->orderBy('distance', 'asc');
    }

    // Relations

    // ======================User========================
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ======================PackageDriver Subscribed========================
    public function subscribedPackage()
    {
        return $this->belongsTo(PackageDriver::class,'subscribed_package_id');
    }
}
