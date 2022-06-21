<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalfnyTransactionLog extends Model
{
    use SoftDeletes;
    protected $guarded = ['id','created_at','updated_at'];
    protected $dates = ['paid_at'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
