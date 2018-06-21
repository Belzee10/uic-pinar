<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UIC Pinar del Río - @yield('title')</title>

    <link rel="icon" type="image/x-icon" href="{{asset('backend/img/favicon.ico')}}">
    <!-- Material Design Font -->
    <link rel="stylesheet" href="{{asset('backend/plugins/materialdesign-webfont/css/materialdesignicons.css')}}">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('backend/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{asset('backend/css/mdb.min.css')}}" rel="stylesheet">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{asset('backend/plugins/gijgo-combined/css/gijgo.min.css')}}">
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet">
    @yield('css')
</head>
<body>
    @section('header')
    <nav class="navbar fixed-top navbar-expand-lg navbar-light">
        <div class="container">    
            <a class="navbar-brand" href="{{ route('portada') }}">
            <img src="{{asset('frontend/img/mdb-email.png')}}" height="30" alt="">
            </a>    
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">    
            <ul class="navbar-nav mr-auto">
                <li @if($page == 'portada') class="nav-item active" @else class="nav-item" @endif>
                    <a class="nav-link" href="{{ route('portada') }}">Portada
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li @if($page == 'clubes') class="nav-item active" @else class="nav-item" @endif>
                    <a class="nav-link" href="{{ route('clubes') }}">Clubes</a>
                </li>
                <li @if($page == 'cursos') class="nav-item active" @else class="nav-item" @endif>
                    <a class="nav-link" href="{{ route('cursos') }}">Cursos</a>
                </li>
                <li @if($page == 'actividades') class="nav-item active" @else class="nav-item" @endif>
                    <a class="nav-link" href="{{ route('actividades') }}">Actividades</a>
                </li>
                <li @if($page == 'repositorio') class="nav-item active" @else class="nav-item" @endif>
                    <a class="nav-link" href="{{ route('repositorio') }}">Repositorio</a>
                </li>
                <li @if($page == 'mision') class="nav-item active" @else class="nav-item" @endif>
                    <a class="nav-link" href="{{ route('mision') }}">Misión</a>
                </li>              
            </ul>    
            <ul class="navbar-nav nav-flex-icons"> 
                @if (Auth::user())                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->email}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                            <a class="dropdown-item" href="{{ route('welcome') }}">
                                Panel de administración
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
                @else    
                    <li class="nav-item">
                        <a href="{{ route('signin') }}" class="nav-link text-small waves-effect waves-light">
                            Acceder
                        </a>
                    </li>         
                    <li class="nav-item">
                        <a href="{{ route('signup') }}" class="btn btn-main btn-rounded btn-sm font-weight-bold waves-effect waves-light">
                            Inscripción
                        </a>
                    </li>
                @endif
            </ul>    
            </div>    
        </div>
    </nav>
    @show

    <main>
        @yield('content') 
    </main>

    @section('footer')
    <footer class="page-footer text-center font-small wow fadeIn mt-5">      
        <div class="social-networks">
            <div class="container">
            <div class="row py-4 d-flex align-items-center">
                <div class="col-md-6 col-lg-5 text-center text-md-left mb-md-0">
                <h6 class="mb-0 white-text">Mantente en contacto con nosotros</h6>
                </div>
                <div class="col-md-6 col-lg-7 text-center text-md-right">
                <a class="p-2 m-2 ml-0">
                    <i class="mdi mdi-facebook mdi-24px"></i>
                </a>
                <a class="p-2 m-2 ml-0">
                    <i class="mdi mdi-twitter mdi-24px"></i>
                </a>
                <a class="p-2 m-2 ml-0">
                    <i class="mdi mdi-linkedin mdi-24px"></i>
                </a>
                </div>
            </div>
            </div>
        </div>      
        <div class="container text-center text-md-left information">
            <div class="row">  
                <div class="col-md-4">
                    <h5 class="text-capitalize">
                    <strong>Sobre Nosotros</strong>
                    </h5>
                    <hr class="secondary-color accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <div class="row">
                    <div class="col-md-9">
                        <p>
                        Quisque velit nisi, pretium ut lacinia in, elementum id enim.
                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.
                        Donec rutrum congue leo eget malesuada. Curabitur aliquet quam 
                        id dui posuere blandit. Donec rutrum congue leo eget malesuada.
                        </p>
                    </div>
                    </div>
                </div>  
                <div class="col-md-4">
                    <h5 class="text-capitalize">
                    <strong>Enlaces</strong>
                    </h5>
                    <hr class="secondary-color accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('portada') }}">Portada</a>
                        </li>
                        <li>
                            <a href="{{ route('clubes') }}">Clubes</a>
                        </li>
                        <li>
                            <a href="{{ route('cursos') }}">Cursos</a>
                        </li>
                        <li>
                            <a href="{{ route('actividades') }}">Actividades</a>
                        </li>
                        <li>
                            <a href="{{ route('repositorio') }}">Repositorio</a>
                        </li>
                        <li>
                            <a href="{{ route('mision') }}">Misión</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="text-capitalize">
                    <strong>Contacto</strong>
                    </h5>
                    <hr class="secondary-color accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">
                            <i class="mdi mdi-home"></i>
                            Portada
                            </a>
                        </li>     
                        <li>
                            <a href="#!">
                            <i class="mdi mdi-email"></i>
                            example@email.com
                            </a>
                        </li>       
                        <li>
                            <a href="#!">
                            <i class="mdi mdi-phone"></i>
                            48765678
                            </a>
                        </li>          
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright py-3">
            © 2018 Todos los derechos reservados:
            <a href="#"> Unión de informáticos de Cuba </a>
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
    <script src="{{asset('backend/plugins/gijgo-combined/js/gijgo.min.js')}}"></script>
    <script src="{{asset('backend/plugins/gijgo-combined/js/messages/messages.es-es.min.js')}}"></script>
    <!--Custom js -->

    <script type="text/javascript">
        // Animations initialization
        new WOW().init();
    </script>  

    @yield('js')
    
</body>
</html>