@php($page='repositorio')
@extends('frontend.main')
@section('title', 'Repositorio')

@section('content')

<div class="container">
    <section id="repositorio">
        <h2 class="title wow fadeIn mb-0">
            Repositorio
        </h2>
        <hr class="mt-1 mb-4">

        @if ($documentos)  
            <div>                    
                <h3 class="title text-uppercase spacing mt-5">
                    Documentos
                </h3>
            </div>     
            <div class="row no-gutters">     
                @foreach ($documentos as $d)                
                    <div class="col-md-2 text-center">
                        <a href="{{route('repositorioDownload', $d->id)}}" class="download">
                            @if($d->extension == 'pdf')                                
                                <img src="{{asset('frontend/img/icons/pdf.png')}}" class="mx-auto d-block" alt="{{$d->nombre}}" height="80"> 
                            @elseif($d->extension == 'docx')
                                <img src="{{asset('frontend/img/icons/word.png')}}" class="mx-auto d-block" alt="{{$d->nombre}}" height="80"> 
                            @elseif($d->extension == 'pptx')
                                <img src="{{asset('frontend/img/icons/powerpoint.png')}}" class="mx-auto d-block" alt="{{$d->nombre}}" height="80"> 
                            @elseif($d->extension == 'xlsx')
                                <img src="{{asset('frontend/img/icons/excel.png')}}" class="mx-auto d-block" alt="{{$d->nombre}}" height="80"> 
                            @endif
                            <span>{{$d->nombre}}</span>
                        </a>               
                    </div>
                @endforeach   
            </div>          
        @endif

        @if($imagenes)
            <div>                    
                <h3 class="title text-uppercase spacing mt-5">
                    Imágenes
                </h3>
            </div>
            <div class="row no-gutters">
                @foreach ($imagenes as $i)                    
                    <div class="col-md-2 text-center">
                        <a href="{{route('repositorioDownload', $i->id)}}" class="download">
                            <img src="{{asset('frontend/img/icons/imagen.png')}}" class="mx-auto d-block" alt="{{$i->nombre}}" height="80">  
                            <span>{{$i->nombre}}</span>
                        </a>               
                    </div>
                @endforeach 
            </div> 
        @endif

        @if($videos)
            <div>                    
                <h3 class="title text-uppercase spacing mt-5">
                    Videos
                </h3>
            </div>
            <div class="row no-gutters">
                @foreach ($videos as $v)                    
                    <div class="col-md-2 text-center">
                        <a href="{{route('repositorioDownload', $v->id)}}" class="download">
                            <img src="{{asset('frontend/img/icons/video.png')}}" class="mx-auto d-block" alt="{{$v->nombre}}" height="80">  
                            <span>{{$v->nombre}}</span>
                        </a>               
                    </div>
                @endforeach 
            </div> 
        @endif

        @if($audios)
            <div>                    
                <h3 class="title text-uppercase spacing mt-5">
                    Audios
                </h3>
            </div>
            <div class="row no-gutters">
                @foreach ($audios as $a)                
                    <div class="col-md-2 text-center">
                        <a href="{{route('repositorioDownload', $a->id)}}" class="download">
                            <img src="{{asset('frontend/img/icons/audio.png')}}" class="mx-auto d-block" alt="{{$a->nombre}}" height="80">  
                            <span>{{$a->nombre}}</span>
                        </a>               
                    </div>
                @endforeach 
            </div> 
        @endif

        @if($comprimidos)
            <div>                    
                <h3 class="title text-uppercase spacing mt-5">
                    Comprimidos
                </h3>
            </div>
            <div class="row no-gutters">
                @foreach ($comprimidos as $c)                
                        <div class="col-md-2 text-center">
                            <a href="{{route('repositorioDownload', $c->id)}}" class="download">
                                <img src="{{asset('frontend/img/icons/comprimido.png')}}" class="mx-auto d-block" alt="{{$c->nombre}}" height="80">  
                                <span>{{$c->nombre}}</span>
                            </a>               
                        </div>
                @endforeach 
            </div>
        @endif        

    </section>
</div>

@endsection