@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">¿Cómo enviar una remesa?</h1>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">

    <div class="row ">
        <div class="col-xl-12 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h6 class="heading-small text-muted mb-4">Ayuda</h6>
                    <div class="pl-lg-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0"></h3>
                        </div>

                    </div>


                    <div class="col-md-12 text-center">

                            <div class="col-md-12">  <h3 class="text-center">Transfiere dinero con <br>  Andean Wide</h3></div>
                            <div class="col-md-12 text-center mt-2 mb-2"><img src="/assets/images/linea.svg" alt="" width="80px"></div>
                            <div class="col-lg-6 offset-lg-3 col-sm-12  text-lg-left">


                                <h3 class="text-muted">1. Crea remesa </h3>
                                <img src="/admin/img/botoncrear.jpg" alt="" width="200px">
                                <p><small> <i class="fa fa-long-arrow-alt-right"></i> Haz clic en el botón crear remesa en el menú. <br> <i class="fa fa-long-arrow-alt-right"></i> Selecciona el país del beneficiario,
                                    indica cuánto dinero deseas enviar, la prioridad de tu envío.<br>
                                Verás nuestras bajas comisiones y el tipo de cambio por adelantado.</p></small>
                                <h3 class="text-muted">2. Paga por tu remesa</h3>
                                <img src="/admin/img/botoncuentas.jpg" alt="" width="200px">

                                <p> <small> <i class="fa fa-long-arrow-alt-right"></i>  Haciendo clic en el botón  Cuentas bancarias del menú, veras los datos de nuestras cuentas donde debes realizar tus pagos.<br>
                               </small></p>
                                    <h3 class="text-muted">3. Añade la información de tu pago y destinatario</h3>
                                    <img src="/admin/img/botonenviar.jpg" alt="" width="200px">
                                    <p> <small> <i class="fa fa-long-arrow-alt-right"></i> Una vez realizado el pago accede al link enviar remesa, completa los datos del formulario, revisa tu solicitud y ejecuta tu orden.</small></p>


                            </div>

                        </div>




                  </div>
            </div>
        </div>

    </div>
    </div>

    @endsection
