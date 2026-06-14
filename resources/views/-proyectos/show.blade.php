{{-- Flujo antiguo: routes/web.php -> ProyectoController@show -> resources/views/proyectos/show.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', $proyecto->nombre.' · Marca Personal FP')

@section('contenido')
    <article class="box post">
        <a href="#" class="image featured">
            <img src="{{ $proyecto->imagen ? asset($proyecto->imagen) : asset('dopetrope/images/pic03.jpg') }}" alt="{{ $proyecto->nombre }}" />
        </a>
        <header>
            <h2>{{ $proyecto->nombre }}</h2>
            <p>Dificultad: {{ ucfirst($proyecto->dificultad) }}</p>
        </header>

        <p>{{ $proyecto->descripcion }}</p>

        @if ($proyecto->url)
            <p><a href="{{ $proyecto->url }}" target="_blank" rel="noopener">Abrir enlace del proyecto</a></p>
        @endif

        <p><strong>Slug:</strong> {{ $proyecto->slug }}</p>

        <footer>
            <ul class="actions">
                <li><a href="{{ route('proyectos.index') }}" class="button alt">Volver</a></li>
                <li><a href="{{ route('proyectos.edit', $proyecto) }}" class="button">Editar</a></li>
            </ul>
        </footer>
    </article>
@endsection
