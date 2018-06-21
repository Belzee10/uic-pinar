@php($page='welcome')
@extends('backend.main')
@section('title', 'Bienvenido')

@section('content')
    @if (Auth::user())
        Bienvenido al panel de administración: 
        <em class="lead" style="font-size: 1rem; font-weight: 400">
            {{Auth::user()->nombre_completo}} 
        </em>        
        {{--  <span style="font-size: 12px"
        @if (Auth::user()->rol == 'admin')
            class="badge badge-dark"
        @elseif (Auth::user()->rol == 'directivo')
            class="badge badge-secondary"
        @elseif (Auth::user()->rol == 'miembro')
            class="badge badge-light"
        @endif>
            {{Auth::user()->rol}}
        </span>  --}}
    @endif
@endsection



