<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MoneyTransfer extends Model
{
    use SoftDeletes;
    protected $guarded = ['id','created_at','updated_at','deleted_at'];

    public function transferFrom()
    {
        return $this->belongsTo(User::class,'transfer_from_id');
    }

    public function transferTo()
    {
        return $this->belongsTo(User::class,'transfer_to_id');
    }
}
