<!DOCTYPE HTML>
<!--
    Layout público de Marca Personal FP.
    Basado en la plantilla "Dopetrope" de HTML5 UP (html5up.net | @ajlkn),
    publicada bajo licencia CCA 3.0. Los assets se sirven desde public/dopetrope.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>@yield('titulo', 'Marca Personal FP')</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="{{ asset('dopetrope/assets/css/main.css') }}" />
    </head>
    <body class="homepage is-preload">
        <div id="page-wrapper">

            {{-- Cabecera: logo, navegación y banner --}}
            @include('partials.header')

            {{-- Mensajes de sesión --}}
            @if (session('status'))
                <section id="status" class="container">
                    <div class="row">
                        <div class="col-12">
                            <p>{{ session('status') }}</p>
                        </div>
                    </div>
                </section>
            @endif

            {{-- Contenido principal de cada página --}}
            <section id="main">
                <div class="container">
                    <div class="row">
                        <div id="content" class="@hasSection('sidebar') col-8 col-12-medium imp-medium @else col-12 @endif">
                            @yield('contenido')
                        </div>

                        {{-- Barra lateral opcional: una página la activa definiendo @section('sidebar') --}}
                        @hasSection('sidebar')
                            <div id="sidebar" class="col-4 col-12-medium">
                                @include('partials.sidebar')
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            {{-- Pie de página --}}
            @include('partials.footer')

        </div>

        {{-- Scripts de Dopetrope (jQuery y plugins), al final del body como en el HTML original --}}
        <script src="{{ asset('dopetrope/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('dopetrope/assets/js/jquery.dropotron.min.js') }}"></script>
        <script src="{{ asset('dopetrope/assets/js/browser.min.js') }}"></script>
        <script src="{{ asset('dopetrope/assets/js/breakpoints.min.js') }}"></script>
        <script src="{{ asset('dopetrope/assets/js/util.js') }}"></script>
        <script src="{{ asset('dopetrope/assets/js/main.js') }}"></script>

    </body>
</html>
