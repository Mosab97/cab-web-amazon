<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageTranslation extends Model
{
    public $timestamps = false;
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
