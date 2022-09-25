<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notifications extends Model
{
    use HasFactory,SoftDeletes;


    protected $table = 'notifications';


    protected $fillable = 
    [
        'name',
        'value',
        'element_id',
        'type',
        'vie',
    ];


    public function notification()
    {
        return $this->hasOne(NotificationsUsers::class,'notification_id','id');
    }
}
