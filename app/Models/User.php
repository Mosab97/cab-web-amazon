<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $guarded = ['id','created_at','updated_at','deleted_at'];
    protected $appends = ['avatar','image' , 'name'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime' , 'phone_verified_at' => 'datetime'];
    protected $dates = ['date_of_birth' , 'date_of_birth_hijri'];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($data) {
            if (request()->hasFile('health_certificate')) {
                if ($data->media()->exists()) {
                    $image = AppMedia::where(['app_mediaable_type' => 'App\Models\User','app_mediaable_id' => $data->id])->first();
                    $image->delete();
                    if (file_exists(storage_path('app/public/images/user/'.$image->media))){
                        \File::delete(storage_path('app/public/images/user/'.$image->media));
                    }elseif (file_exists(storage_path('app/public/files/user/'.$image->media))){
                        \File::delete(storage_path('app/public/files/user/'.$image->media));
                    }
                }
                if (request()->health_certificate->getClientMimeType() == 'application/pdf') {
                    $image = uploadFile(request()->health_certificate,'user');
                    $data->media()->create(['media' => $image,'media_type' => 'file','option' => 'health_certificate']);
                }elseif (in_array(request()->health_certificate->getClientMimeType(),['image/jpeg','image/jpg','image/gif','image/png','image/bmp','image/svg+xml'])) {
                    $image = uploadImg(request()->health_certificate,'user');
                    $data->media()->create(['media' => $image,'media_type' => 'image','option' => 'health_certificate']);
                }
            }
        });


        static::deleted(function ($data) {
            if (file_exists(storage_path('app/public/images/user/'. $data->image))) {
                \File::delete(storage_path('app/public/images/user/'. $data->image));
            }
            if (file_exists(storage_path('app/public/images/user/'. $data->cover))) {
                \File::delete(storage_path('app/public/images/user/'. $data->cover));
            }

            if ($data->media()->where(['option' => 'health_certificate'])->exists()) {
                $image = AppMedia::where(['app_mediaable_type' => 'App\Models\User','app_mediaable_id' => $data->id , 'option' => 'health_certificate'])->first();
                $image->delete();
                if (file_exists(storage_path('app/public/images/user/'.$image->media))){
                    \File::delete(storage_path('app/public/images/user/'.$image->media));
                }elseif (file_exists(storage_path('app/public/files/user/'.$image->media))){
                    \File::delete(storage_path('app/public/files/user/'.$image->media));
                }
            }

        });
    }

    public function getHealthCertificateAttribute()
    {
        if($this->media()->exists() && $this->media()->first()->media_type == 'image'){
            return asset('storage/images/user/'.$this->media()->first()->media);
        }elseif ($this->media()->exists() && $this->media()->first()->media_type == 'file') {
            return asset('storage/files/user/'.$this->media()->first()->media);
        }
    }

    public function getHealthCertificateTypeAttribute()
    {
        if($this->media()->exists() && $this->media()->first()->media_type == 'image'){
            return 'image';
        }elseif ($this->media()->exists() && $this->media()->first()->media_type == 'file') {
            return 'file';
        }
    }


    // Setter & Getter Attributes
    public function setWalletAttribute($value)
    {
        if ($value >= 0 && isset($this->attributes['user_type']) && $this->attributes['user_type'] == 'client') {
            $this->attributes['wallet'] = $value;
        }else{
            $this->attributes['wallet'] = $value;
        }
    }

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function setImageAttribute($value)
    {
        if ($value) {
            if (isset($this->attributes['image']) && $this->attributes['image']) {
                if (file_exists(storage_path('app/public/images/user/'. $this->attributes['image']))) {
                    \File::delete(storage_path('app/public/images/user/'. $this->attributes['image']));
                }
            }
            $image = uploadImg($value,'user');
            $this->attributes['image'] = $image;
        }
    }

    public function setCoverAttribute($value)
    {
        if ($value) {
            if (isset($this->attributes['cover']) && $this->attributes['cover']) {
                if (file_exists(storage_path('app/public/images/user/'. $this->attributes['cover']))) {
                    \File::delete(storage_path('app/public/images/user/'. $this->attributes['cover']));
                }
            }
            $cover = uploadImg($value,'user');
            $this->attributes['cover'] = $cover;
        }
    }



    public function getImageAttribute()
    {
        $image = isset($this->attributes['image']) && $this->attributes['image'] ? 'storage/images/user/'.$this->attributes['image'] : 'dashboardAssets/images/backgrounds/avatar.jpeg';
        return asset($image);
    }

    public function getCoverImageAttribute()
    {
        $image = $this->attributes['cover'] ? 'storage/images/user/'.$this->attributes['cover'] : "dashboardAssets/global/images/cover/consult-cover2.jpg";
        return asset($image);
    }

    public function getIsUserDeactiveAttribute()
    {
        return ! $this->attributes['is_active'] || $this->attributes['is_ban'];
    }

    public function getIsAvailableAttribute()
    {
        return $this->driver()->where(['is_available' => 1 , 'is_driver_available' => 1 , 'is_admin_accept' => 1])->count() > 0;
    }

    public function getIsElmAvailableAttribute()
    {
        return $this->driver()->where(['is_available' => 1 , 'is_admin_accept' => 1])->count() > 0;
    }

    public function getIsInfectedAttribute()
    {
        return optional($this->profile)->is_infected == true;
    }

    public function getNameAttribute()
    {
        return $this->attributes['fullname'];
    }

    public function getAvatarAttribute()
    {
        $image = $this->attributes['image'] ? 'storage/images/user/'.$this->attributes['image'] : 'dashboardAssets/images/backgrounds/avatar.jpeg';
        return asset($image);
    }

    public function getCountryNameAttribute()
    {
        return optional(@$this->profile->country)->name;
    }

    public function getCityNameAttribute()
    {
        return optional(@$this->profile->city)->name;
    }

    public function getRateAttribute()
    {
        return optional($this->rateClients)->avg('pivot.rate');
    }

    public function getUserRatePercentageAttribute()
    {
        return $this->rate_avg * 100 / 5;
    }

    // Scopes
    public function scopeActive($query)
    {
        $query->where(['is_active' => 1 , 'is_ban' => 0 , 'is_admin_active_user' => 1]);
    }

    public function scopeAvailable($q)
    {
        $q->active()->whereHas('driver',function($q){
            $q->where(['is_available' => 1 , 'is_admin_accept' => 1 , 'is_driver_available' => 1]);
        });
    }

    public function scopeNearest($query, $lat, $lng)
    {
        $query->whereHas('driver',function ($q) use($lat,$lng) {
            $q->nearest($lat,$lng);
        });
    }

    // Relations
    public function media()
    {
    	return $this->morphOne(AppMedia::class,'app_mediaable');
    }
    //==========================Rates==================

    public function rateDrivers()
    {
        return $this->belongsToMany(User::class,'rates','client_id','driver_id')->withPivot('rate','review','order_id')->withTimestamps();
    }

    public function rateClients()
    {
        return $this->belongsToMany(User::class,'rates','driver_id','client_id')->withPivot('rate','review','order_id')->withTimestamps();
    }

    //==========================Devices==================
    public function devices()
    {
        return $this->hasMany(Device::class);
    }
    //==========================Update Requests==================
    public function updateRequests()
    {
        return $this->hasMany(UpdateRequest::class);
    }

    public function renewRequests()
    {
        return $this->hasMany(RenewRequest::class,'driver_id');
    }
    //==========================Car==================
    public function car()
    {
        return $this->hasOne(Car::class,'driver_id');
    }

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }

    public function driverPackages()
    {
        return $this->hasMany(PackageDriver::class,'driver_id');
    }

    public function subscribedPackage()
    {
        return $this->hasOneThrough(PackageDriver::class,Driver::class,'user_id','id','id','subscribed_package_id');
    }

    // Orders
    // =====================Client Orders==================
    public function clientOrders()
    {
        return $this->hasMany(Order::class,'client_id');
    }
    // =====================Referrals & Points==================
    // Users Who Use My Refer Code
    public function myReferrals()
    {
        return $this->hasMany(Referral::class,'parent_user_id');
    }
    // User Who I Use his Refer Code
    public function referal()
    {
        return $this->belongsTo(Referral::class,'child_user_id');
    }

    public function userPoints()
    {
        return $this->hasMany(UserPoint::class);
    }

    public function pointOffers()
    {
        return $this->belongsToMany(PointOffer::class)->withTimestamps();
    }

    public function luckyBoxes()
    {
        return $this->belongsToMany(LuckyBox::class,'gift_user','user_id','lucky_box_id')->withPivot('order_id')->withTimestamps();
    }
    // =====================Driver Orders==================
    public function orderNotifiedDrivers()
    {
        return $this->belongsToMany(Order::class,'driver_order','driver_id','order_id')->withPivot('status','notify_number')->withTimestamps();
    }

    public function driverOrders()
    {
        return $this->hasMany(Order::class,'driver_id');
    }

    public function driverOffers()
    {
        return $this->hasMany(OrderOffer::class,'driver_id');
    }
    //==========================Search History==================
    public function searchHistories()
    {
        return $this->hasMany(SearchHistory::class);
    }

    //==========================Wallet==================
    public function walletTransactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function walletHelps()
    {
        return $this->hasMany(WalletHelp::class);
    }

    public function moneyTransfersTo()
    {
        return $this->hasMany(MoneyTransfer::class,'transfer_from_id');
    }

    public function moneyTransfersFrom()
    {
        return $this->hasMany(MoneyTransfer::class,'transfer_to_id');
    }


    public function changeWalletBy()
    {
        return $this->hasMany(WalletTransaction::class,'added_by_id');
    }

    public function temporaryWallets()
    {
        return $this->hasMany(TemporaryWallet::class,'user_id');
    }

    public function salfnyLogs()
    {
        return $this->hasMany(SalfnyTransactionLog::class);
    }

    //==========================Profile=====================
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // Roles & Permissions
    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function hasPermissions($route, $method = null)
    {
        if ($this->user_type == 'superadmin') {
             return true;
        }
        if (is_null($method)) {
               if ($this->role->permissions->contains('route_name',$route.".index")) {
                   return true;
               }elseif ($this->role->permissions->contains('route_name',$route.".store")) {
                   return true;
               }elseif ($this->role->permissions->contains('route_name',$route.".update")) {
                   return true;
               }elseif ($this->role->permissions->contains('route_name',$route.".destroy")) {
                   return true;
               }elseif ($this->role->permissions->contains('route_name',$route.".show")) {
                   return true;
               }elseif ($this->role->permissions->contains('route_name',$route.".wallet")) {
                   return true;
               }
           }else{
                return $this->role->permissions->contains('route_name',$route.".".$method);
           }
           return false;
    }

    // For Notification Channel
    public function receivesBroadcastNotificationsOn()
    {
        return 'caberz-notification.' . $this->id;
    }

    /**
    * Get the identifier that will be stored in the subject claim of the JWT.
    *
    * @return mixed
    */
   public function getJWTIdentifier()
   {
       return $this->getKey();
   }

   /**
    * Return a key value array, containing any custom claims to be added to the JWT.
    *
    * @return array
    */
   public function getJWTCustomClaims()
   {
       return [];
   }

   public function routeNotificationForFcm($notification)
   {
       if ($this->attributes['user_type'] == 'driver') {
           return @$this->devices->last()->device_token;
       }
       return $this->devices->pluck('device_token')->toArray();
   }

   /**
     * 推送路由
     */
    public function routeNotificationForHuaweiPush()
    {
        return $this->devices()->where('type','huawei')->pluck('device_token')->toArray();
    }

    /**
     * 如果不同用户所属的APP包名可能不同，请添加此方法
     */
    public function getAppPackage()
    {
        return 'com.app.bundle_id';
    }

}
