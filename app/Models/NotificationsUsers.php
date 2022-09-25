<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationsUsers extends Model
{
    use HasFactory;

    protected $table = 'notifications_users';


    protected $fillable = 
    [
        'notification_id',
        'user_id',
    ];


    // public function users()
    // {
    //     return $this->hasOne(User::class,'id','user_id');
    // }
}
