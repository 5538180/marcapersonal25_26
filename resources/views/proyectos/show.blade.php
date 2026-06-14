{{-- Flujo: routes/web.php -> ProyectoController@show -> resources/views/proyectos/show.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Ver proyecto')

@section('contenido')
    <h2>{{ $proyecto->nombre }}</h2>

    <ul>
        <li><strong>Nombre:</strong> {{ $proyecto->nombre }}</li>
        <li><strong>Slug:</strong> {{ $proyecto->slug }}</li>
        <li><strong>Dificultad:</strong> {{ $proyecto->dificultad }}</li>
        <li><strong>URL:</strong> {{ $proyecto->url ?: 'Sin URL' }}</li>
        <li><strong>Imagen:</strong> {{ $proyecto->imagen ?: 'Sin imagen' }}</li>
        <li><strong>Descripcion:</strong> {{ $proyecto->descripcion }}</li>
    </ul>

    <p>
        <a href="{{ route('proyectos.edit', $proyecto) }}">Editar</a>
    </p>

    <p>
        <a href="{{ route('proyectos.index') }}">Volver al listado</a>
    </p>
@endsection
