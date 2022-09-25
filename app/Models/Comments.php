<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use HasFactory,SoftDeletes;

    public function admin()
    {
        return $this->hasOne(User::class,'id','admin_id');
    }

    public function users()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function top()
    {
        return $this->hasOne(Comments::class,'id','top_id');
    }
}
