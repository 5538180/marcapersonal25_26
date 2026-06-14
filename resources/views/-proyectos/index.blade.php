{{-- Flujo antiguo: routes/web.php -> ProyectoController@index -> resources/views/proyectos/index.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Proyectos · Marca Personal FP')

@section('contenido')
    <section>
        <header class="major">
            <h2>Proyectos</h2>
        </header>

        <footer>
            <ul class="actions">
                <li><a href="{{ route('proyectos.create') }}" class="button icon solid fa-plus">Nuevo proyecto</a></li>
                <li><a href="{{ route('home') }}" class="button alt">Volver al inicio</a></li>
            </ul>
        </footer>
    </section>

    <section>
        <div class="row">
            @forelse ($proyectos as $proyecto)
                <div class="col-4 col-6-medium col-12-small">
                    <section class="box">
                        <a href="{{ route('proyectos.show', $proyecto) }}" class="image featured">
                            <img src="{{ $proyecto->imagen ? asset($proyecto->imagen) : asset('dopetrope/images/pic02.jpg') }}" alt="{{ $proyecto->nombre }}" />
                        </a>
                        <header>
                            <h3>{{ $proyecto->nombre }}</h3>
                            <p>Dificultad: {{ ucfirst($proyecto->dificultad) }}</p>
                        </header>
                        <p>{{ \Illuminate\Support\Str::limit($proyecto->descripcion, 120) }}</p>
                        <footer>
                            <ul class="actions">
                                <li><a href="{{ route('proyectos.show', $proyecto) }}" class="button alt">Ver</a></li>
                                <li><a href="{{ route('proyectos.edit', $proyecto) }}" class="button alt">Editar</a></li>
                            </ul>
                            <form action="{{ route('proyectos.destroy', $proyecto) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button alt">Borrar</button>
                            </form>
                        </footer>
                    </section>
                </div>
            @empty
                <div class="col-12">
                    <section class="box">
                        <header>
                            <h3>No hay proyectos todavía</h3>
                        </header>
                        <p>Crea el primer proyecto para comprobar el flujo completo del CRUD.</p>
                        <footer>
                            <a href="{{ route('proyectos.create') }}" class="button">Crear proyecto</a>
                        </footer>
                    </section>
                </div>
            @endforelse
        </div>
    </section>
@endsection
