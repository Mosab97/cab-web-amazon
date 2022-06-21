<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $guarded = ['id','created_at','updated_at'];
    protected $dates = ['transfer_at'];

    public function scopePending($query)
    {
      $query->where('transfer_status','pending');
    }

    public function scopeRefused($query)
    {
      $query->where('transfer_status','refused');
    }

    public function scopeTransfered($query)
    {
      $query->where('transfer_status','transfered');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class,'added_by_id');
    }

    public function modelTypes()
    {
    	return $this->morphTo('app_typeable');
    }
}
