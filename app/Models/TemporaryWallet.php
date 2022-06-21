<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemporaryWallet extends Model
{
    protected $guarded = ['id','created_at','updated_at'];
    protected $dates = ['start_at','end_at'];

    public function scopeLive($query)
    {
        $query->where('end_at', '>=', date('Y-m-d H:i:s'))->where('start_at', '<=', date('Y-m-d H:i:s'))->where('is_expired',false);
    }

    public function scopeFinished($query)
    {
        // $query->whereDate('end_at','<=', date('Y-m-d'))->whereTime('end_at',"<=",date("H:i:s"));
        $query->where('end_at', '<=', date('Y-m-d H:i:s'));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
