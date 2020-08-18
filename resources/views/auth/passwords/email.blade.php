@extends('layouts.adminloginly')

@section('content')
<div class="container pb-5">
    <div class="row">
        <div class="col-md-12 justify-content ">
            <div class="col-md-12">
            <div class="text-center">
                <img class="mb-2 justify-content" src="/assets/images/logo.svg" alt="Andean Wide"
                    width="250px">
            </div>
            </div>
            <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center lead">{{ __('Recuperar contraseña') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"> <i class="fas fa-envelope"></i></label>

                            <div class="col-md-6">
                                <input id="email" placeholder="Escribe tu email" type="email" class="form-control input-group input-group-alternative @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-12 text-center">
                        <a href="/login" class=""><small> <i class="fa fa-key"> </i> Volver al inicio de sesión</small></a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection
