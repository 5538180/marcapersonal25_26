{{-- Flujo: routes/web.php -> estudianteController@edit -> resources/views/estudiantes/edit.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Editar estudiante')

@section('contenido')
    <h2>Editar estudiante</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('estudiantes.update', $estudiante) }}" method="POST">
        @csrf
        @method('PUT')


        <p>
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $estudiante->nombre) }}">
        </p>

        <p>
            <label for="apellidos">apellidos</label><br>
            <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos',$estudiante->apellidos) }}">
        </p>

        <p>
            <label for="email">email</label><br>
            <textarea name="email" id="email" rows="6">{{ old('email',$estudiante->email) }}</textarea>
        </p>

        <p>
            <label for="telefono">telefono</label><br>
            <input type="text" name="telefono" id="telefono" value="{{ old('telefono',$estudiante->telefono) }}">
        </p>

        <p>
            <label for="direccion">direccion</label><br>
            <input type="text" name="direccion" id="direccion" value="{{ $estudiante->direccion ? old('direccion',$estudiante->direccion)  : "En la calle"}}">
        </p>


        <p>
            <button type="submit">Actualizar estudiante</button>
        </p>
    </form>

    <p>
        <a href="{{ route('estudiantes.index') }}">Volver al listado</a>
    </p>
@endsection
