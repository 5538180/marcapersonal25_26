{{-- Cabecera de Dopetrope: logo + navegación + banner --}}
<section id="header">

    {{-- Logo --}}
    <h1><a href="{{ route('home') }}">Marca Personal FP</a></h1>

    {{-- Navegación --}}
    @include('partials.nav')

    {{-- Banner --}}
    <section id="banner">
        <header>
            <h2>El portfolio del alumnado de FP</h2>
            <p>Familias profesionales, ciclos, proyectos, estudiantes y docentes en un solo lugar</p>
        </header>
    </section>

</section>
