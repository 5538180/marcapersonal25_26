<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'apellidos',
        'email',
        'slug',
    ];

    public function user(): BelongsTo // 11
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function proyectos(): BelongsToMany // NM ConModelo ConAtributo
    {
        return $this->belongsToMany(
            Proyecto::class,
            'docente_proyecto',
            'docente_id',
            'proyecto_id'
        )->using(DocenteProyecto::class)
            ->withPivot('descripcion_proyecto_docente')
            ->withTimestamps();
    }
}
