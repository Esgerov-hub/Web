<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'category_id',
        'active',
        'status',
        'image',
        'title',
        'url',
    ];

    protected $casts = [
        'title' => 'json',
        'active'=>'integer',
        'category_id'=>'integer',
        'status' => 'integer',
    ];


    public function category()
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }


}
