@extends('layouts.app')

@section('titulo', 'Inicio · Marca Personal FP')

@section('contenido')

    {{-- Introducción: tres bloques destacados --}}
    <section>
        <div class="row">
            <div class="col-4 col-12-medium">
                <section class="first">
                    <i class="icon solid featured fa-graduation-cap"></i>
                    <header>
                        <h2>Aprende y demuestra</h2>
                    </header>
                    <p>Reúne tus proyectos de ciclo y construye tu marca personal como estudiante de FP.</p>
                </section>
            </div>
            <div class="col-4 col-12-medium">
                <section class="middle">
                    <i class="icon solid featured alt fa-sitemap"></i>
                    <header>
                        <h2>Familias y ciclos</h2>
                    </header>
                    <p>Explora las familias profesionales y los ciclos formativos disponibles en el centro.</p>
                </section>
            </div>
            <div class="col-4 col-12-medium">
                <section class="last">
                    <i class="icon solid featured alt2 fa-users"></i>
                    <header>
                        <h2>Estudiantes y docentes</h2>
                    </header>
                    <p>Conecta al alumnado con el profesorado a través de los proyectos publicados.</p>
                </section>
            </div>
        </div>
        <footer>
            <ul class="actions">
                <li><a href="{{ route('register') }}" class="button large">Empezar</a></li>
                <li><a href="#" class="button alt large">Saber más</a></li>
            </ul>
        </footer>
    </section>

    {{-- Portfolio de proyectos --}}
    <section>
        <header class="major">
            <h2>Proyectos destacados</h2>
        </header>
        <div class="row">
            @foreach (['pic02', 'pic03', 'pic04', 'pic05', 'pic06', 'pic07'] as $img)
                <div class="col-4 col-6-medium col-12-small">
                    <section class="box">
                        <a href="#" class="image featured"><img src="{{ asset('dopetrope/images/' . $img . '.jpg') }}" alt="" /></a>
                        <header>
                            <h3>Proyecto de ejemplo</h3>
                        </header>
                        <p>Espacio reservado para la descripción de un proyecto del alumnado de FP. El contenido real llegará en próximos commits.</p>
                        <footer>
                            <ul class="actions">
                                <li><a href="#" class="button alt">Ver proyecto</a></li>
                            </ul>
                        </footer>
                    </section>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Novedades / blog --}}
    <section>
        <header class="major">
            <h2>Novedades</h2>
        </header>
        <div class="row">
            <div class="col-6 col-12-small">
                <section class="box">
                    <a href="#" class="image featured"><img src="{{ asset('dopetrope/images/pic08.jpg') }}" alt="" /></a>
                    <header>
                        <h3>Bienvenida a Marca Personal FP</h3>
                        <p>Publicado hoy</p>
                    </header>
                    <p>Esta es la página de inicio del proyecto. En esta primera entrega solo se ha montado el andamiaje: Laravel, Breeze, Sanctum y la plantilla Dopetrope.</p>
                    <footer>
                        <ul class="actions">
                            <li><a href="#" class="button icon solid fa-file-alt">Seguir leyendo</a></li>
                        </ul>
                    </footer>
                </section>
            </div>
            <div class="col-6 col-12-small">
                <section class="box">
                    <a href="#" class="image featured"><img src="{{ asset('dopetrope/images/pic09.jpg') }}" alt="" /></a>
                    <header>
                        <h3>Próximos pasos</h3>
                        <p>Publicado hoy</p>
                    </header>
                    <p>En los siguientes commits se añadirán las migraciones de dominio, los modelos, los controladores y la API con sus recursos.</p>
                    <footer>
                        <ul class="actions">
                            <li><a href="#" class="button icon solid fa-file-alt">Seguir leyendo</a></li>
                        </ul>
                    </footer>
                </section>
            </div>
        </div>
    </section>

@endsection
