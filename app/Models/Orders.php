<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use HasFactory,SoftDeletes;


    protected $table = 'orders';

    protected $fillable = 
    [
        'ipaddress',
        'uid',
        'order_number',
        'user_id',
        'qyt',
        'price',
        'currency',
        'status'
    ];
}