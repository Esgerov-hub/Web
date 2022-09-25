<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attributes extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'attributes';
    protected $fillable = [
        'name',
        'status',
        'type',
        'group_id',
        'datatype',
        'order'
    ];

    protected $casts = [
        'name' => 'json',
        'type'=>'integer',
        'group_id'=>'integer'
    ];

    public function group(){
        return $this->belongsTo(Attributes::class);
    }

    public function groupElements(){
        return $this->hasMany(Attributes::class,'group_id','id');
    }

}
