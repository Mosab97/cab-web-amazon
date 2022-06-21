<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Mail\Dashboard\ReplyContact;

class ContactReply extends Model
{
    use SoftDeletes;
    protected $guarded = ['id','created_at','updated_at'];

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::saved(function ($data) {
    //         if ($data->contact->email) {
    //             try{
    //                 \Mail::to($data->contact->email)->send(new ReplyContact($data));
    //             }finally{
    //                 $notSend=1;
    //             }
    //         }
    //     });
    // }

    public function contact()
    {
    	return $this->belongsTo(Contact::class);
    }


    public function sender()
    {
    	return $this->belongsTo(User::class,'sender_id');
    }

    public function reciever()
    {
    	return $this->belongsTo(User::class,'receiver_id');
    }
}
