<?php

namespace Database\Seeders;

use App\Models\FamiliaProfesional;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FamiliaProfesionalSeeder extends Seeder
{
    public function run(): void
    {
        foreach (self::$familias as $codigo => $nombre) {
            FamiliaProfesional::query()->updateOrCreate(
                ['codigo' => $codigo],
                [
                    'nombre' => $nombre,
                    'slug' => Str::slug($codigo.'-'.$nombre),
                ],
            );
        }

        $this->command->info('¡Tabla familias profesionales inicializada con datos!');
    }

    private static array $familias = [
        'ADG' => 'Administración y Gestión',
        'AFD' => 'Actividades Físicas y Deportivas',
        'AGA' => 'Agraria',
        'ARA' => 'Artes y Artesanías',
        'ARG' => 'Artes Gráficas',
        'COM' => 'Comercio y Marketing',
        'ELE' => 'Electricidad y Electrónica',
        'ENA' => 'Energía y Agua',
        'EOC' => 'Edificación y Obra Civil',
        'FME' => 'Fabricación Mecánica',
        'HOT' => 'Hostelería y Turismo',
        'IEX' => 'Industrias Extractivas',
        'IFC' => 'Informática y Comunicaciones',
        'IMA' => 'Instalación y Mantenimiento',
        'IMP' => 'Imagen Personal',
        'IMS' => 'Imagen y Sonido',
        'INA' => 'Industrias Alimentarias',
        'MAM' => 'Madera, Mueble y Corcho',
        'MAP' => 'Marítimo-Pesquera',
        'QUI' => 'Química',
        'SAN' => 'Sanidad',
        'SEA' => 'Seguridad y Medio Ambiente',
        'SSC' => 'Servicios Socioculturales y a la Comunidad',
        'TCP' => 'Textil, Confección y Piel',
        'TMV' => 'Transporte y Mantenimiento de Vehículos',
        'VIC' => 'Vidrio y Cerámica',
    ];
}
