<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralCodeUser extends Model
{
    protected $guarded = ['id','created_at','updated_at'];

    public function inviteCode()
    {
        return $this->belongsTo(GeneralInviteCode::class,'invite_code_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
