{{-- Flujo: routes/web.php -> ProyectoController@index -> resources/views/proyectos/index.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Listado de proyectos')

@section('contenido')
    <h2>Listado de proyectos</h2>

    <p>
        <a href="{{ route('proyectos.create') }}">Crear nuevo proyecto</a>
    </p>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    @if ($proyectos->isEmpty())
        <p>No hay proyectos registrados.</p>
    @else
        <ul>
            @foreach ($proyectos as $proyecto)
                <li>
                    <strong>{{ $proyecto->nombre }}</strong>
                    ({{ $proyecto->dificultad }})

                    <ul>
                        <li><a href="{{ route('proyectos.show', $proyecto) }}">Ver</a></li>
                        <li><a href="{{ route('proyectos.edit', $proyecto) }}">Editar</a></li>
                        <li>
                            <form action="{{ route('proyectos.destroy', $proyecto) }}" method="POST">
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
