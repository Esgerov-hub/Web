<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandartPages extends Model
{
    use HasFactory;
    protected $table = 'standart_pages';

    protected $fillable =
        [
            'bg_image',
            'type',
            'name',
            'description'
        ];

    protected $casts = [
        'name' => 'json',
        'description' => 'json',
        'type' => 'string',
        'bg_image' => 'string',
    ];

    public function seo()
    {
        return $this->hasOne(MetaSEO::class, 'element_id', 'id')->where('type','standart_pages');
    }
}
