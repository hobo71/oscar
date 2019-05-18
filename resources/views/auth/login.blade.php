@extends('layouts.app')

@section('content')
    <div class="bg-warning justify-content-center    d-flex align-items-center" style="position:absolute; top:0; bottom:0; left:0; right:0;">
        
        <form class="form-horizontal col-xl-3 col-lg-4 col-md-6 col-sm-8 col-xs-12" role="form" method="POST" action="{{ url('/login') }}" >
            {!! Form::token() !!}
        <div class="card border-0" style="overflow: hidden;">
            <div class="card-body pb-0">
            
            <h1 class="py-4 px-3 justify-content-between    d-flex align-items-center">
                <span>
                    <strong>camino</strong><small class="text-warning">.APP</small>
                </span>
                <i class="fa fa-car"></i> 
            </h1>
           
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail</label>

                        <div class="col">
                            <input style="text-align: center;" id="email" type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Clave</label>

                        <div class="col">
                            <input style="text-align: center;" id="password" type="password" class="form-control form-control-lg" name="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col ">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Recordarme
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            <button type="submit" class="btn btn-lg py-4 rounded-0 btn-outline-dark btn-block border-0">
                <i class="fa fa-btn fa-sign-in"></i> Ingresar
            </button>

            <a hidden class="btn btn-link" href="{{ url('/password/reset') }}">Olvidaste tu clave?</a>
            </div>
            <p class="text-muted mt-3 text-right">Version 2.0</p>
        </form>
    </div>
@endsection
