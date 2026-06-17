<?php

namespace App\Http\Controllers;

use App\Models\CicloFormativo;
use App\Models\Docente;
use App\Models\DocenteProyecto;
use App\Models\Estudiante;
use App\Models\FamiliaProfesional;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Http\Request;

class QueryPruebaController extends Controller
{
    public function index(Request $request)
    {
        $codigoFamilia = $request->query('familia', 'IFC');
        $grado = $request->query('grado', 'superior');
        $dificultad = $request->query('dificultad', 'media');
        $texto = $request->query('texto', 'a');
        $docente = $request->query('docente', 'a');

        $consultasWhere = [
            'proyectos_donde_dificultad_es_media' => Proyecto::where('dificultad', $dificultad)
                ->select('id', 'nombre', 'dificultad', 'slug')
                ->take(10)
                ->get(),

            'ciclos_donde_grado_es_superior' => CicloFormativo::where('grado', $grado)
                ->select('id', 'familia_profesional_id', 'codigo', 'nombre', 'grado')
                ->take(10)
                ->get(),

            'familias_donde_codigo_es_ifc' => FamiliaProfesional::where('codigo', $codigoFamilia)
                ->select('id', 'codigo', 'nombre', 'slug')
                ->get(),

            'estudiantes_donde_nombre_contiene_texto' => Estudiante::where('nombre', 'like', "%{$texto}%")
                ->select('id', 'user_id', 'nombre', 'apellidos', 'email', 'telefono')
                ->take(10)
                ->get(),

            'estudiantes_donde_user_id_no_es_nulo' => Estudiante::whereNotNull('user_id')
                ->select('id', 'user_id', 'nombre', 'apellidos', 'email')
                ->take(10)
                ->get(),

            'proyectos_donde_url_es_nula' => Proyecto::whereNull('url')
                ->select('id', 'nombre', 'url', 'dificultad')
                ->take(10)
                ->get(),
        ];

        $consultasVariosWhere = [
            'ciclos_de_una_familia_y_un_grado' => CicloFormativo::where('familia_profesional_id', 1)
                ->where('grado', $grado)
                ->select('id', 'familia_profesional_id', 'codigo', 'nombre', 'grado')
                ->take(10)
                ->get(),

            'proyectos_de_dificultad_con_nombre_parcial' => Proyecto::where('dificultad', $dificultad)
                ->where('nombre', 'like', "%{$texto}%")
                ->select('id', 'nombre', 'dificultad')
                ->take(10)
                ->get(),

            'estudiantes_con_email_y_apellidos_parciales' => Estudiante::where('email', 'like', "%{$texto}%")
                ->where('apellidos', 'like', "%{$texto}%")
                ->select('id', 'nombre', 'apellidos', 'email')
                ->take(10)
                ->get(),
        ];

        $consultasOrWhere = [
            'proyectos_dificultad_baja_o_alta' => Proyecto::where('dificultad', 'baja')
                ->orWhere('dificultad', 'alta')
                ->select('id', 'nombre', 'dificultad')
                ->take(10)
                ->get(),

            'familias_codigo_ifc_o_adg' => FamiliaProfesional::where('codigo', 'IFC')
                ->orWhere('codigo', 'ADG')
                ->select('id', 'codigo', 'nombre')
                ->get(),
        ];

        $consultasWhereIn = [
            'familias_con_codigos_concretos' => FamiliaProfesional::whereIn('codigo', ['IFC', 'ADG', 'SAN'])
                ->select('id', 'codigo', 'nombre')
                ->get(),

            'proyectos_que_no_son_baja' => Proyecto::whereNotIn('dificultad', ['baja'])
                ->select('id', 'nombre', 'dificultad')
                ->take(10)
                ->get(),

            'estudiantes_con_ids_entre_1_y_5' => Estudiante::whereBetween('id', [1, 5])
                ->select('id', 'nombre', 'apellidos')
                ->get(),
        ];

        $consultasFechas = [
            'proyectos_creados_este_anio' => Proyecto::whereYear('created_at', now()->year)
                ->select('id', 'nombre', 'created_at')
                ->take(10)
                ->get(),

            'estudiantes_creados_este_mes' => Estudiante::whereMonth('created_at', now()->month)
                ->select('id', 'nombre', 'created_at')
                ->take(10)
                ->get(),

            'familias_creadas_hasta_ahora' => FamiliaProfesional::where('created_at', '<=', now())
                ->select('id', 'codigo', 'nombre', 'created_at')
                ->take(10)
                ->get(),
        ];

        $consultasWithDosTablas = [
            'proyectos_con_docentes_y_estudiantes' => Proyecto::with(['docentes', 'estudiantes'])
                ->select('id', 'nombre', 'descripcion', 'dificultad', 'slug')
                ->take(5)
                ->get(),

            'estudiantes_con_user_y_proyectos' => Estudiante::with(['user', 'proyectos'])
                ->select('id', 'user_id', 'nombre', 'apellidos', 'email')
                ->take(5)
                ->get(),

            'ciclos_con_familia_y_estudiantes' => CicloFormativo::with(['familiaProfesional', 'estudiantes'])
                ->select('id', 'familia_profesional_id', 'codigo', 'nombre', 'grado')
                ->take(5)
                ->get(),

            'usuarios_con_estudiante_y_docente' => User::with(['estudiante', 'docente'])
                ->select('id', 'name', 'email')
                ->take(5)
                ->get(),
        ];

        $consultasWithFiltrado = [
            'familia_con_solo_ciclos_del_grado_indicado' => FamiliaProfesional::with([
                'ciclosFormativos' => fn ($query) => $query
                    ->where('grado', $grado)
                    ->select('id', 'familia_profesional_id', 'codigo', 'nombre', 'grado'),
            ])
                ->where('codigo', $codigoFamilia)
                ->select('id', 'codigo', 'nombre')
                ->first(),

            'proyectos_con_solo_docentes_por_nombre' => Proyecto::with([
                'docentes' => fn ($query) => $query->where('nombre', 'like', "%{$docente}%"),
            ])
                ->select('id', 'nombre', 'dificultad')
                ->take(5)
                ->get(),

            'estudiantes_con_solo_proyectos_de_dificultad_indicada' => Estudiante::with([
                'proyectos' => fn ($query) => $query->where('dificultad', $dificultad),
            ])
                ->select('id', 'nombre', 'apellidos')
                ->take(5)
                ->get(),
        ];

        $consultasWithAnidado = [
            'familias_con_ciclos_y_estudiantes' => FamiliaProfesional::with('ciclosFormativos.estudiantes')
                ->where('codigo', $codigoFamilia)
                ->select('id', 'codigo', 'nombre')
                ->first(),

            'estudiantes_con_ciclos_y_familia_de_cada_ciclo' => Estudiante::with('ciclosFormativos.familiaProfesional')
                ->select('id', 'nombre', 'apellidos')
                ->take(5)
                ->get(),

            'proyectos_con_estudiantes_ciclos_familia_y_docentes_user' => Proyecto::with([
                'estudiantes.ciclosFormativos.familiaProfesional',
                'docentes.user',
            ])
                ->select('id', 'nombre', 'dificultad')
                ->take(5)
                ->get(),
        ];

        $consultasWhereHas = [
            'proyectos_si_tienen_docentes_cuyo_nombre_contiene_texto' => Proyecto::whereHas('docentes', function ($query) use ($docente) {
                $query->where('nombre', 'like', "%{$docente}%");
            })
                ->select('id', 'nombre', 'dificultad')
                ->take(10)
                ->get(),

            'estudiantes_si_tienen_ciclos_del_grado_indicado' => Estudiante::whereHas('ciclosFormativos', function ($query) use ($grado) {
                $query->where('grado', $grado);
            })
                ->select('id', 'nombre', 'apellidos', 'email')
                ->take(10)
                ->get(),

            'familias_si_tienen_ciclos_cuyo_nombre_contiene_texto' => FamiliaProfesional::whereHas('ciclosFormativos', function ($query) use ($texto) {
                $query->where('nombre', 'like', "%{$texto}%");
            })
                ->select('id', 'codigo', 'nombre')
                ->take(10)
                ->get(),

            'docentes_si_tienen_proyectos_de_dificultad_indicada' => Docente::whereHas('proyectos', function ($query) use ($dificultad) {
                $query->where('dificultad', $dificultad);
            })
                ->select('id', 'nombre', 'apellidos', 'email')
                ->take(10)
                ->get(),
        ];

        $consultasWhereHasConWith = [
            'proyectos_filtrados_por_docente_y_cargando_docentes' => Proyecto::whereHas('docentes', function ($query) use ($docente) {
                $query->where('nombre', 'like', "%{$docente}%");
            })
                ->with('docentes')
                ->select('id', 'nombre', 'dificultad')
                ->take(10)
                ->get(),

            'estudiantes_filtrados_por_familia_y_cargando_ciclos_familia' => Estudiante::whereHas('ciclosFormativos.familiaProfesional', function ($query) use ($codigoFamilia) {
                $query->where('codigo', $codigoFamilia);
            })
                ->with('ciclosFormativos.familiaProfesional')
                ->select('id', 'nombre', 'apellidos', 'email')
                ->take(10)
                ->get(),

            'familias_filtradas_por_ciclo_superior_y_cargando_ciclos_superiores' => FamiliaProfesional::whereHas('ciclosFormativos', function ($query) {
                $query->where('grado', 'superior');
            })
                ->with([
                    'ciclosFormativos' => fn ($query) => $query
                        ->where('grado', 'superior')
                        ->select('id', 'familia_profesional_id', 'codigo', 'nombre', 'grado'),
                ])
                ->select('id', 'codigo', 'nombre')
                ->take(10)
                ->get(),
        ];

        $consultasModeloPrincipalSegunColumnaDeTablaRelacionada = [
            'ciclos_cuya_familia_tiene_codigo_ifc' => CicloFormativo::whereHas('familiaProfesional', function ($query) use ($codigoFamilia) {
                $query->where('codigo', $codigoFamilia);
            })
                ->with('familiaProfesional')
                ->select('id', 'familia_profesional_id', 'codigo', 'nombre', 'grado')
                ->take(10)
                ->get(),

            'proyectos_cuyos_estudiantes_tienen_email_con_texto' => Proyecto::whereHas('estudiantes', function ($query) use ($texto) {
                $query->where('email', 'like', "%{$texto}%");
            })
                ->with('estudiantes')
                ->select('id', 'nombre', 'dificultad')
                ->take(10)
                ->get(),

            'usuarios_que_tienen_estudiante_con_apellido_con_texto' => User::whereHas('estudiante', function ($query) use ($texto) {
                $query->where('apellidos', 'like', "%{$texto}%");
            })
                ->with('estudiante')
                ->select('id', 'name', 'email')
                ->take(10)
                ->get(),

            'proyectos_cuyos_estudiantes_pertenecen_a_familia_ifc' => Proyecto::whereHas('estudiantes.ciclosFormativos.familiaProfesional', function ($query) use ($codigoFamilia) {
                $query->where('codigo', $codigoFamilia);
            })
                ->with('estudiantes.ciclosFormativos.familiaProfesional')
                ->select('id', 'nombre', 'dificultad')
                ->take(10)
                ->get(),
        ];

        $consultasHasDoesntHave = [
            'proyectos_que_tienen_estudiantes' => Proyecto::has('estudiantes')
                ->select('id', 'nombre', 'dificultad')
                ->take(10)
                ->get(),

            'docentes_sin_proyectos' => Docente::doesntHave('proyectos')
                ->select('id', 'nombre', 'apellidos', 'email')
                ->take(10)
                ->get(),

            'estudiantes_sin_proyectos_de_dificultad_alta' => Estudiante::whereDoesntHave('proyectos', function ($query) {
                $query->where('dificultad', 'alta');
            })
                ->select('id', 'nombre', 'apellidos', 'email')
                ->take(10)
                ->get(),
        ];

        $consultasWithCount = [
            'familias_con_total_de_ciclos' => FamiliaProfesional::select('id', 'codigo', 'nombre')
                ->withCount('ciclosFormativos')
                ->orderByDesc('ciclos_formativos_count')
                ->take(10)
                ->get(),

            'proyectos_con_total_docentes_y_estudiantes' => Proyecto::select('id', 'nombre', 'dificultad')
                ->withCount(['docentes', 'estudiantes'])
                ->orderByDesc('estudiantes_count')
                ->take(10)
                ->get(),

            'estudiantes_con_total_proyectos_de_dificultad_alta' => Estudiante::select('id', 'nombre', 'apellidos')
                ->withCount([
                'proyectos as proyectos_alta_count' => fn ($query) => $query->where('dificultad', 'alta'),
            ])
                ->orderByDesc('proyectos_alta_count')
                ->take(10)
                ->get(),
        ];

        $consultasDesdeRelaciones = [
            'desde_familia_obtener_sus_ciclos' => FamiliaProfesional::where('codigo', $codigoFamilia)
                ->first()
                ?->ciclosFormativos()
                ->where('grado', $grado)
                ->orderBy('nombre')
                ->take(10)
                ->get(),

            'desde_estudiante_obtener_sus_proyectos' => Estudiante::first()
                ?->proyectos()
                ->where('dificultad', $dificultad)
                ->orderBy('nombre')
                ->take(10)
                ->get(),

            'desde_proyecto_obtener_sus_docentes' => Proyecto::first()
                ?->docentes()
                ->orderBy('apellidos')
                ->take(10)
                ->get(),
        ];

        $consultasPivot = [
            'proyectos_con_descripcion_en_pivot_estudiante_proyecto' => Proyecto::whereHas('estudiantes', function ($query) {
                $query->whereNotNull('estudiante_proyecto.descripcion_proyecto_estudiante');
            })
                ->with('estudiantes')
                ->select('id', 'nombre', 'dificultad')
                ->take(10)
                ->get(),

            'docente_proyecto_usando_modelo_pivot' => DocenteProyecto::with(['docente', 'proyecto'])
                ->whereNotNull('descripcion_proyecto_docente')
                ->take(10)
                ->get(),
        ];

        $consultasAgregados = [
            'total_estudiantes' => Estudiante::count(),
            'total_proyectos_dificultad_indicada' => Proyecto::where('dificultad', $dificultad)->count(),
            'maximo_id_ciclos' => CicloFormativo::max('id'),
            'minimo_id_familias' => FamiliaProfesional::min('id'),
            'media_id_proyectos' => Proyecto::avg('id'),
        ];

        $consultasGroupBy = [
            'total_proyectos_por_dificultad' => Proyecto::selectRaw('dificultad, COUNT(*) as total')
                ->groupBy('dificultad')
                ->orderBy('dificultad')
                ->get(),

            'total_ciclos_por_familia_y_grado' => CicloFormativo::selectRaw('familia_profesional_id, grado, COUNT(*) as total')
                ->groupBy('familia_profesional_id', 'grado')
                ->having('total', '>', 0)
                ->orderBy('familia_profesional_id')
                ->take(20)
                ->get(),
        ];

        $consultasPluck = [
            'lista_nombres_familias' => FamiliaProfesional::orderBy('nombre')->pluck('nombre'),
            'pares_id_nombre_proyectos' => Proyecto::orderBy('nombre')->pluck('nombre', 'id'),
            'pares_codigo_nombre_ciclos' => CicloFormativo::orderBy('codigo')->pluck('nombre', 'codigo')->take(10),
        ];

        $consultasWhenRequest = [
            'proyectos_filtrados_con_when' => Proyecto::query()
                ->when($request->dificultad, fn ($query, $valor) => $query->where('dificultad', $valor))
                ->when($request->texto, fn ($query, $valor) => $query->where('nombre', 'like', "%{$valor}%"))
                ->withCount(['docentes', 'estudiantes'])
                ->orderBy('nombre')
                ->take(10)
                ->get(),

            'ciclos_filtrados_con_when_y_relacion' => CicloFormativo::query()
                ->when($request->grado, fn ($query, $valor) => $query->where('grado', $valor))
                ->when($request->familia, function ($query, $valor) {
                    $query->whereHas('familiaProfesional', fn ($subquery) => $subquery->where('codigo', $valor));
                })
                ->with('familiaProfesional')
                ->orderBy('nombre')
                ->take(10)
                ->get(),
        ];

        $consultasPaginadas = [
            'estudiantes_paginados' => Estudiante::with(['ciclosFormativos', 'proyectos'])
                ->orderBy('apellidos')
                ->paginate(5),

            'proyectos_paginados_con_filtro_y_relaciones' => Proyecto::where('dificultad', $dificultad)
                ->with(['docentes', 'estudiantes'])
                ->withCount(['docentes', 'estudiantes'])
                ->orderBy('nombre')
                ->paginate(5),
        ];

        dd([
            'mensaje' => 'Consultas reales de practica para Eloquent. Cambia parametros: ?familia=IFC&grado=superior&dificultad=media&texto=a&docente=a',
            'parametros_usados' => [
                'familia' => $codigoFamilia,
                'grado' => $grado,
                'dificultad' => $dificultad,
                'texto' => $texto,
                'docente' => $docente,
            ],
            'consultas_where' => $consultasWhere,
            'consultas_varios_where' => $consultasVariosWhere,
            'consultas_or_where' => $consultasOrWhere,
            'consultas_where_in_between' => $consultasWhereIn,
            'consultas_fechas' => $consultasFechas,
            'consultas_with_con_2_tablas' => $consultasWithDosTablas,
            'consultas_with_filtrado' => $consultasWithFiltrado,
            'consultas_with_anidado' => $consultasWithAnidado,
            'consultas_where_has' => $consultasWhereHas,
            'consultas_where_has_con_with' => $consultasWhereHasConWith,
            'consultas_de_un_modelo_segun_columna_de_tabla_relacionada' => $consultasModeloPrincipalSegunColumnaDeTablaRelacionada,
            'consultas_has_doesnt_have' => $consultasHasDoesntHave,
            'consultas_with_count' => $consultasWithCount,
            'consultas_desde_relaciones' => $consultasDesdeRelaciones,
            'consultas_pivot' => $consultasPivot,
            'consultas_agregados' => $consultasAgregados,
            'consultas_group_by' => $consultasGroupBy,
            'consultas_pluck' => $consultasPluck,
            'consultas_when_request' => $consultasWhenRequest,
            'consultas_paginadas' => $consultasPaginadas,
        ]);
    }

    public function create()
    {
        return 'Usa GET /qppruebas para ver la bateria de consultas.';
    }

    public function store(Request $request)
    {
        dd([
            'mensaje' => 'Este controlador es de practica. El index contiene consultas de lectura.',
            'payload_recibido' => $request->all(),
        ]);
    }

    public function show(string $id)
    {
        dd([
            'mensaje' => 'Usa GET /qppruebas. ID recibido solo para practicar rutas resource.',
            'id_recibido' => $id,
        ]);
    }

    public function edit(string $id)
    {
        dd([
            'mensaje' => 'Usa GET /qppruebas. ID recibido solo para practicar rutas resource.',
            'id_recibido' => $id,
        ]);
    }

    public function update(Request $request, string $id)
    {
        dd([
            'mensaje' => 'Este controlador es de practica. El index contiene consultas de lectura.',
            'id_recibido' => $id,
            'payload_recibido' => $request->all(),
        ]);
    }

    public function destroy(string $id)
    {
        dd([
            'mensaje' => 'Este controlador es de practica. El index contiene consultas de lectura.',
            'id_recibido' => $id,
        ]);
    }
}
