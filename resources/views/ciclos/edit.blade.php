{{-- Flujo: routes/web.php -> CicloFormativoController@edit -> resources/views/ciclos/edit.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Editar ciclo superior')

@section('contenido')
    <h2>Editar ciclo formativo de grado superior</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('ciclos.update', $ciclo) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label for="familia_profesional_id">Familia profesional</label><br>
            <select name="familia_profesional_id" id="familia_profesional_id">
                <option value="">Selecciona una familia</option>
                @foreach ($familias as $familia)
                    <option value="{{ $familia->id }}" @selected(old('familia_profesional_id', $ciclo->familia_profesional_id) == $familia->id)>
                        {{ $familia->nombre }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label for="codigo">Codigo</label><br>
            <input type="text" name="codigo" id="codigo" value="{{ old('codigo', $ciclo->codigo) }}">
        </p>

        <p>
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $ciclo->nombre) }}">
        </p>

        <p>
            <label for="slug">Slug</label><br>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $ciclo->slug) }}">
        </p>

        <p>El grado se mantiene como superior.</p>

        <p>
            <button type="submit">Actualizar ciclo</button>
        </p>
    </form>

    <p>
        <a href="{{ route('ciclos.index') }}">Volver al listado</a>
    </p>
@endsection
