{{-- Flujo: routes/web.php -> ProyectoController@edit -> resources/views/proyectos/edit.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Editar proyecto')

@section('contenido')
    <h2>Editar proyecto</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('proyectos.update', $proyecto) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $proyecto->nombre) }}">
        </p>

        <p>
            <label for="slug">Slug</label><br>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $proyecto->slug) }}">
        </p>

        <p>
            <label for="descripcion">Descripcion</label><br>
            <textarea name="descripcion" id="descripcion" rows="6">{{ old('descripcion', $proyecto->descripcion) }}</textarea>
        </p>

        <p>
            <label for="url">URL</label><br>
            <input type="text" name="url" id="url" value="{{ old('url', $proyecto->url) }}">
        </p>

        <p>
            <label for="imagen">Imagen</label><br>
            <input type="text" name="imagen" id="imagen" value="{{ old('imagen', $proyecto->imagen) }}">
        </p>

        <p>
            <label for="dificultad">Dificultad</label><br>
            <select name="dificultad" id="dificultad">
                <option value="">Selecciona una opcion</option>
                <option value="baja" @selected(old('dificultad', $proyecto->dificultad) === 'baja')>baja</option>
                <option value="media" @selected(old('dificultad', $proyecto->dificultad) === 'media')>media</option>
                <option value="alta" @selected(old('dificultad', $proyecto->dificultad) === 'alta')>alta</option>
            </select>
        </p>

        <p>
            <button type="submit">Actualizar proyecto</button>
        </p>
    </form>

    <p>
        <a href="{{ route('proyectos.index') }}">Volver al listado</a>
    </p>
@endsection
