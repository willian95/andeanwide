@extends('layouts.adminloginly')

@section('content')


<div class="container mt-3 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary shadow border-0">
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                        <div class="text-center">
                            <img class="mb-2 justify-content" src="/admin/img/brand/blue.png" alt="Andean Wide"
                                width="150px">
                        </div>
                        <h3 class="text-primary">Inicia sesión</h3>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input id="email" placeholder="Email" type="email" oninvalid="
                                                console.log(validity);
                                                setCustomValidity('');
                                                if (validity.patternMismatch) {
                                                    setCustomValidity('Email no válido.');
                                                }
                                                else if (validity.typeMismatch) {
                                                    setCustomValidity('Email no válido.');
                                                }else if (validity.valueMissing) {
                                                    setCustomValidity('Este campo es requerido.');
                                                }
                                            " oninput="this.setCustomValidity('');"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input id="password" placeholder="Contraseña" type="password"
                                    oninvalid="this.setCustomValidity('Password requerído.')"
                                    oninput="this.setCustomValidity('');"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="custom-control custom-control-alternative custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" id="customCheckLogin"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customCheckLogin">
                                <span class="text-muted">Recuerdame</span>
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block my-4">{{ __('Login') }}</button>
                        </div>
                    </form>
                    <div class="row ">
                        <div class="col-6">
                            <a href="{{ route('password.request') }}" class=""><small>¿Olvidaste tu
                                    contraseña?</small></a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="/register" class=""><small class=" ">Crear nueva cuenta</small></a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
