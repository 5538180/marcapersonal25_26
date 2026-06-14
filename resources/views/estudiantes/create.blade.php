{{-- Flujo: routes/web.php -> estudianteController@create -> resources/views/estudiantes/create.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Crear estudiante')

@section('contenido')
    <h2>Crear estudiante</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('estudiantes.store') }}" method="POST">
        @csrf

        <p>
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
        </p>

        <p>
            <label for="apellidos">apellidos</label><br>
            <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos') }}">
        </p>

        <p>
            <label for="email">email</label><br>
            <textarea name="email" id="email" rows="6">{{ old('email') }}</textarea>
        </p>

        <p>
            <label for="telefono">telefono</label><br>
            <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}">
        </p>

        <p>
            <label for="direccion">direccion</label><br>
            <input type="text" name="direccion" id="direccion" value="{{ old('direccion') }}">
        </p>

     

        <p>
            <button type="submit">Guardar estudiante</button>
        </p>
    </form>

    <p>
        <a href="{{ route('estudiantes.index') }}">Volver al listado</a>
    </p>
@endsection
