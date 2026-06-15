{{-- Flujo: routes/web.php -> DocenteController@create -> resources/views/docentes/create.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Crear docente')

@section('contenido')
    <h2>Crear docente</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('docentes.store') }}" method="POST">
        @csrf

        <p>
            <label for="user_id">ID de usuario</label><br>
            <input type="number" name="user_id" id="user_id" value="{{ old('user_id') }}">
        </p>

        <p>
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
        </p>

        <p>
            <label for="apellidos">Apellidos</label><br>
            <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos') }}">
        </p>

        <p>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </p>

        <p>
            <label for="slug">Slug</label><br>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}">
        </p>

        <p>
            <button type="submit">Guardar docente</button>
        </p>
    </form>

    <p>
        <a href="{{ route('docentes.index') }}">Volver al listado</a>
    </p>
@endsection
