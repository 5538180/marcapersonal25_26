<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'url',
        'imagen',
        'dificultad',
        'slug',
    ];


    public function estudiantes(): BelongsToMany // NM NoModelo ConAtributos
    {
        return $this->belongsToMany(
            Estudiante::class,
            'estudiante_proyecto',
            'proyecto_id',
            'estudiante_id'
        )->withPivot('descripcion_proyecto_estudiante')
            ->withTimestamps();
    }

    public function docentes(): BelongsToMany // NM ConModelo ConAtributo
    {
        return $this->belongsToMany(
            Docente::class,
            'docente_proyecto',
            'proyecto_id',
            'docente_id'
        )->using(DocenteProyecto::class)
            ->withPivot('descripcion_proyecto_docente')
            ->withTimestamps();
    }
}
