<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionLabel extends Model
{
    use HasFactory;

    protected $table = 'permission_labels';

    protected $guarded = [];

    public function permissions(){
        return $this->hasMany(Permission::class,'label_id','id');
    }
}
