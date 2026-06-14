<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FamiliaProfesional extends Model
{
    use HasFactory;

    protected $table = 'familias_profesionales';

    protected $fillable = [
        'codigo',
        'nombre',
        'slug',
    ];

    public function ciclosFormativos(): HasMany // 1N
    {
        return $this->hasMany(CicloFormativo::class, 'familia_profesional_id');
    }
}
