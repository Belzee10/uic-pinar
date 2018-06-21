@php($page='message')
@extends('frontend.main')
@section('title', 'Solicitud enviada')

@section('content')

<div class="container">
    <section id="message">        
        <p class="grey-text text-center">
            Solicitud de membresía enviada con éxito. Revise su correo personal para veificar su cuenta! 
            <i class="mdi mdi-email"></i>
        </p>
    </section>
</div>

@endsection