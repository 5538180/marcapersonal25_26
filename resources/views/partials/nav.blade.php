{{-- Navegación principal (Dopetrope) --}}
<nav id="nav">
    <ul>
        <li class="current"><a href="{{ route('home') }}">Inicio</a></li>
        <li>
            <a href="#">Catálogo</a>
            <ul>
                <li><a href="#">Familias profesionales</a></li>
                <li><a href="{{ route('ciclos.index') }}">Ciclos formativos</a></li>
                <li><a href="{{ route('proyectos.index') }}">Proyectos</a></li>
                <li><a href="{{ route('estudiantes.index') }}">Estudiantes</a></li>
                <li><a href="#">Docentes</a></li>
            </ul>
        </li>
        <li><a href="#">Acerca de</a></li>

        @guest
            <li><a href="{{ route('login') }}">Entrar</a></li>
            <li><a href="{{ route('register') }}">Registrarse</a></li>
        @else
            <li><a href="{{ route('dashboard') }}">Panel</a></li>
            <li><a href="{{ route('proyectos.create') }}">Nuevo proyecto</a></li>
            <li>
                <a href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Salir
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @endguest
    </ul>
</nav>
