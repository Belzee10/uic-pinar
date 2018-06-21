@php($page='login')
@extends('frontend.main')

@section('css')
    <link href="{{asset('backend/css/access.css')}}" rel="stylesheet">
@endsection

@section('content')
    <section id="login">
        <div class="container">
            <div class="card wow fadeIn">
                <div class="card-body">
                    <form method="POST" action="{{action('UserController@signin_store')}}">
                        @csrf
                        <h3 class="title">
                            Formulario de acceso
                        </h3>
                        <div class="form-group">
                            <input id="email" type="email" class="form-control form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control form-control-lg{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="remerber-me" name="remember" class="custom-control-input" {{ old('remember') ? 'checked' : '' }}> 

                            <label class="custom-control-label" for="remerber-me">Recuérdame</label>
                        </div>                            
                        <button class="btn btn-main btn-block btn-login" type="submit">Acceder</button>
                    </form>  
                    <div class="mt-3">
                        @include('flash::message')

                    </div>                      
                </div>
            </div>
        </div>
    </section>
@endsection
