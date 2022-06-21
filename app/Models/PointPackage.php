<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointPackage extends Model implements TranslatableContract
{
    use Translatable , SoftDeletes;
    protected $guarded = ['id','created_at','updated_at','deleted_at'];
    public $translatedAttributes = ['name','desc'];

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($data) {
            if (request()->hasFile('image')) {
                if ($data->media()->exists()) {
                    $image = AppMedia::where(['app_mediaable_type' => 'App\Models\PointPackage','app_mediaable_id' => $data->id ,'media_type' => 'image'])->first();
                    $image->delete();
                    if (file_exists(storage_path('app/public/images/point_package/'.$image->media))){
                        \File::delete(storage_path('app/public/images/point_package/'.$image->media));
                        $image->delete();
                    }
                }
                $image = uploadImg(request()->image,'point_package');
                $data->media()->create(['media' => $image,'media_type' => 'image']);
            }
        });

        static::deleted(function ($data) {
            if ($data->media()->exists()) {
                $image = AppMedia::where(['app_mediaable_type' => 'App\Models\PointPackage','app_mediaable_id' => $data->id ,'media_type' => 'image'])->first();
                if (file_exists(storage_path('app/public/images/point_package/'.$image->media))){
                    \File::delete(storage_path('app/public/images/point_package/'.$image->media));
                }
                $image->delete();
            }
        });
    }

    public function getImageAttribute()
    {
        $image = $this->media()->exists() ? 'storage/images/point_package/'.$this->media()->first()->media : 'dashboardAssets/images/cover/cover_sm.png';
        return asset($image);
    }
    // scopes
    public function scopeActive($query)
    {
        $query->where('is_active',1);
    }
    // Relations
    // ========================= Image ===================
    public function media()
    {
    	return $this->morphOne(AppMedia::class,'app_mediaable');
    }

    public function walletTransactions()
    {
    	return $this->morphMany(WalletTransaction::class,'modelTypes','app_typeable_type','app_typeable_id');
    }

}
