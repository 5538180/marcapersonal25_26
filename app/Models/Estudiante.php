<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dni',
        'nombre',
        'apellidos',
        'email',
        'telefono',
        'imagen',
        'slug',
    ];
}
