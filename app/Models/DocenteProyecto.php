<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DocenteProyecto extends Pivot
{
    protected $table = 'docente_proyecto';

    protected $fillable = [
        'docente_id',
        'proyecto_id',
        'descripcion_proyecto_docente',
    ];

    public function docente(): BelongsTo // N1 PV
    {
        return $this->belongsTo(Docente::class, 'docente_id');
    }

    public function proyecto(): BelongsTo // N1 PV
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}
