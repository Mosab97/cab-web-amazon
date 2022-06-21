<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarType extends Model implements TranslatableContract
{
    use Translatable , SoftDeletes;
    protected $guarded = ['id','created_at','updated_at','deleted_at'];
    public $translatedAttributes = ['name'];

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($data) {
            if (request()->hasFile('image')) {
                if ($data->media()->exists()) {
                    $image = AppMedia::where(['app_mediaable_type' => 'App\Models\CarType','app_mediaable_id' => $data->id ,'media_type' => 'image'])->first();
                    $image->delete();
                    if (file_exists(storage_path('app/public/images/car_type/'.$image->media))){
                        \File::delete(storage_path('app/public/images/car_type/'.$image->media));
                        $image->delete();
                    }
                }
                $image = uploadImg(request()->image,'car_type');
                $data->media()->create(['media' => $image,'media_type' => 'image']);
            }
        });

        static::deleted(function ($data) {
            if ($data->media()->exists()) {
                $image = AppMedia::where(['app_mediaable_type' => 'App\Models\CarType','app_mediaable_id' => $data->id ,'media_type' => 'image'])->first();
                if (file_exists(storage_path('app/public/images/car_type/'.$image->media))){
                    \File::delete(storage_path('app/public/images/car_type/'.$image->media));
                }
                $image->delete();
            }
        });
    }

    public function getImageAttribute()
    {
        $image = $this->media()->exists() ? 'storage/images/car_type/'.$this->media()->first()->media : 'dashboardAssets/images/cars/car1.png';
        return asset($image);
    }
    // Relations
    // ========================= Image ===================
    public function media()
    {
    	return $this->morphOne(AppMedia::class,'app_mediaable');
    }
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
