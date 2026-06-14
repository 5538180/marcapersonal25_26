<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CicloFormativo extends Model
{
    use HasFactory;

    protected $table = 'ciclos_formativos';

    protected $fillable = [
        'familia_profesional_id',
        'codigo',
        'nombre',
        'grado',
        'slug',
    ];

    public function familiaProfesional(): BelongsTo // N1
    {
        return $this->belongsTo(FamiliaProfesional::class, 'familia_profesional_id');
    }

    public function estudiantes(): BelongsToMany // NM NoModelo NoAtri
    {
        return $this->belongsToMany(
            Estudiante::class,
            'ciclo_formativo_estudiante',
            'ciclo_formativo_id',
            'estudiante_id'
        )->withTimestamps();
    }
}
