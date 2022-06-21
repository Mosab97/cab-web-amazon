<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;
    protected $guarded = ['id','created_at','updated_at','deleted_at'];
    public $appends = ['name','car_front_image'];

    public function setCarFrontImageAttribute($value)
    {
        if ($value) {
            if (isset($this->attributes['car_front_image']) && $this->attributes['car_front_image']) {
                if (file_exists(storage_path('app/public/images/car/'. $this->attributes['car_front_image']))) {
                    \File::delete(storage_path('app/public/images/car/'. $this->attributes['car_front_image']));
                }
            }
            $image = uploadImg($value,'car');
            $this->attributes['car_front_image'] = $image;
        }
    }

    public function setCarBackImageAttribute($value)
    {
        if ($value) {
            if (isset($this->attributes['car_back_image']) && $this->attributes['car_back_image']) {
                if (file_exists(storage_path('app/public/images/car/'. $this->attributes['car_back_image']))) {
                    \File::delete(storage_path('app/public/images/car/'. $this->attributes['car_back_image']));
                }
            }
            $image = uploadImg($value,'car');
            $this->attributes['car_back_image'] = $image;
        }
    }

    public function setCarLicenceImageAttribute($value)
    {
        if ($value) {
            if (isset($this->attributes['car_licence_image']) && $this->attributes['car_licence_image']) {
                if (file_exists(storage_path('app/public/images/car/'. $this->attributes['car_licence_image']))) {
                    \File::delete(storage_path('app/public/images/car/'. $this->attributes['car_licence_image']));
                }
            }
            $image = uploadImg($value,'car');
            $this->attributes['car_licence_image'] = $image;
        }
    }

    public function setCarInsuranceImageAttribute($value)
    {
        if ($value) {
            if (isset($this->attributes['car_insurance_image']) && $this->attributes['car_insurance_image']) {
                if (file_exists(storage_path('app/public/images/car/'. $this->attributes['car_insurance_image']))) {
                    \File::delete(storage_path('app/public/images/car/'. $this->attributes['car_insurance_image']));
                }
            }
            $image = uploadImg($value,'car');
            $this->attributes['car_insurance_image'] = $image;
        }
    }

    public function setCarFormImageAttribute($value)
    {
        if ($value) {
            if (isset($this->attributes['car_form_image']) && $this->attributes['car_form_image']) {
                if (file_exists(storage_path('app/public/images/car/'. $this->attributes['car_form_image']))) {
                    \File::delete(storage_path('app/public/images/car/'. $this->attributes['car_form_image']));
                }
            }
            $image = uploadImg($value,'car');
            $this->attributes['car_form_image'] = $image;
        }
    }

    public function getCarFrontImageAttribute()
    {
        $image = $this->attributes['car_front_image'] ? 'storage/images/car/'.$this->attributes['car_front_image'] : 'dashboardAsset/global/images/default.jpg';
        return asset($image);
    }

    public function getCarBackImageAttribute()
    {
        $image = $this->attributes['car_back_image'] ? 'storage/images/car/'.$this->attributes['car_back_image'] : 'dashboardAsset/global/images/default.jpg';
        return asset($image);
    }

    public function getCarLicenceImageAttribute()
    {
        $image = $this->attributes['car_licence_image'] ? 'storage/images/car/'.$this->attributes['car_licence_image'] : 'dashboardAsset/global/images/default.jpg';
        return asset($image);
    }

    public function getCarInsuranceImageAttribute()
    {
        $image = $this->attributes['car_insurance_image'] ? 'storage/images/car/'.$this->attributes['car_insurance_image'] : 'dashboardAsset/global/images/default.jpg';
        return asset($image);
    }

    public function getCarFormImageAttribute()
    {
        $image = $this->attributes['car_form_image'] ? 'storage/images/car/'.$this->attributes['car_form_image'] : '/dashboardAsset/global/images/default.jpg';
        return asset($image);
    }

    public function getNameAttribute()
    {
        return @$this->brand->name && @$this->carModel->name ? $this->brand->name .' - '. $this->carModel->name : $this->attributes['license_serial_number'];
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function carModel()
    {
        return $this->belongsTo(CarModel::class);
    }

    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class,'driver_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


}
