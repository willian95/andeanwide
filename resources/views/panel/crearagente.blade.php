@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Crear Agente</h1>
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
                            <h3 class="mb-0"></h3>Crear cuenta de agente</h3>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">Datos representante legal</h6>
                        <div class="pl-lg-4">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="r_legal_name">Nombre legal
                                            completo</label>
                                        <input type="text" id="r_legal_name" name="r_legal_name"
                                            class="form-control form-control-alternative" placeholder="Nombre legal"
                                            value="{{ old('r_legal_name') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="r_legal_lastname">Apellido legal
                                            completo</label>
                                        <input type="text" id="r_legal_lastname" name="r_legal_lastname"
                                            class="form-control form-control-alternative" placeholder="Apellido legal"
                                            value="{{ old('r_legal_lastname') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="r_nationality">Nacionalidad</label>
                                        <input type="text" id="r_nationality" name="r_nationality"
                                            class="form-control form-control-alternative" placeholder="Nacionalidad"
                                            value="{{ old('r_nationality') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="r_birthday">Fecha de
                                            nacimiento</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker" placeholder="Select date" type="text"
                                                id="r_birthday" name="r_birthday"
                                                value="{{ old('r_birthday', '06/20/2019') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="r_pais_residencia">País de residencia
                                        </label>
                                        <input type="text" id="r_pais_residencia" name="r_pais_residencia"
                                            class="form-control form-control-alternative" placeholder="País de residencia"
                                            value="{{ old('r_pais_residencia') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="r_rut">RUT</label>
                                        <input type="text" id="r_rut" name="r_rut"
                                            class="form-control form-control-alternative" placeholder="RUT"
                                            value="{{ old('r_rut') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="r_serie">Número de serie
                                        </label>
                                        <input type="text" id="r_serie" name="r_serie"
                                            class="form-control form-control-alternative" placeholder="Número de serie"
                                            value="{{ old('r_serie') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="r_telefono">Teléfono</label>
                                        <input type="text" id="r_telefono" name="r_telefono"
                                            class="form-control form-control-alternative" placeholder="Teléfono"
                                            value="{{ old('r_telefono') }}">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr class="my-4" />
                        <!-- Address -->
                        <h6 class="heading-small text-muted mb-4">Datos de la empresa</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="e_name">Nombre de empresa</label>
                                        <input type="text" id="e_name" name="e_name"
                                            class="form-control form-control-alternative" placeholder="Nombre de empresa"
                                            value="{{ old('e_name') }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="e_fantasy">Nombre de fantasía</label>
                                        <input type="text" id="e_fantasy" name="e_fantasy"
                                            class="form-control form-control-alternative" placeholder="Nombre de fantasía"
                                            value="{{ old('e_fantasy') }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="e_rut">RUT</label>
                                        <input type="number" id="e_rut" name="e_rut"
                                            class="form-control form-control-alternative" placeholder="RUT"
                                            value="{{ old('e_rut') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="e_address">Dirección</label>
                                        <input id="e_address" name="e_address"
                                            class="form-control form-control-alternative" placeholder="Dirección"
                                            value="{{ old('e_address') }}" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="e_city">Ciudad</label>
                                        <input type="text" id="e_city" name="e_city"
                                            class="form-control form-control-alternative" placeholder="Ciudad"
                                            value="{{ old('e_city') }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="e_country">País</label>
                                        <input type="text" id="e_country" name="e_country"
                                            class="form-control form-control-alternative" placeholder="País"
                                            value="{{ old('e_country') }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="e_zip">Código postal</label>
                                        <input type="number" id="e_zip" name="e_zip"
                                            class="form-control form-control-alternative" placeholder="Código postal"
                                            value="{{ old('e_zip') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <!-- Description -->
                        <h6 class="heading-small text-muted mb-4">Datos de acceso</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Email</label>
                                        <input type="email" id="email" name="email"
                                            class="form-control form-control-alternative"
                                            placeholder="correo@ejemplo.com" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="password">Contraseña</label>
                                        <input type="text" id="password" name="password"
                                            class="form-control form-control-alternative" placeholder="**************">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <button type="button mx-auto" class="btn btn-success">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
