{{-- Flujo: routes/web.php -> CicloFormativoController@create -> resources/views/ciclos/create.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Crear ciclo superior')

@section('contenido')
    <h2>Crear ciclo formativo de grado superior</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('ciclos.store') }}" method="POST">
        @csrf

        <x-select-vista-ciclos-create />

        <p>
            <label for="codigo">Codigo</label><br>
            <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}">
        </p>

        <p>
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
        </p>

        <p>
            <label for="slug">Slug</label><br>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}">
        </p>

        <p>El grado se guarda automaticamente como superior.</p>

        <p>
            <button type="submit">Guardar ciclo</button>
        </p>
    </form>

    <p>
        <a href="{{ route('ciclos.index') }}">Volver al listado</a>
    </p>
@endsection
