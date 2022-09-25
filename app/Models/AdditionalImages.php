<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalImages extends Model
{
    use HasFactory;

    protected $table = 'additional_images';

    protected $fillable = 
    [
        'image',
        'type',
        'element_id'
    ];
}
