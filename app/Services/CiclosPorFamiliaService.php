<?php

namespace App\Services;

use App\Models\FamiliaProfesional;

class CiclosPorFamiliaService
{
    public function contarCiclos(FamiliaProfesional $familiaProfesional): int
    {
        return $familiaProfesional->ciclosFormativos()->count();
    }
}
