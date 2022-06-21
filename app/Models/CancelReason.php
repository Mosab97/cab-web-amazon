<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class CancelReason extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = ['id','created_at','updated_at'];
    public $translatedAttributes = ['name','desc'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
