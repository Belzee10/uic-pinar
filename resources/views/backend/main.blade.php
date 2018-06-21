<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UIC - @yield('title')</title>

    <link rel="icon" type="image/x-icon" href="{{asset('backend/img/favicon.ico')}}">
    <!-- Material Design Font -->
    <link rel="stylesheet" href="{{asset('backend/plugins/materialdesign-webfont/css/materialdesignicons.css')}}">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('backend/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{asset('backend/css/mdb.min.css')}}" rel="stylesheet">
    <!-- Plugins -->    
    <link rel="stylesheet" href="{{asset('backend/plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.css')}}">
    <link href="{{asset('backend/plugins/chosen/chosen.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/gijgo-combined/css/gijgo.min.css')}}">
    <!-- Custom styles -->
    <link href="{{asset('backend/css/custom.css')}}" rel="stylesheet">

</head>
<body class="grey lighten-3">
    @section('header')
    <!--Main Navigation-->
    <header>        
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark elegant-color-dark scrolling-navbar">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="navbar-brand waves-effect" href="{{route('welcome')}}">
                    <strong class="blue-text">UIC</strong>
                </a>
                <!-- Collapse -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left -->
                    <ul class="navbar-nav mr-auto "></ul>
                    <ul class="navbar-nav mr-auto d-lg-none"> 
                        @if(Auth::user()->rol == 'admin')
                        <li @if($page == 'organismos') class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link waves-effect" href="{{route('organismos.index')}}">
                                <i class="mdi mdi-bank mr-3"></i>Organismos                                
                            </a>
                        </li>
                        <li @if($page == 'delegacionesbase') class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link waves-effect" href="{{route('delegacionesbase.index')}}">
                                <i class="mdi mdi-account-multiple-outline mr-3"></i>Delegaciones Base
                            </a>
                        </li> 
                        <li @if($page == 'users') class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link waves-effect" href="{{route('users.index')}}">
                                <i class="mdi mdi-account-multiple mr-3"></i>Usuarios
                            </a>
                        </li>
                        <li @if($page == 'cotizaciones') class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link waves-effect" href="{{route('cotizaciones')}}">
                                <i class="mdi mdi-currency-usd mr-3"></i>Cotizaciones
                            </a>
                        </li>

                        <li @if($page == 'clubes') class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link waves-effect" href="{{route('clubes.index')}}">
                                <i class="mdi mdi-desktop-mac mr-3"></i>Clubes
                            </a>
                        </li>
                        <li @if($page == 'cursos') class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link waves-effect" href="{{route('cursos.index')}}">
                                <i class="mdi mdi-lead-pencil mr-3"></i>Cursos
                            </a>
                        </li>
                        <li @if($page == 'actividades') class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link waves-effect" href="{{route('actividades.index')}}">
                                <i class="mdi mdi-calendar-text mr-3"></i>Actividades
                            </a>
                        </li>
                        <li @if($page == 'ficheros') class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link waves-effect" href="{{route('ficheros.index')}}">
                                <i class="mdi mdi-database mr-3"></i>Repositorio
                            </a>
                        </li>      
                        <li @if($page == 'solicitudes_membresia') class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link waves-effect" href="{{route('solicitudes_membresia')}}">
                                <i class="mdi mdi-database mr-3"></i>Solic. de membresía
                            </a>
                        </li>  
                        @endif                       
                        <li class="nav-item">
                            <a class="nav-link waves-effect" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="mdi mdi-file-document-box mr-3"></i>Reportes<i class="mdi mdi-menu-down float-right"></i>
                            </a>
                            <ul class="collapse" id="collapseExample1">
                                <li @if($page == 'listado_miembros') class="nav-item active" @else class="nav-item" @endif>
                                    <a class="nav-link waves-effect" href="{{route('listado_miembros')}}">
                                        Listado de miembros UIC
                                    </a>
                                </li>
                                <li @if($page == 'planilla_solicitud') class="nav-item active" @else class="nav-item" @endif>
                                    <a class="nav-link waves-effect" href="{{route('planilla_solicitud')}}">
                                        Planilla de solicitud de ingreso
                                    </a>
                                </li>
                                <li @if($page == 'listado_cotizaciones') class="nav-item active" @else class="nav-item" @endif>
                                    <a class="nav-link waves-effect" href="{{route('listado_cotizaciones')}}">
                                        Listado de cotizaciones
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    <!-- Right -->
                    <ul class="navbar-nav nav-flex-icons">                           
                        @if (Auth::user())                    
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{Auth::user()->email}}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                                    <a class="dropdown-item" href="{{ route('portada') }}">
                                        Ir a la portada
                                    </a>
                                    <a class="dropdown-item" href="{{ route('password_change') }}">
                                        Cambiar contraseña
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>      
                        @endif                  
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar -->
        <!-- Sidebar -->
        <div class="sidebar-fixed position-fixed">
            <div class="mask rgba-black-light ">
                <div class="text-center">
                    <a href="{{route('welcome')}}" class="logo-wrapper waves-effect">
                        <img src="{{asset('backend/img/mdb-email.png')}}" class="img-fluid" alt="">
                    </a>
                </div>                
                <ul class="list-group list-group-flush">
                    @if(Auth::user()->rol == 'admin')
                    <li @if($page == 'organismos') class="active" @endif>
                        <a class="list-group-item waves-effect" href="{{route('organismos.index')}}">
                            <i class="mdi mdi-bank mr-3"></i>Organismos
                        </a>
                    </li>
                    <li @if($page == 'delegacionesbase') class="active" @endif>
                        <a class="list-group-item waves-effect" href="{{route('delegacionesbase.index')}}">
                            <i class="mdi mdi-account-multiple-outline mr-3"></i>Delegaciones Base
                        </a>
                    </li>                    
                    <li @if($page == 'users') class="active" @endif>
                        <a class="list-group-item waves-effect" href="{{route('users.index')}}">
                            <i class="mdi mdi-account-multiple mr-3"></i>Usuarios
                        </a>
                    </li>
                    <li @if($page == 'cotizaciones') class="active" @endif>
                        <a class="list-group-item waves-effect" href="{{route('cotizaciones')}}">
                            <i class="mdi mdi-currency-usd mr-3"></i>Cotizaciones
                        </a>
                    </li>
                    <li @if($page == 'clubes') class="active" @endif>
                        <a class="list-group-item waves-effect" href="{{route('clubes.index')}}">
                            <i class="mdi mdi-desktop-mac mr-3"></i>Clubes
                        </a>
                    </li>
                    <li @if($page == 'cursos') class="active" @endif>
                        <a class="list-group-item waves-effect" href="{{route('cursos.index')}}">
                            <i class="mdi mdi-lead-pencil mr-3"></i>Cursos
                        </a>
                    </li>
                    <li @if($page == 'actividades') class="active" @endif>
                        <a class="list-group-item waves-effect" href="{{route('actividades.index')}}">
                            <i class="mdi mdi-calendar-text mr-3"></i>Actividades
                        </a>
                    </li>
                    <li @if($page == 'ficheros') class="active" @endif>
                        <a class="list-group-item waves-effect" href="{{route('ficheros.index')}}">
                            <i class="mdi mdi-database mr-3"></i>Repositorio
                        </a>
                    </li>    
                    <li @if($page == 'solicitudes_membresia') class="active" @endif>
                        <a class="list-group-item waves-effect" href="{{route('solicitudes_membresia')}}">
                            <i class="mdi mdi-account-check mr-3"></i>Solic. de membresía
                            @php ($us = App\User::where('activo', false)->get())
                            @if( $us->count() >= 1)
                                <span class="badge badge-primary">{{$us->count()}}</span>
                            @endif
                        </a>
                    </li>  
                    @endif                           
                    <li>
                        <a class="list-group-item waves-effect" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="mdi mdi-file-document-box mr-3"></i>Reportes<i class="mdi mdi-menu-down float-right"></i>
                        </a>
                        <ul id="collapseExample" @if($page == 'listado_miembros' or $page == 'planilla_solicitud' or $page == 'listado_cotizaciones') class="collapse show" @else class="collapse" @endif>
                            <li @if($page == 'listado_miembros') class="active" @endif>
                                <a class="list-group-item waves-effect" href="{{route('listado_miembros')}}">
                                    Listado de miembros UIC
                                </a>
                            </li>
                            <li @if($page == 'planilla_solicitud') class="active" @endif>
                                <a class="list-group-item waves-effect" href="{{route('planilla_solicitud')}}">
                                    Planilla de solicitud de ingreso
                                </a>
                            </li>
                            <li @if($page == 'listado_cotizaciones') class="active" @endif>
                                <a class="list-group-item waves-effect" href="{{route('listado_cotizaciones')}}">
                                    Listado de cotizaciones
                                </a>
                            </li>
                        </ul>
                    </li> 
                </ul>                
            </div>            
        </div>        
        <!-- Sidebar -->
    </header>
    <!--Main Navigation-->
    @show

    <!--Main layout-->
    <main class="pt-5 mx-lg-5">
        <div class="container-fluid mt-5">
            @yield('content')             
        </div>
    </main>
    <!--Main layout-->

    @section('footer')
        <footer class="page-footer text-center font-small elegant-color-dark darken-2 mt-4 wow fadeIn">  
        <div class="footer-copyright py-3">
            © 2018 Todos los derechos reservados:
            <a href="{{route('welcome')}}"> UIC Pinar del Río</a>
        </div>
    </footer>
    @show

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="{{asset('backend/js/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{asset('backend/js/popper.min.js')}}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{asset('backend/js/bootstrap.min.js')}}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{asset('backend/js/mdb.min.js')}}"></script>    
    <!-- Plugins -->
    <script type="text/javascript" src="{{asset('backend/plugins/chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('backend/plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/i18n/es.js')}}"></script>
    <script src="{{asset('backend/plugins/gijgo-combined/js/gijgo.min.js')}}"></script>
    <script src="{{asset('backend/plugins/gijgo-combined/js/messages/messages.es-es.min.js')}}"></script>
    <!--Custom js -->
    <script type="text/javascript" src="{{asset('backend/js/app.js')}}"></script>

    <!-- Initializations -->
    <script>
        (function($){
            $(window).on("load",function(){   
                
                $(".sidebar-fixed .mask").mCustomScrollbar({
                    theme:"my-theme",
                    scrollInertia: 200
                }); 
                
            });
        })(jQuery);
    </script>

    <script type="text/javascript">
        // Animations initialization
        new WOW().init();
    </script>  

    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>

    @yield('js')
    
</body>
</html>