<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    public function user(): BelongsTo // 11
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function proyectos(): BelongsToMany // NM NoModelo ConAtributos
    {
        return $this->belongsToMany(
            Proyecto::class,
            'estudiante_proyecto',
            'estudiante_id',
            'proyecto_id'
        )->withPivot('descripcion_proyecto_estudiante')
            ->withTimestamps();
    }

    public function ciclosFormativos(): BelongsToMany // NM NoModelo NoAtri
    {
        return $this->belongsToMany(
            CicloFormativo::class,
            'ciclo_formativo_estudiante',
            'estudiante_id',
            'ciclo_formativo_id'
        )->withTimestamps();
    }
}
