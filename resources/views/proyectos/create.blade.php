{{-- Flujo: routes/web.php -> ProyectoController@create -> resources/views/proyectos/create.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Crear proyecto')

@section('contenido')
    <h2>Crear proyecto</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('proyectos.store') }}" method="POST">
        @csrf

        <p>
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
        </p>

        <p>
            <label for="slug">Slug</label><br>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}">
        </p>

        <p>
            <label for="descripcion">Descripcion</label><br>
            <textarea name="descripcion" id="descripcion" rows="6">{{ old('descripcion') }}</textarea>
        </p>

        <p>
            <label for="url">URL</label><br>
            <input type="text" name="url" id="url" value="{{ old('url') }}">
        </p>

        <p>
            <label for="imagen">Imagen</label><br>
            <input type="text" name="imagen" id="imagen" value="{{ old('imagen') }}">
        </p>

        <p>
            <label for="dificultad">Dificultad</label><br>
            <select name="dificultad" id="dificultad">
                <option value="">Selecciona una opcion</option>
                <option value="baja" @selected(old('dificultad') === 'baja')>baja</option>
                <option value="media" @selected(old('dificultad') === 'media')>media</option>
                <option value="alta" @selected(old('dificultad') === 'alta')>alta</option>
            </select>
        </p>

        <p>
            <button type="submit">Guardar proyecto</button>
        </p>
    </form>

    <p>
        <a href="{{ route('proyectos.index') }}">Volver al listado</a>
    </p>
@endsection
