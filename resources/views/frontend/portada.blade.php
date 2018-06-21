@php($page='portada')
@extends('frontend.main')
@section('title', 'Bienvenido')

<div class="view" style="background-image: url({{asset('frontend/img/cover-image.jpg')}}); background-repeat: no-repeat; background-size: cover;">
<div class="mask rgba-indigo-strong d-flex justify-content-center align-items-center">
    <div class="text-left white-text mx-5 wow fadeIn">
    <div class="row">
        <div class="col-lg-7">
        <h1 class="mb-4">
            Propiciamos e impulsamos un clima de creación, 
            que tribute al desarrollo del país y a elevar el bienestar de la población.
        </h1>
        </div>
    </div>  
    </div>
</div>
</div>

@section('content')

<div class="container">
    <section id="objetives">
        <h2 class="text-center title wow fadeIn">
        <strong>Principales Objetivos</strong>
        </h2>
        <div class="row">
        <div class="col-md-4 wow fadeIn">
            <h3 class="title text-uppercase spacing">
            <i class="mdi mdi-rocket mr-2"></i>
            <strong>Superación constante</strong>
            </h3>
            <p class="grey-text font-small mx-4">
                Impulsar actividades de superación 
                especializada por y para los miembros.
            </p>
        </div>
        <div class="col-md-4 wow fadeIn">
            <h3 class="title text-uppercase spacing">
            <i class="mdi mdi-wechat mr-2"></i>
            <strong>Asociar profesionales</strong>
            </h3>
            <p class="grey-text font-small mx-4">
                En función de sus objetivos académicos, 
                científicos y culturales.
            </p>
        </div>
        <div class="col-md-4 wow fadeIn">
            <h3 class="title text-uppercase spacing">
            <i class="mdi mdi-desktop-mac mr-2"></i>
            <strong>Referente Tecnológico</strong>
            </h3>
            <p class="grey-text font-small mx-4">
                Espacio para la conexión y el intercambio
                de los miembros mediante las TIC
            </p>
        </div>
        <div class="col-md-4 wow fadeIn">
            <h3 class="title text-uppercase spacing">
            <i class="mdi mdi-cloud mr-2"></i>
            <strong>Promoción de repositorios</strong>
            </h3>
            <p class="grey-text font-small mx-4">
                Cear repositorios especializados para
                contribuir al ejercicio de la profesión.
            </p>
        </div>
        <div class="col-md-4 wow fadeIn">
            <h3 class="title text-uppercase spacing">
            <i class="mdi mdi-settings mr-2"></i>
            <strong>Colaboración</strong>
            </h3>
            <p class="grey-text font-small mx-4">
                Crear alianzas estratégicas con
                organizaciones homólogas de otros países.
            </p>
        </div>
        <div class="col-md-4 wow fadeIn">
            <h3 class="title text-uppercase spacing">
            <i class="mdi mdi-account-switch mr-2"></i>
            <strong>Análisis e intercambio</strong>
            </h3>
            <p class="grey-text font-small mx-4">
                Facilitar mecanismos para el debate
                sobre el empleo de las TIC en Cuba y el Mundo
            </p>
        </div>
        </div>
    </section>      
</div>
<section id="summary"> 
    <div class="container summary">
        <h2 class="text-center title wow fadeIn">
            <strong>Conózcanos más de cerca</strong>
        </h2>
        <div class="row">
        <div class="col-md-3 text-center wow fadeIn">
            <p>
            <strong class="cant">
                {{$users_count}}
            </strong>
            </p>
            <span class="cant-text">
            <strong>
                Miembros registrados
            </strong>
            </span>
        </div>
        <div class="col-md-3 text-center wow fadeIn">
            <p>
            <strong class="cant">
                {{$clubes_count}}
            </strong>
            </p>
            <span class="cant-text">
            <strong>
                Clubes
            </strong>
            </span>
        </div>
        <div class="col-md-3 text-center wow fadeIn">
            <p>
            <strong class="cant">
                {{$cursos_count}}
            </strong>
            </p>
            <span class="cant-text">
            <strong>
                Cursos disponibles
            </strong>
            </span>
        </div>
        <div class="col-md-3 text-center wow fadeIn">
            <p>
            <strong class="cant">
                +{{$ficheros_count}}
            </strong>
            </p>
            <span class="cant-text">
            <strong>
                Archivos en el repositorio
            </strong>
            </span>
        </div>
        </div>
    </div>
</section>
<section id="estatutos">
    <div class="container estatutos">
        <div class="row">
        <div class="col-md-6 text-center">
            <p class="grey-text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia tempore voluptatum fugit laboriosam sed reiciendis similique sapiente tenetur harum dolorum, facere magni animi cupiditate beatae accusamus! Nesciunt doloremque eos harum!
            </p>
            <a href="{{route('download_estatutos')}}" class="btn btn-sm btn-rounded btn-main">
            Descargar estatutos WORD
            </a>
        </div>
        <div class="col-md-6 text-center">
            <p class="grey-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia tempore voluptatum fugit laboriosam sed reiciendis similique sapiente tenetur harum dolorum, facere magni animi cupiditate beatae accusamus! Nesciunt doloremque eos harum!
            </p>
            <a href="{{route('download_codigo_etica')}}" class="btn btn-sm btn-rounded btn-main">
                Descargar código de ética PDF
            </a>
            </div>
        </div>
    </div>
</section>

@endsection