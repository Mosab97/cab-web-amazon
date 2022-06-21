<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppAd extends Model implements TranslatableContract
{
    use Translatable , SoftDeletes;
    protected $guarded = ['id','created_at','updated_at','deleted_at'];
    public $translatedAttributes = ['name','desc'];
    protected $dates = ['start_at','end_at'];

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($data) {
            if (request()->hasFile('image_ar')) {
                if ($data->media()->where(['app_mediaable_type' => 'App\Models\AppAd','app_mediaable_id' => $data->id ,'media_type' => 'image','option' => 'image_ar'])->exists()) {
                    $image = AppMedia::where(['app_mediaable_type' => 'App\Models\AppAd','app_mediaable_id' => $data->id ,'media_type' => 'image','option' => 'image_ar'])->first();
                    $image->delete();
                    if (file_exists(storage_path('app/public/images/app_ad/'.$image->media))){
                        \File::delete(storage_path('app/public/images/app_ad/'.$image->media));
                        $image->delete();
                    }
                }
                $image = uploadImg(request()->image_ar,'app_ad');
                $data->media()->create(['media' => $image,'media_type' => 'image','option' => 'image_ar']);
            }
            if (request()->hasFile('image_en')) {
                if ($data->media()->where(['app_mediaable_type' => 'App\Models\AppAd','app_mediaable_id' => $data->id ,'media_type' => 'image','option' => 'image_en'])->exists()) {
                    $image = AppMedia::where(['app_mediaable_type' => 'App\Models\AppAd','app_mediaable_id' => $data->id ,'media_type' => 'image','option' => 'image_en'])->first();
                    $image->delete();
                    if (file_exists(storage_path('app/public/images/app_ad/'.$image->media))){
                        \File::delete(storage_path('app/public/images/app_ad/'.$image->media));
                        $image->delete();
                    }
                }
                $image = uploadImg(request()->image_en,'app_ad');
                $data->media()->create(['media' => $image,'media_type' => 'image','option' => 'image_en']);
            }

            if (request()->hasFile('video')) {
                if ($data->media()->where(['app_mediaable_type' => 'App\Models\AppAd','app_mediaable_id' => $data->id ,'media_type' => 'video'])->exists()) {
                    $video = AppMedia::where(['app_mediaable_type' => 'App\Models\AppAd','app_mediaable_id' => $data->id ,'media_type' => 'video'])->first();
                    $video->delete();
                    if (file_exists(storage_path('app/public/images/app_ad/'.$video->media))){
                        \File::delete(storage_path('app/public/images/app_ad/'.$video->media));
                        $video->delete();
                    }
                }
                $video = uploadFile(request()->video,'app_ad');
                $data->media()->create(['media' => $video,'media_type' => 'video']);
            }
        });

        static::deleted(function ($data) {
            if ($data->media()->exists()) {
                $image = AppMedia::where(['app_mediaable_type' => 'App\Models\AppAd','app_mediaable_id' => $data->id ,'media_type' => 'image'])->first();
                if (file_exists(storage_path('app/public/images/app_ad/'.$image->media))){
                    \File::delete(storage_path('app/public/images/app_ad/'.$image->media));
                }
                $image->delete();
            }

            if ($data->video_url && file_exists(storage_path('app/public/images/app_ad/'.$data->video_url))){
                \File::delete(storage_path('app/public/images/app_ad/'.$data->video_url));
            }
        });
    }

    public function getImageAttribute()
    {
        $image = $this->media()->exists() ? 'storage/images/app_ad/'.$this->media()->where('option','image_'.app()->getLocale())->first()->media : 'dashboardAssets/images/cover/cover_sm.png';
        return asset($image);
    }

    public function getImageArAttribute()
    {
        $image = $this->media()->where('media_type' , 'image')->exists() ? 'storage/images/app_ad/'.$this->media()->where('media_type' , 'image')->where('option','image_ar')->first()->media : 'dashboardAssets/images/cover/cover_sm.png';
        return asset($image);
    }

    public function getImageEnAttribute()
    {
        $image = $this->media()->where('media_type' , 'image')->exists() ? 'storage/images/app_ad/'.$this->media()->where('media_type' , 'image')->where('option','image_en')->first()->media : 'dashboardAssets/images/cover/cover_sm.png';
        return asset($image);
    }


    public function setVideoUrlAttribute($value)
    {
        if ($value && $value->isValid()) {
            if (isset($this->attributes['video_url']) && $this->attributes['video_url']) {
                if (file_exists(storage_path('app/public/files/app_ad/'.$this->attributes['video_url']))){
                    \File::delete(storage_path('app/public/files/app_ad/'.$this->attributes['video_url']));
                }
            }
            $video = uploadFile($value,'app_ad');
            $this->attributes['video_url'] = $video;
        }
    }

    public function getVideoUrlAttribute()
    {
        if (isset($this->attributes['video_url']) && $this->attributes['video_url']) {
            return asset("storage/files/app_ad/".$this->attributes['video_url']);
        }
    }
    
    // scopes
    public function scopeActive($q)
    {
        $q->where('is_active',1);
    }


    public function scopeCurrent($query)
    {
        $query->whereDate('end_at',  '>=', date('Y-m-d'));
    }

    public function scopeFinished($query)
    {
        $query->whereDate('end_at',  '<', date('Y-m-d'));
    }

    public function scopeLive($query)
    {
        $query->whereDate('end_at','>=', date('Y-m-d'))->whereDate('start_at',"<=",date("Y-m-d"));
    }

    // Relations
    // ========================= Image ===================
    public function media()
    {
    	return $this->morphMany(AppMedia::class,'app_mediaable');
    }
}
