<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="api_token" content="{{ Auth::user() != null ? Auth::user()->api_token : "" }}">
    

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/utilities/scripts.js') }}" defer></script>
    <script>
        var Laravel = {
            "user":{
                "id":""
            }
        };
        @if(Auth::check())
            Laravel.user.id = {{ Auth::user()->id }};
        @endif
    </script>


    @yield('more_scripts')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container-fluid">
                
                <div id="modalPrincipal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalPrincipalHeader">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="modalPrincipalBody">
                                <p>Modal body text goes here.</p>
                            </div>
                            <div class="modal-footer" id="modalPrincipalFooter">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    @guest
                    
                    @else
                        <li><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkAdministracao" data-toggle="dropdown" >
                                Chamados
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('chamado.index') }}">Pesquisar</a>
                                <a class="dropdown-item" href="{{ route('chamado.create') }}">Novo Chamado</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">

                            @if(auth()->user()->can('web listar organizacao',"web") 
                                || auth()->user()->can('web listar categoria',"web") 
                                || auth()->user()->can('web listar feedback',"web") 
                                || auth()->user()->can('web listar prioridade',"web") 
                                || auth()->user()->can('web listar urgencia',"web") 
                                || auth()->user()->can('web listar situacao',"web") 
                                || auth()->user()->can('web listar servico',"web") )

                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkAdministracao" data-toggle="dropdown" >
                                    Administração
                                </a>
                            @endif
                            <div class="dropdown-menu">

                                @can('web listar organizacao',"web")
                                    <a class="dropdown-item" href="{{ route('organizacao.index') }}">Organizações</a>
                                @endcan

                                @can('web listar categoria',"web")
                                    <a class="dropdown-item" href="{{ route('chamado_categoria.index') }}">Categorias</a>
                                @endcan

                                @can('web listar feedback',"web")
                                    <a class="dropdown-item" href="{{ route('chamado_feedback.index') }}">Feedback</a>
                                @endcan

                                @can('web listar prioridade',"web")
                                    <a class="dropdown-item" href="{{ route('chamado_prioridade.index') }}">Prioridades</a>
                                @endcan

                                @can('web listar urgencia',"web")
                                    <a class="dropdown-item" href="{{ route('chamado_urgencia.index') }}">Urgências</a>
                                @endcan

                                @can('web listar situacao',"web")
                                    <a class="dropdown-item" href="{{ route('chamado_situacao.index') }}">Situações</a>
                                @endcan

                                @can('web listar servico',"web")
                                    <a class="dropdown-item" href="{{ route('servico.index') }}">Serviços</a>
                                @endcan
                            </div>
                        </li>
                        <li class="nav-item dropdown">

                            @if(auth()->user()->can('web listar usuario',"web") 
                                || auth()->user()->can('web listar perfil',"web"))
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkAdministracao" data-toggle="dropdown" >
                                    Configuracoes
                                </a>
                            @endif
                            <div class="dropdown-menu">
                                @can('web listar usuario',"web")
                                    <a class="dropdown-item" href="{{ route('user.index') }}">Usuario</a>
                                @endcan

                                @can('web listar perfil',"web")
                                    <a class="dropdown-item" href="{{ route('role.index') }}">Perfis e Permissoes</a>
                                @endcan
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkAdministracao" data-toggle="dropdown" >
                                Relatorios
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('report_geral') }}">Geral</a>
                                {{-- <a class="dropdown-item" href="{{ route('report_geral') }}">Situacoes</a> --}}
                                <a class="dropdown-item" href="{{ route('report_categorias') }}">Categorias</a>
                                {{-- <a class="dropdown-item" href="{{ route('report_geral') }}">Usuarios</a>                                 --}}
                            </div>
                        </li>
                    @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkNotificacoes" data-toggle="dropdown" >
                                    <i id="icone_notificacoes" class="material-icons">notifications_active</i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item text-center" id="btnUpdateNotifications" attr_page="1"><i class="material-icons">update</i></a>
                                    <div id="container_notificacoes">
                                    </div>
                                    <a class="dropdown-item text-center" id="btnOlderNotifications" attr_page="2"><i class="material-icons">keyboard_arrow_down</i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item whitespace_wrap" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
