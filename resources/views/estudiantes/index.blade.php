{{-- Flujo: routes/web.php -> estudianteController@index -> resources/views/estudiantes/index.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Listado de estudiantes')

@section('contenido')
    <h2>Listado de estudiantes</h2>

    <p>
        <a href="{{ route('estudiantes.create') }}">Crear nuevo estudiante</a>
    </p>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    @if ($estudiantes->isEmpty())
        <p>No hay estudiantes registrados.</p>
    @else
        <ul>
            @foreach ($estudiantes as $estudiante)
                <li>
                    <strong>{{ $estudiante->nombre }}</strong>

                    <ul>
                        <li>DNI: ({{ $estudiante->dni }})</li>
                        <li>DNI: ({{ $estudiante->nombre }})</li>
                        <li>DNI: ({{ $estudiante->apellido }})</li>
                        <li>DNI: ({{ $estudiante->email }})</li>
                        <li>DNI: ({{ $estudiante->telefono }})</li>
                        <li>DNI: ({{ $estudiante->imagen }})</li>
                        <li>DNI: ({{  $estudiante->slug ?? 'no tiene slug'  }})</li>

                    </ul>
          

                    <ul>
                        <li><a href="{{ route('estudiantes.show', $estudiante) }}">Ver</a></li>
                        <li><a href="{{ route('estudiantes.edit', $estudiante) }}">Editar</a></li>
                        <li>
                            <form action="{{ route('estudiantes.destroy', $estudiante) }}" method="POST">
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