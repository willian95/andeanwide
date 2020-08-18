@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Editar usuario</h1>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--7">
    <div class="row">

        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0"></h3>Editar usuario</h3>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Datos </h6>
                    @if(is_null($user->identity) || is_null($user->address))
                        <div class="pl-lg-4">
                            <div class="alert alert-warning" role="alert">
                                Información de verificación incompleta.
                            </div>
                        </div>
                    @elseif(is_null($user->account_verified_at))
                        <div class="pl-lg-4">
                            <div class="alert alert-danger" role="alert">
                                Cuenta pendiente por verificación.
                            </div>
                        </div>
                    @else
                        <div class="pl-lg-4">
                            <div class="alert alert-success" role="alert">
                                Cuenta verificada.
                            </div>
                        </div>
                    @endif
                    <div class="pl-lg-4">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Nombre</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control form-control-alternative"
                                        value="{{ $user->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="lastname">Apellido</label>
                                    <input type="text" id="lastname" name="lastname"
                                        class="form-control form-control-alternative" 
                                        value="{{ $user->lastname }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="country">País de residencia
                                    </label>
                                    <input type="text" id="country" name="country"
                                        class="form-control form-control-alternative" 
                                        value="{{ $user->country }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="identification">Número de identificación</label>
                                    <input type="text" id="identification" name="identification"
                                        class="form-control form-control-alternative"
                                        value="{{ $user->identification }}"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="email">Email</label>
                                    <input type="text" id="email"
                                        class="form-control form-control-alternative" 
                                        value="{{ $user->email }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="phone">Teléfono</label>
                                    <input type="text" id="phone"
                                        class="form-control form-control-alternative" 
                                        value="{{ $user->phone }}"
                                        disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4" />
                    <hr class="my-4" />
                    <!-- Description -->
                    <h6 class="heading-small text-muted mb-4">Datos Identificación</h6>
                    <div class="pl-lg-4">
                    @if(is_null($user->identity))
                        <p>Información de identidad no ha sido cargada.</p>
                    @else
                        @if(isset($user->identity->verified_at))
                            <p class="text-success font-weight-bold"><i class="fa fa-check" aria-hidden="true"></i> Información de identidad ha sido confirmada.</p>
                        @endif
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="county_id">País emisor del documento</label>
                                    <input type="text" class="form-control" id="country" aria-describedby="País emisor del documento" name="country" value="{{ $user->identity->country->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="nationality">Nacionalidad</label>
                                    <input type="text" class="form-control" id="nationality" aria-describedby="nationality" name="nationality" placeholder="Nacionalidad" value="{{ $user->identity->nationality }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="document_type">Tipo de documento</label>
                                    @if($user->identity->document_type == 'dni')
                                    <input type="text" class="form-control" id="document_type" aria-describedby="Tipo de documento" name="document_type" value="Documento de identidad" disabled>
                                    @elseif($user->identity->document_type == 'passport')
                                    <input type="text" class="form-control" id="document_type" aria-describedby="Tipo de documento" name="document_type" value="Pasaporte" disabled>
                                    @else
                                    <input type="text" class="form-control" id="document_type" aria-describedby="Tipo de documento" name="document_type" value="Licencia de conducir" disabled>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="gender">Género</label>
                                    <input type="text" class="form-control" id="gender" aria-describedby="Género" name="gender" value="{{ $user->identity->gender }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="dni_number">Número de documento</label>
                                    <input type="text" class="form-control" id="dni_number" aria-describedby="document number" name="dni_number" value="{{ $user->identity->dni_number }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="validation_number">Número de validación</label>
                                    <input type="text" class="form-control" id="validation_number" aria-describedby="validation number" name="validation_number" value="{{ $user->identity->validation_number }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="issue_date">Fecha de emisión</label>
                                    <input type="text" class="form-control" id="issue_date" aria-describedby="issue date" name="issue_date" value="{{ $user->identity->issue_date }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="expiration_date">Fecha de vencimiento</label>
                                    <input type="text" class="form-control" id="expiration_date" aria-describedby="expiration date" name="expiration_date" value="{{ $user->identity->expiration_date }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="first_name">Primer Nombre</label>
                                    <input type="text" class="form-control" id="first_name" aria-describedby="first name" name="first_name" value="{{ $user->identity->first_name }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="middle_name">Segundo Nombre</label>
                                    <input type="text" class="form-control" id="middle_name" aria-describedby="middle name" name="middle_name" value="{{ $user->identity->middle_name }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="last_name">Primer Apellido</label>
                                    <input type="text" class="form-control" id="last_name" aria-describedby="last name" name="last_name" value="{{ $user->identity->last_name }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="second_surname">Segundo Apellido</label>
                                    <input type="text" class="form-control" id="second_surname" aria-describedby="second surname name" name="second_surname" value="{{ $user->identity->second_surname }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                @if(!is_null($user->identity->front_image_url))
                                    @component('components.image')
                                        @slot('name')
                                            identityFront
                                        @endslot
                                        @slot('title')
                                            Documento de Identidad - Frente
                                        @endslot
                                        @slot('url')
                                            {{ $user->identity->front_image_url }}
                                        @endslot
                                    @endcomponent
                                @endif
                            </div>
                            <div class="col-12 col-md-6">
                                @if(!is_null($user->identity->reverse_image_url))
                                    @component('components.image')
                                        @slot('name')
                                            identityBack
                                        @endslot
                                        @slot('title')
                                            Documento de Identidad - Reverso
                                        @endslot
                                        @slot('url')
                                            {{ $user->identity->reverse_image_url }}
                                        @endslot
                                    @endcomponent
                                @endif
                            </div>
                        </div>

                        @if(is_null($user->identity->verified_at))
                        <div class="row mt-5">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="identityActionCheckbox">
                                <label class="form-check-label" for="identityActionCheckbox">Confirmación de revisión de datos de identidad.</label>
                            </div>
                            <script>
                                (function(){
                                    var checkBox = document.querySelector("#identityActionCheckbox");
                                    checkBox.addEventListener('change', function(e){
                                        var div = document.querySelector("#identityActionBox");
                                        if(checkBox.checked){
                                            div.classList.remove('d-none')
                                            div.classList.add('d-flex')
                                        } else {
                                            div.classList.add('d-none')
                                            div.classList.remove('d-flex')
                                        }
                                    });
                                })()
                            </script>
                        </div>

                        <div class="row mb-4 d-none justify-content-center" id="identityActionBox">
                            <div class="col-4">
                                <form action="{{ route('panel.validate_identity') }}" method="post">
                                    @csrf
                                    <input type="text" class="d-none" name="user_id" value="{{ $user->id }}">
                                    <button class="btn btn-success btn-block" type="submit">
                                        Aceptar
                                    </button>
                                </form>
                            </div>
                            <div class="col-4">
                                <form action="{{ route('panel.unvalidate_identity') }}" method="post">
                                    @csrf
                                    <input type="text" class="d-none" name="user_id" value="{{ $user->id }}">
                                    <button class="btn btn-danger btn-block" type="submit">
                                        Rechazar
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endif
                    @endif
                    </div>

                    <hr class="my-4" />
                    <!-- Description -->
                    <h6 class="heading-small text-muted mb-4">Datos Residencia</h6>
                    <div class="pl-lg-4">
                    @if(is_null($user->address))
                        <p>Información de residencia no ha sido cargada.</p>
                    @else
                        @if(isset($user->address->verified_at))
                            <p class="text-success font-weight-bold"><i class="fa fa-check" aria-hidden="true"></i> Información de residencia ha sido confirmada.</p>
                        @endif
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="county_id">País</label>
                                    <input type="text" class="form-control" id="country" aria-describedby="country" name="country" value="{{ $user->address->state }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="state">Estado/Región/Provincia</label>
                                    <input type="text" class="form-control" id="state" aria-describedby="state" name="state" value="{{ $user->address->state }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="city">Ciudad</label>
                                    <input type="text" class="form-control" id="city" aria-describedby="city" name="city" value="{{ $user->address->city }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="cod">Código postal</label>
                                    <input type="text" class="form-control" id="cod" aria-describedby="cod" name="cod" value="{{ $user->address->cod }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address">Dirección</label>
                                    <input type="text" class="form-control" id="address" aria-describedby="Address" name="address" value="{{ $user->address->address }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address_ext">Dirección (continuación)</label>
                                    <input type="text" class="form-control" id="address_ext" aria-describedby="Address continued" name="address_ext" value="{{ $user->address->address_ext }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                @if(!is_null($user->address->image_url))
                                    @component('components.image')
                                        @slot('name')
                                            addressFront
                                        @endslot
                                        @slot('title')
                                            Documento de Residencia
                                        @endslot
                                        @slot('url')
                                            {{ $user->address->image_url }}
                                        @endslot
                                    @endcomponent
                                @endif
                            </div>
                        </div>

                        @if(is_null($user->address->verified_at))
                            <div class="row mt-5">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="addressActionCheckbox">
                                    <label class="form-check-label" for="addressActionCheckbox">Confirmación de revisión de datos de residencia.</label>
                                </div>
                                <script>
                                    (function(){
                                        var checkBox = document.querySelector("#addressActionCheckbox");
                                        checkBox.addEventListener('change', function(e){
                                            var div = document.querySelector("#addressActionBox");
                                            if(checkBox.checked){
                                                div.classList.remove('d-none')
                                                div.classList.add('d-flex')
                                            } else {
                                                div.classList.add('d-none')
                                                div.classList.remove('d-flex')
                                            }
                                        });
                                    })()
                                </script>
                            </div>

                            <div class="row mb-4 d-none justify-content-center" id="addressActionBox">
                                <div class="col-4">
                                    <form action="{{ route('panel.validate_address') }}" method="post">
                                        @csrf
                                        <input type="text" class="d-none" name="user_id" value="{{ $user->id }}">
                                        <button class="btn btn-success btn-block" type="submit">
                                            Aceptar
                                        </button>
                                    </form>
                                </div>
                                <div class="col-4">
                                    <form action="{{ route('panel.unvalidate_address') }}" method="post">
                                        @csrf
                                        <input type="text" class="d-none" name="user_id" value="{{ $user->id }}">
                                        <button class="btn btn-danger btn-block" type="submit">
                                            Rechazar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endif
                    </div>
                    <hr class="my-4" />
                </div>
            </div>
        </div>
    </div>
    @endsection
