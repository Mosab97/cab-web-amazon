<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppOffer extends Model implements TranslatableContract
{
    use Translatable, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public $translatedAttributes = ['name', 'desc'];


    protected static function boot()
    {
        parent::boot();
        static::saved(function ($data) {
            if (request()->hasFile('image_ar')) {

                if ($data->media()->exists()) {
                    $image_ar = AppMedia::where(['app_mediaable_type' => 'App\Models\app_offer', 'app_mediaable_id' => $data->id, 'media_type' => 'image','option'=>'image_ar'])->first();
                    //$image_ar->delete();
                    if ($image_ar && file_exists(storage_path('app/public/images/app_offer/' . $image_ar->media))) {
                        \File::delete(storage_path('app/public/images/app_offer/' . $image_ar->media));
                       $image_ar->delete();
                    }
                }
                $image_ar = uploadImg(request()->image_ar, 'app_offer');
                $data->media()->create(['media' => $image_ar, 'media_type' => 'image','option'=>'image_ar']);

            }

            if (request()->hasFile('image_en')) {
                if ($data->media()->exists()) {
                    $image_en = AppMedia::where(['app_mediaable_type' => 'App\Models\app_offer', 'app_mediaable_id' => $data->id, 'media_type' => 'image','option'=>'image_en'])->first();
//                    dd($image_en);
                  //  $image_en->delete();
                    if ($image_en && file_exists(storage_path('app/public/images/app_offer/' . $image_en->media))) {
                        \File::delete(storage_path('app/public/images/app_offer/' . $image_en->media));
                        $image_en->delete();
                    }
                }
                $image_en = uploadImg(request()->image_en, 'app_offer');
                $data->media()->create(['media' => $image_en, 'media_type' => 'image','option'=>'image_en']);
            }
        });

        static::deleted(function ($data) {
            if ($data->media()->exists()) {
                $image = AppMedia::where(['app_mediaable_type' => 'App\Models\app_offer','app_mediaable_id' => $data->id ,'media_type' => 'image'])->first();
                if ($image) {
                    if (file_exists(storage_path('app/public/images/app_offer/'.$image->media))){
                        \File::delete(storage_path('app/public/images/app_offer/'.$image->media));
                    }
                    $image->delete();
                }
            }
        });
    }


    public function getImageArAttribute()
    {
        $image = $this->media()->exists() ? 'storage/images/app_offer/'.$this->media()->where('option','image_ar')->first()->media : 'dashboardAssets/images/cover/cars/car1.png';
        return asset($image);
    }
    public function getImageEnAttribute()
    {
        $image = $this->media()->exists() ? 'storage/images/app_offer/'.$this->media()->where('option','image_en')->first()->media : 'dashboardAssets/images/cover/cars/car1.png';
        return asset($image);
    }

    // scopes
    public function scopeActive($q)
    {
        $q->where('is_active',1);
    }






    //image relations
    public function media()
    {
        return $this->morphOne(AppMedia::class,'app_mediaable');
    }
}
