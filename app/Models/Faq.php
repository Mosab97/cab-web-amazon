<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model implements TranslatableContract
{
    use Translatable , SoftDeletes;
    protected $guarded = ['id','created_at','updated_at','deleted_at'];
    public $translatedAttributes = ['name','desc'];


    // scopes
    public function scopeActive($q)
    {
        $q->where('is_active',1);
    }

}
