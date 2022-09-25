<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CKMEDIAUP extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'c_k_m_e_d_i_a_u_p_s';

    public function registerMediaConversions(Media $media = null): void
{
    $this->addMediaConversion('thumb')
        ->width(600);
}
}
