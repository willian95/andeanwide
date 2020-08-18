<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Andean Wide</title>

     <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <!-- Favicon -->
    <link href="/assets/images/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="/admin/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    
    <!-- CSS Files -->
    <link href="/admin/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

</head>

<body class="">
    <!-- Mobile Navbar  -->
    <?php
        $menu = Array(
            [
                'label'     => 'Soporte',
                'route'     => route('panel.user.support.index'),
                'iconClass' => 'ni ni-support-16',
            ],
            [
                'label'     => 'divider'
            ],
            [
                'label'     => 'Salir',
                'route'     => route('logout'),
                'iconClass' => 'ni ni-user-run',
                'method'    => 'POST'
            ]
        );

        $sidebarMenu = Array(
            [
                'label'     => 'Inicio',
                'route'     => route('panel.user.dashboard'),
                'iconClass' => 'ni ni-tv-2',
            ],
            [
                'label'     => 'Verificar Cuenta',
                'route'     => route('panel.user.verify') ,
                'iconClass' => 'fa fa-id-card',
            ],
            [
                'label'     => 'Crear Orden',
                'route'     => route('panel.user.order.create'),
                'iconClass' => 'fa fa-exchange',
            ],
            [
                'label'     => 'Mis Ordenes',
                'route'     => route('panel.user.order.index'),
                'iconClass' => 'fa fa-archive',
            ],
            [
                'label'     => 'Mis Pagos',
                'route'     => route('panel.user.payment.index'),
                'iconClass' => 'ni ni-archive-2',
            ],
            [
                'label'     => 'divider'
            ],
            [
                'label'     => 'Como Funciona',
                'route'     => route('panel.how_it_work'),
                'iconClass' => 'fa fa-question',
            ],
            [
                'label'     => 'Términos y Condiciones',
                'route'     => '/terminosycondiciones',
                'iconClass' => 'fa fa-gavel',
            ],
            [
                'label'     => 'Políticas de Privacidad',
                'route'     => '/privacidad',
                'iconClass' => 'fa fa-lock',
            ],
        );
    ?>

    <div class="main-content" id="app">
        <navbar-component
            :menu="{{ json_encode($menu) }}"
            :sidebar-menu="{{ json_encode($sidebarMenu) }}"
            :user="{{ Auth::user() }}"
            csrf="{{ csrf_token() }}"
            :admin-layout="false"
        >
            @yield('content')
        </navbar-component>
        
        <!-- Footer -->
        <div class="container">
            <footer class="footer">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-6">
                        <div class="copyright text-center text-xl-left text-muted">
                            &copy; 2020 <a href="/" class="font-weight-bold ml-1" target="_blank">Adrean Wide</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                            <li class="nav-item">
                                <a href="/nosotros" target="black" class="nav-link" target="_blank">Sobre
                                    nosotros</a>
                            </li>
                            <li class="nav-item">
                                <a href="/" class="nav-link" target="_blank">Blog</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!--   Core   -->
    <script src="/admin/js/plugins/jquery/dist/jquery.min.js"></script>
    <script src="/admin/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--   Optional JS   -->
    <script src="/admin/js/plugins/chart.js/dist/Chart.min.js"></script>
    <script src="/admin/js/plugins/chart.js/dist/Chart.extension.js"></script>
    <script src="/admin/js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!--   Argon JS   -->
    <script src="/admin/js/argon-dashboard.min.js?v=1.1.0"></script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <!-- <script>$(function () {
        $('select').selectpicker();
    });</script> -->
    <script src="/js/manifest.js" defer></script>
    <script src="/js/vendor.js" defer></script>
    <script src="/js/user_app.js" defer></script>


    <script>
        window.TrackJS &&
        TrackJS.install({
            token: "ee6fab19c5a04ac1a32a645abde4613a",
            application: "argon-dashboard-free"
        });
    </script>
     <!-- <script>
            CKEDITOR.replace( 'editor1' );
    </script> -->

    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "language": {
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sSearch":         "Buscar:",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     ">",
                            "sPrevious": "<"
                    },
                }
            });
        });
    </script>
</body>

<!-- Modal -->
<div class="modal fade" id="datosbancos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cuentas Bancarias Andean Wide</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container">

            <div class="row">

            <div class="col-md-12">

                <div class="row">
                    <div class="col">
                    <h2>Envíos desde Chile</h2>
                      <p>Banco de Chile <br>

                        Andean Wide Transfer SpA <br>
                        RUT: 77.091.311-K <br>
                        Cuenta Corriente 51445900 <br>

                        contacto@andeanwide.com</p>
                    </div>
                    <div class="col">
                        <h2>Envíos desde Colombia</h2>
                       <p>Andean Wide transfer sas <br>
                        NIT 901 334 588-0<br>
                        Banco de bogota <br>
                        Ahorro: 095935151<br>
                        contacto@andeanwide.com </p>
                    </div>
                  </div>
                  <hr>
                  <p class="text-info"><strong>Monto a depositar o transferir: 12599CLP</strong> </p>
                  <div class="alert alert-danger" role="alert">
                    <strong>Nota</strong> El monto a depositar debe ser exacto al ingresado en la orden creada
                </div>
    </div>
</div>
</div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

        </div>
      </div>
    </div>
  </div>

  @yield('scripts')

</html>
