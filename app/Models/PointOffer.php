<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointOffer extends Model
{
    use SoftDeletes;
    protected $guarded=['id','created_at','updated_at','deleted_at'];
    protected $dates = ['start_at' , 'end_at'];
    // Scopes
    public function scopeActive($q)
    {
        $q->where('is_active',1);
    }


    public function scopeCurrent($query)
    {
        $query->whereDate('end_at','>=', date('Y-m-d'));
    }

    public function scopeFinished($query)
    {
        $query->whereDate('end_at','<', date('Y-m-d'));
    }

    public function scopeLive($query)
    {
        $query->whereDate('end_at','>=', date('Y-m-d'))->whereDate('start_at',"<=",date("Y-m-d"));
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
