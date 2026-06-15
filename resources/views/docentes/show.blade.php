{{-- Flujo: routes/web.php -> DocenteController@show -> resources/views/docentes/show.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Ver docente')

@section('contenido')
    <h2>{{ $docente->nombre }} {{ $docente->apellidos }}</h2>

    <ul>
        <li><strong>ID de usuario:</strong> {{ $docente->user_id ?: 'Sin usuario asociado' }}</li>
        <li><strong>Nombre:</strong> {{ $docente->nombre }}</li>
        <li><strong>Apellidos:</strong> {{ $docente->apellidos }}</li>
        <li><strong>Email:</strong> {{ $docente->email }}</li>
        <li><strong>Slug:</strong> {{ $docente->slug }}</li>
    </ul>

    <p>
        <a href="{{ route('docentes.edit', $docente) }}">Editar</a>
    </p>

    <p>
        <a href="{{ route('docentes.index') }}">Volver al listado</a>
    </p>
@endsection
