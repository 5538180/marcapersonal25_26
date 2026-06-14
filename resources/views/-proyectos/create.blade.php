{{-- Flujo antiguo: routes/web.php -> ProyectoController@create -> resources/views/proyectos/create.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Crear proyecto · Marca Personal FP')

@section('contenido')
    <section>
        <header class="major">
            <h2>Crear proyecto</h2>
        </header>

        @include('proyectos._form', [
            'proyecto' => null,
            'action' => route('proyectos.store'),
            'method' => 'POST',
            'boton' => 'Crear proyecto',
        ])
    </section>
@endsection
