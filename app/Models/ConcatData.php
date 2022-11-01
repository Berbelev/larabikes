<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConcatData extends Model
{
    protected $fillable =['movil', 'fijo', 'direccion', 'user_id'];
}
