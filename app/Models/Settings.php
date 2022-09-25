<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable =
        [
            'name',
            'description',
            'keywords',
            'address',
            'social_network',
            'logos',
            'urls',
            'keys'
        ];

    protected $casts = [
        'name' => 'json',
        'description' => 'json',
        'keywords' => 'json',
        'address' => 'json',
        'social_network' => 'json',
        'logos' => 'json',
        'urls' => 'json',
        'keys' => 'json',
    ];
}
