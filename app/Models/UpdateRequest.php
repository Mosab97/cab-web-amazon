<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdateRequest extends Model
{
    protected $guarded = ['id','created_at','updated_at'];
    protected $dates = ['date_of_birth' , 'date_of_birth_hijri'];

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

    public function getCarFrontImageAssetAttribute()
    {
        $image = $this->attributes['car_front_image'] ? 'storage/images/car/'.$this->attributes['car_front_image'] : 'dashboardAsset/global/images/default.jpg';
        return asset($image);
    }

    public function getCarBackImageAssetAttribute()
    {
        $image = $this->attributes['car_back_image'] ? 'storage/images/car/'.$this->attributes['car_back_image'] : 'dashboardAsset/global/images/default.jpg';
        return asset($image);
    }

    public function getCarLicenceImageAssetAttribute()
    {
        $image = $this->attributes['car_licence_image'] ? 'storage/images/car/'.$this->attributes['car_licence_image'] : 'dashboardAsset/global/images/default.jpg';
        return asset($image);
    }

    public function getCarInsuranceImageAssetAttribute()
    {
        $image = $this->attributes['car_insurance_image'] ? 'storage/images/car/'.$this->attributes['car_insurance_image'] : 'dashboardAsset/global/images/default.jpg';
        return asset($image);
    }

    public function getCarFormImageAssetAttribute()
    {
        $image = $this->attributes['car_form_image'] ? 'storage/images/car/'.$this->attributes['car_form_image'] : 'dashboardAsset/global/images/default.jpg';
        return asset($image);
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

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
