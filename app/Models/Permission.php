<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_name',
        'user_id',
        'permission'
    ];

    /**
     * find permission by id
     * @param $id
     * @return mixed
     */
    public function scopePermission($query,$id){

        return $query->findOrFail($id);
    }
}
