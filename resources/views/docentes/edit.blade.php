{{-- Flujo: routes/web.php -> DocenteController@edit -> resources/views/docentes/edit.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Editar docente')

@section('contenido')
    <h2>Editar docente</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('docentes.update', $docente) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label for="user_id">ID de usuario</label><br>
            <input type="number" name="user_id" id="user_id" value="{{ old('user_id', $docente->user_id) }}">
        </p>

        <p>
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $docente->nombre) }}">
        </p>

        <p>
            <label for="apellidos">Apellidos</label><br>
            <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos', $docente->apellidos) }}">
        </p>

        <p>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" value="{{ old('email', $docente->email) }}">
        </p>

        <p>
            <label for="slug">Slug</label><br>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $docente->slug) }}">
        </p>

        <p>
            <button type="submit">Actualizar docente</button>
        </p>
    </form>

    <p>
        <a href="{{ route('docentes.index') }}">Volver al listado</a>
    </p>
@endsection
