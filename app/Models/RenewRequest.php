<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RenewRequest extends Model
{
    use SoftDeletes;
    protected $guarded = ['id','created_at','updated_at','deleted_at'];

    public function setRenewStatusAttribute($value)
    {
        $this->attributes['renew_status'] = $value;
        if (isset($this->attributes['change_status_times']) && $this->attributes['change_status_times']) {
            $statuses = [];
            $old_statuses = json_decode($this->attributes['change_status_times'],true) ?? [];
            foreach ($old_statuses as $status) {
                $statuses[] = $status;
            }
            $statuses[] = ['status' => $value,'time' => date("Y-m-d H:i"),'changed_by' => auth('api')->check() ? auth('api')->id() : (auth()->check() ? auth()->id() : null)];
            $this->attributes['change_status_times'] = json_encode($statuses);
        }else{
            $this->attributes['change_status_times'] = json_encode([
                [
                    'status' => $value,
                    'time' => date("Y-m-d H:i"),
                    'changed_by' => auth('api')->check() ? auth('api')->id() : (auth()->check() ? auth()->id() : null)
                ]
            ]);
        }
    }

    public function package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class,'driver_id');
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class,'last_changed_by_id');
    }

}
