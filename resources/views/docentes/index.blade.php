{{-- Flujo: routes/web.php -> DocenteController@index -> resources/views/docentes/index.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Listado de docentes')

@section('contenido')
    <h2>Listado de docentes</h2>

    <p>
        <a href="{{ route('docentes.create') }}">Crear nuevo docente</a>
    </p>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    @if ($docentes->isEmpty())
        <p>No hay docentes registrados.</p>
    @else
        <ul>
            @foreach ($docentes as $docente)
                <li>
                    <strong>{{ $docente->nombre }} {{ $docente->apellidos }}</strong>

                    <ul>
                        <li>Email: {{ $docente->email }}</li>
                        <li>Slug: {{ $docente->slug }}</li>
                    </ul>

                    <ul>
                        <li><a href="{{ route('docentes.show', $docente) }}">Ver</a></li>
                        <li><a href="{{ route('docentes.edit', $docente) }}">Editar</a></li>
                        <li>
                            <form action="{{ route('docentes.destroy', $docente) }}" method="POST">
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
