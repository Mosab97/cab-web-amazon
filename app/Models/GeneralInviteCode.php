<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralInviteCode extends Model
{
    use SoftDeletes;
    protected $guarded = ['id','created_at','updated_at','deleted_at'];


    // scopes
    public function scopeActive($query)
    {
        $query->where('is_active',1);
    }

    public function invites()
    {
        return $this->hasMany(GeneralCodeUser::class,'invite_code_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,GeneralCodeUser::class,'invite_code_id')->withPivot('points','code')->withTimestamps();
    }

}
