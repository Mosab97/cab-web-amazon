<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $guarded = ['id','created_at','updated_at','deleted_at'];


    public function parent()
    {
        return $this->belongsTo(User::class,'parent_user_id');
    }

    public function children()
    {
        return $this->hasMany(User::class,'child_user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'child_user_id');
    }
}
