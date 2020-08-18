@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
          <div class="header-body">
            <!-- Card stats -->
            <div class="row">
    <div class="col-md-12">
    <h1 class="text-center text-white">Enviar Remesa</h1>
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

          <div class="card-body">
            <form>
              <h5 class="heading-small text-muted mb-4">Datos para el envío de remesa</h5>
              <div class="pl-lg-4">

                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Orden <i class="fa fa-info-circle"data-toggle="tooltip" data-placement="top" title="orden pendiente"></i> </label>
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option>256988</option>

                          {{-- <option>4</option>
                          <option>5</option> --}}
                        </select>
                      </div>
                  </div>





                  <div class="col-md-12 text-center bg-primary mb-5 mt-3"><h2 class="text-white"> Datos del pago</h2> </div>

                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label" for="input-first-name">Número de recibo o transacción </label>
                              <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="" value="#">
                            </div>
                          </div>
                          <div class="col-lg-4">
                                <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Fecha de depósito o transferencia</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker" placeholder="Select date" type="text" value="06/20/2019">
                                        </div>
                                    </div>
                          </div>
                          <div class="col-lg-4">
                                <div class="form-group">
                                  <label class="form-control-label" for="input-first-name">Monto pagado </label>
                                  <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="First name" value="Monto depositado o transferido">
                                </div>
                              </div>
                          <div class="col-md-8 offset-md-2 text-center">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFileLang" lang="es">
                                <label class="custom-file-label" for="customFileLang">Adjunta captura de pago</label>
                            </div>
                       </div>
                          <div class="col-md-12 text-center bg-primary mb-5 mt-3"><h2 class="text-white"> Datos del beneficiario</h2> <p class="text-white">  <small>Completa los datos de la persona que recibe la remesa</small> </p> </div>

                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label" for="input-last-name">Nombres</label>
                              <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Last name" value="Nombres">
                            </div>
                          </div>
                          <div class="col-lg-4">
                                <div class="form-group">
                                  <label class="form-control-label" for="input-first-name">Apellidos </label>
                                  <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="First name" value="Apellidos">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="form-group">
                                  <label class="form-control-label" for="input-last-name">Número de identificación legal</label>
                                  <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Last name" value="Numero de identificación">
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label class="form-control-label" for="input-last-name">Banco</label>
                                  <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Last name" value="Banco">
                                </div>
                              </div>
                              <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label" for="input-first-name"># CTTA / IBAN
                                        SWIFT</label>
                                      <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="First name" value="# CTTA / IBAN">
                                    </div>
                                  </div>

                </div>

              </div>


              <div class="pl-lg-4">
              </div>
              <hr class="my-4" />
              <!-- Description -->
              <h6 class="heading-small  mb-4">Correo electrónico del beneficiario</h6>
              <div class="pl-lg-4">
                    <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="input-username">Email</label>
                                <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" value="lucky.jesse">
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="input-email">Repetir Email</label>
                                <input type="email" id="input-email" class="form-control form-control-alternative" placeholder="jesse@example.com">
                              </div>
                            </div>
                          </div>
              </div>
              <div class="col-lg-12 text-center">
              <button type="button mx-auto" class="btn btn-success">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">

                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Prioridades</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="heading mt-4">Tipos de prioridades</h4>
                        <p>Prioridad alta: Tu remesa llegará el mismo día</p>
                        <p>Prioridad Baja: Tu remesa llegará en tres días hábiles</p>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>
@endsection
