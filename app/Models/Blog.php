<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\MetaSeo;
class Blog extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'blogs';

    protected $fillable = [
        'user_id',
        'category_id',
        'type',
        'status',
        'image',
        'title',
        'description',
        'slug'
    ];

    protected $casts = [
        'title' => 'json',
        'slug' => 'json',
        'description' => 'json',
        'type'=>'integer',
        'category_id'=>'integer',
        'status' => 'integer',
    ];

    public function seo()
    {
        return $this->hasOne(MetaSEO::class, 'element_id', 'id')->where('type','blogs');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function category()
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }

    public function images()
    {
        return $this->hasOne(AdditionalImages::class, 'element_id', 'id')->where('type','blogs');
    }
}
