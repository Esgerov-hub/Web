<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProducts extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'order_refunds';

    protected $fillable = 
    [
        'order_id',
        'element_id',
        'type',
        'product'
    ];
}
