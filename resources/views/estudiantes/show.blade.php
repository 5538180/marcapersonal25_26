{{-- Flujo: routes/web.php -> estudianteController@show -> resources/views/estudiantes/show.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Ver estudiante')

@section('contenido')
    <h2>{{ $estudiante->nombre }}</h2>

    <ul>
        <li><strong>Nombre:</strong> {{ $estudiante->nombre }}</li>
        <li><strong>Slug:</strong> {{ $estudiante->slug }}</li>
        <li><strong>Dificultad:</strong> {{ $estudiante->dificultad }}</li>
        <li><strong>URL:</strong> {{ $estudiante->url ?: 'Sin URL' }}</li>
        <li><strong>Imagen:</strong> {{ $estudiante->imagen ?: 'Sin imagen' }}</li>
        <li><strong>Descripcion:</strong> {{ $estudiante->descripcion }}</li>
    </ul>

    <p>
        <a href="{{ route('estudiantes.edit', $estudiante) }}">Editar</a>
    </p>

    <p>
        <a href="{{ route('estudiantes.index') }}">Volver al listado</a>
    </p>
@endsection
