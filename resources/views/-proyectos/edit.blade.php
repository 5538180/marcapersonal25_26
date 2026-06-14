{{-- Flujo antiguo: routes/web.php -> ProyectoController@edit -> resources/views/proyectos/edit.blade.php --}}
{{-- Esta vista extiende resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Editar proyecto · Marca Personal FP')

@section('contenido')
    <section>
        <header class="major">
            <h2>Editar proyecto</h2>
        </header>

        @include('proyectos._form', [
            'proyecto' => $proyecto,
            'action' => route('proyectos.update', $proyecto),
            'method' => 'PUT',
            'boton' => 'Actualizar proyecto',
        ])
    </section>
@endsection
