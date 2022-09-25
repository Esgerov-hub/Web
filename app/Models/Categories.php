<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'categories';
    protected $fillable = [
        'uid',
        'name',
        'description',
        'image',
        'icon',
        'type',
        'top_id',
        'order',
        'active',
        'slugs',
    ];
    protected $casts = [
//        'type' => 'integer',
        'name' => 'json',
        'description' => 'json',
        'slugs' => 'json',
        'order' => 'integer',
        'top_id' => 'integer',
    ];

    // Types
    // 1-post
    // 2-service
    // 3-product

    public function seo()
    {
        return $this->hasOne(MetaSEO::class, 'element_id', 'id')->where('type','categories');
    }

    public function top_category(){
        return $this->hasOne(Categories::class,'id','top_id');
    }
}
