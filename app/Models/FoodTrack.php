<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodTrack extends Model
{
    protected $fillable = ['name','description','image','cover_image'];
}
