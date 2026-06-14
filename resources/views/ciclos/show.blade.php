{{-- Flujo: routes/web.php -> CicloFormativoController@show -> resources/views/ciclos/show.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Ver ciclo superior')

@section('contenido')
    <h2>{{ $ciclo->nombre }}</h2>

    <ul>
        <li><strong>Codigo:</strong> {{ $ciclo->codigo }}</li>
        <li><strong>Nombre:</strong> {{ $ciclo->nombre }}</li>
        <li><strong>Grado:</strong> {{ $ciclo->grado }}</li>
        <li><strong>Slug:</strong> {{ $ciclo->slug }}</li>
        <li><strong>Familia:</strong> {{ $ciclo->familiaProfesional->nombre ?? 'Sin familia' }}</li>
    </ul>

    <h3>Estudiantes asociados</h3>

    @if ($ciclo->estudiantes->isEmpty())
        <p>Este ciclo no tiene estudiantes asociados.</p>
    @else
        <ul>
            @foreach ($ciclo->estudiantes as $estudiante)
                <li>
                    {{ $estudiante->nombre }} {{ $estudiante->apellidos }}
                    - pivot created_at: {{ $estudiante->pivot->created_at ?? 'sin fecha' }}
                    - pivot updated_at: {{ $estudiante->pivot->updated_at ?? 'sin fecha' }}
                </li>
            @endforeach
        </ul>
    @endif

    <p>
        <a href="{{ route('ciclos.edit', $ciclo) }}">Editar</a>
    </p>

    <p>
        <a href="{{ route('ciclos.index') }}">Volver al listado</a>
    </p>
@endsection
