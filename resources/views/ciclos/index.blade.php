{{-- Flujo: routes/web.php -> CicloFormativoController@index -> resources/views/ciclos/index.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Ciclos formativos superiores')

@section('contenido')
    <h2>Ciclos formativos de grado superior</h2>

    <p>
        <a href="{{ route('ciclos.create') }}">Crear ciclo superior</a>
    </p>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    @if ($ciclos->isEmpty())
        <p>No hay ciclos superiores registrados.</p>
    @else
        <ul>
            @foreach ($ciclos as $ciclo)
                <li>
                    <strong>{{ $ciclo->nombre }}</strong>
                    ({{ $ciclo->codigo }})

                    <ul>
                        <li>Familia: {{ $ciclo->familiaProfesional->nombre ?? 'Sin familia' }}</li>
                        <li>Grado: {{ $ciclo->grado }}</li>
                        <li>Estudiantes asociados: {{ $ciclo->estudiantes->count() }}</li>
                    </ul>

                    @if ($ciclo->estudiantes->isNotEmpty())
                        <p>Estudiantes y dato de la pivot:</p>
                        <ul>
                            @foreach ($ciclo->estudiantes as $estudiante)
                                <li>
                                    {{ $estudiante->nombre }} {{ $estudiante->apellidos }}
                                    - asociado el {{ $estudiante->pivot->created_at ?? 'sin fecha' }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <ul>
                        <li><a href="{{ route('ciclos.show', $ciclo) }}">Ver</a></li>
                        <li><a href="{{ route('ciclos.edit', $ciclo) }}">Editar</a></li>
                        <li>
                            <form action="{{ route('ciclos.destroy', $ciclo) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Borrar</button>
                            </form>
                        </li>
                    </ul>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
