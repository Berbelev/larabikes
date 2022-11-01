<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model{
    use HasFactory;

    // Campos a los que se permite hacer asignación masiva desde la request a la BDD
    protected $fillable =['marca','modelo', 'kms', 'precio','imagen',
                         'user_id','matriculada' ,'matricula', 'color'];

    // retorna el usuario propietario de la moto
    public function user(){
        return $this->belongsTo('\App\Models\User');
    }
}

