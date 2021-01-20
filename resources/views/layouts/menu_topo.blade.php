<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NUTRIFMG') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/selectize.min.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/selectize.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style type="text/css">
        #menu:hover{
            background-color: #faf6e6;
        }
        #sair:hover{
            background-color: #cc1717;
        }
        body{
            background-color: #fffefa;

        }

    </style>



</head>
<body >
    <div id="app" >

        <nav class="navbar navbar-expand-md  shadow-sm " style="background-color: #1abaad">

            <div class="container">

                <a href="{{ url('/home') }}">
                    <img src="{{url('image/logo.png')}}" class="img-fluid " alt="Responsive image" style="max-width: 70px">
                </a>

            </div>
            <!-- <nav class="p-3 mb-2 bg-secondary text-white"> -->
                <div class="container">

                <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
                <!-- <a href="{{ url('/') }}">
                    {{ config ('app.name','Avaliação')}}
                </a> -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="menu" class="btn btn btn-outline-light" href="{{ url('/home') }}" style="border-radius: 50px;">
                                <!-- {{ config('app.name', 'NUTRIFMG') }} -->
                                <i class="material-icons">home</i>&nbsp Início
                            </a>
                            <a id="menu"class="btn btn-outline-light" href="{{Route('paciente.cadastrar')}}" style="border-radius: 50px;">
                                <!-- {{ config('app.name', 'NUTRIFMG') }} -->
                                <i class="material-icons">person_add</i>&nbsp Cadastrar
                            </a>
                            <a id="menu"class="btn btn-outline-light" href="{{Route('paciente.pesquisar')}}" style="border-radius: 50px;">
                                <!-- {{ config('app.name', 'NUTRIFMG') }} -->
                                <i class="material-icons">assignment_ind</i>&nbsp Av. Individual
                            </a>
                            <a id="menu"class="btn btn-outline-light" href="{{Route('graficos')}}" style="border-radius: 50px;">
                                <!-- {{ config('app.name', 'NUTRIFMG') }} -->
                                <i class="material-icons">assignment_ind</i>&nbsp Av. Grupo
                            </a>
                            <!-- <a class="btn btn-outline-light" href="{{ url('/') }}">
                                 {{ config('app.name', 'NUTRIFMG') }}
                                <i class="material-icons">find_in_page</i>&nbsp Ver Informações
                            </a> -->
                            <a id="sair"id="navbarDropdown" class="btn btn-outline-light dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="border-radius: 50px;">
                             <i class="material-icons">cancel</i>
                             <!-- {{ Auth::user()->name }} --> Sair<span class="caret"></span>

                         </a>

                         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Sair do Sistema') }}

                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<main class="py-4 ">
    @yield('content')
</main>
</div>
</body>
</html>
