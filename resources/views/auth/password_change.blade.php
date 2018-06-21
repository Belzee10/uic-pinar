@php($page='password_change')
@extends('backend.main')
@section('title', 'Cambiar contraseña')

@section('content')
<h4 class="titulo">Cambiar contraseña</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{action('UserController@password_change_action')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="old_password" class="grey-text">Contraseña antigua</label>
                        <input type="password" id="old_password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}">                        
                        @if ($errors->has('old_password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('old_password') }}</strong>
                            </span>
                        @endif
                    </div>  
                    <div class="form-group">
                        <label for="new_password" class="grey-text">Nueva contraseña</label>
                        <input type="password" id="new_password" name="new_password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}">                        
                        @if ($errors->has('new_password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('new_password') }}</strong>
                            </span>
                        @endif
                    </div>   
                    <div class="form-group">
                        <label for="repeat_password" class="grey-text">Repetir contraseña</label>
                        <input type="password" id="repeat_password" name="repeat_password" class="form-control{{ $errors->has('repeat_password') ? ' is-invalid' : '' }}">                        
                        @if ($errors->has('repeat_password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('repeat_password') }}</strong>
                            </span>
                        @endif
                    </div>                 
                    <div class="form-group">
                        <input type="submit" value="Guardar" class="btn btn-secondary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        @include('flash::message')
    </div>
</div>

@endsection