<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model{

    // campos donde se permiten asignaciones masivas
    protected $fillable =['nombre', 'poblacion', 'telefono'];

}
