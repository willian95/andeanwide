@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Editar Agente</h1>
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
                            <h3 class="mb-0"></h3>Editar agente</h3>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <h6 class="heading-small text-muted mb-4">Datos representante legal</h6>
                        <div class="pl-lg-4">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Nombre legal
                                            completo</label>
                                        <input type="text" id="input-first-name"
                                            class="form-control form-control-alternative" placeholder="First name"
                                            value="Lucky">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-last-name">Apellido legal
                                            completo</label>
                                        <input type="text" id="input-last-name"
                                            class="form-control form-control-alternative" placeholder="Last name"
                                            value="Jesse">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Nacionalidad</label>
                                        <input type="text" id="input-first-name"
                                            class="form-control form-control-alternative" placeholder="First name"
                                            value="Lucky">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Fecha de
                                            nacimiento</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker" placeholder="Select date" type="text"
                                                value="06/20/2019">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">País de recidencia
                                        </label>
                                        <input type="text" id="input-first-name"
                                            class="form-control form-control-alternative" placeholder="First name"
                                            value="Lucky">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-last-name">RUT</label>
                                        <input type="text" id="input-last-name"
                                            class="form-control form-control-alternative" placeholder="Last name"
                                            value="Jesse">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Numero de serie
                                        </label>
                                        <input type="text" id="input-first-name"
                                            class="form-control form-control-alternative" placeholder="First name"
                                            value="Lucky">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-last-name">Teléfono</label>
                                        <input type="text" id="input-last-name"
                                            class="form-control form-control-alternative" placeholder="Last name"
                                            value="Jesse">
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
                                        <label class="form-control-label" for="input-city">Nombre de empresa</label>
                                        <input type="text" id="input-city" class="form-control form-control-alternative"
                                            placeholder="City" value="New York">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">Nombre de fantasía</label>
                                        <input type="text" id="input-country"
                                            class="form-control form-control-alternative" placeholder="Country"
                                            value="United States">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">RUT</label>
                                        <input type="number" id="input-postal-code"
                                            class="form-control form-control-alternative" placeholder="Postal code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-address">Dirección</label>
                                        <input id="input-address" class="form-control form-control-alternative"
                                            placeholder="Home Address"
                                            value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-city">Ciudad</label>
                                        <input type="text" id="input-city" class="form-control form-control-alternative"
                                            placeholder="City" value="New York">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">País</label>
                                        <input type="text" id="input-country"
                                            class="form-control form-control-alternative" placeholder="Country"
                                            value="United States">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">Código postal</label>
                                        <input type="number" id="input-postal-code"
                                            class="form-control form-control-alternative" placeholder="Postal code">
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
                                        <label class="form-control-label" for="input-username">Email</label>
                                        <input type="text" id="input-username"
                                            class="form-control form-control-alternative" placeholder="Username"
                                            value="lucky.jesse">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Contraseña</label>
                                        <input type="email" id="input-email"
                                            class="form-control form-control-alternative"
                                            placeholder="jesse@example.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <button type="button mx-auto" class="btn btn-success">Actualizar</button>
                            <button type="button mx-auto" class="btn btn-danger">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
