<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaSeo extends Model
{
    use HasFactory;

    protected $table = 'meta_seos';
    protected $fillable = [
        'name',
        'description',
        'keyword',
        'type',
        'element_id'
    ];
    protected $casts = [
        'name' => 'json',
        'description' => 'json',
        'keyword' => 'json',
        'element_id' => 'integer',
    ];
}
