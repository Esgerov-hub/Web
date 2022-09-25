<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function userBalance()
    {
        return $this->hasOne(UserBalance::class,'user_id','id');
    }
    
    public function comments()
    {
        return $this->hasMany(Comments::class,'admin_id','id');
    }

    public function commentsUser()
    {
        return $this->hasMany(Comments::class,'user_id','id');
    }

    public function contacts()
    {
        return $this->hasMany(ContactUs::class,'user_id','id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'user_id', 'id');
    }

    public function notificationsUsers()
    {

        return $this->hasMany(NotificationsUsers::class,'user_id','id')
        ->join('notifications','notifications.id','=','notifications_users.notification_id');
    }

    public function orders()
    {
        return $this->hasMany(Orders::class,'user_id','id');
    }

    public function ordersRefunds()
    {
        return $this->hasMany(OrderRefunds::class,'user_id','id');
    }

    public function teach_earning()
    {
        return $this->hasMany(TeachEarning::class,'user_id','id');
    }
}
