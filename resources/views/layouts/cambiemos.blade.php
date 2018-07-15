<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet" href="{{asset('css/bootstrap-material-design.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
    <script src="{{asset('js/jquery-3.2.1.slim.min.js')}}" ></script>
    <script src="{{asset('js/jquery-3.3.1.js')}}" ></script>

</head>
<body>
<style>
    .margin-top-central{
        margin-top: 20px;
    }
    .dropdown-menu{
        margin-left: -58px;
    }
</style>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{url('/')}}"><span style="border-bottom: 1px solid #F1C40F;">Cambiemos</span></a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item ">
                    <a class="nav-link" href="{{url('/')}}">Inicio</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{url('calendario-reuniones-sala')}}">Calendario Sala de reuniones</a>
                </li>
                @if (!Auth::guest())
                    <li class="nav-item ">
                        <a class="nav-link" href="{{url('gastos')}}">Gastos</a>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav pull-right">
                @if (Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Ingresar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @else
                    <div class="dropdown pull-xs-right text-white bg-dark">
                        {{ Auth::user()->name }}
                        <button class="btn bmd-btn-icon dropdown-toggle" type="button" id="lr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="lr1">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Salir
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                @endif
            </ul>
        </div>
    </nav>
    <div class="container margin-top-central">
        <input type="hidden" value="{{URL::to('/')}}" id="baseUrl">
        <script>
            var baseUrl = $("#baseUrl").val();
        </script>
        @yield('content')
    </div>
</div>

<script src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/bootstrap-material-design.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
@yield('scripts')
</body>
</html>
