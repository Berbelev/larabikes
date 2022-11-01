<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model{

    protected $fillable=['role'];

    // recupera los usuarios con este rol
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
