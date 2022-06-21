<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class LuckyBox extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = ['id','created_at','updated_at'];
    public $translatedAttributes = ['name','desc'];
    protected $dates = ['start_at', 'end_at'];

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($data) {
            if (request()->hasFile('image')) {
                if ($data->media()->exists()) {
                    $image = AppMedia::where(['app_mediaable_type' => 'App\Models\LuckyBox','app_mediaable_id' => $data->id ,'media_type' => 'image'])->first();
                    $image->delete();
                    if (file_exists(storage_path('app/public/images/lucky_box/'.$image->media))){
                        \File::delete(storage_path('app/public/images/lucky_box/'.$image->media));
                        $image->delete();
                    }
                }
                $image = uploadImg(request()->image,'lucky_box');
                $data->media()->create(['media' => $image,'media_type' => 'image']);
            }
        });

        static::deleted(function ($data) {
            if ($data->media()->exists()) {
                $image = AppMedia::where(['app_mediaable_type' => 'App\Models\LuckyBox','app_mediaable_id' => $data->id ,'media_type' => 'image'])->first();
                if (file_exists(storage_path('app/public/images/lucky_box/'.$image->media))){
                    \File::delete(storage_path('app/public/images/lucky_box/'.$image->media));
                }
                $image->delete();
            }
        });
    }

    public function getImageAttribute()
    {
        $image = $this->media()->exists() ? 'storage/images/lucky_box/'.$this->media()->first()->media : 'dashboardAssets/images/cover/cover_sm.png';
        return asset($image);
    }

    public function getOfferAttribute()
    {
        if (isset($this->attributes['gift_type'])) {
            switch ($this->attributes['gift_type']) {
                case 'points':
                    $offer = trans('dashboard.lucky_box.offers.points',['points' => $this->attributes['points'], 'user' => trans('dashboard.lucky_box.user_types.'.$this->attributes['user_type'])]);
                    break;
                case 'balance':
                    $offer = trans('dashboard.lucky_box.offers.balance',['balance' => $this->attributes['balance'], 'user' => trans('dashboard.lucky_box.user_types.'.$this->attributes['user_type'])]);
                    break;

                default:
                    $offer = @$this->desc;
                    break;
            }
            return $offer;
        }
    }

    public function setPointsAttribute($value)
    {
        if ($value) {
            $this->attributes['balance'] = null;
            $this->attributes['points'] = $value;
        }
    }

    public function setBalanceAttribute($value)
    {
        if ($value) {
            $this->attributes['points'] = null;
            $this->attributes['balance'] = $value;
        }
    }

    // Relations
    // ========================= Image ===================
    public function media()
    {
    	return $this->morphOne(AppMedia::class,'app_mediaable');
    }
    // scopes
    public function scopeActive($q)
    {
        $q->where('is_active',1);
    }

    public function scopeLive($query)
    {
        $query->whereDate('end_at','>=', date('Y-m-d'))->whereDate('start_at',"<=",date("Y-m-d"));
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'gift_user','lucky_box_id','user_id')->withPivot('order_id')->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(User::class,'gift_user','lucky_box_id','order_id')->withPivot('user_id')->withTimestamps();
    }
}
