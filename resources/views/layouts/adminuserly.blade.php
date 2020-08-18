<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Andean Wize </title>
    <!-- Favicon -->
    <link href="/admin/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="/admin/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="/admin/js/plugins/@@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="/admin/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
</head>

<body class="">
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->

            <a class="navbar-brand pt-0" href="/perfil">
                <img src="/admin/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>
            <!-- User -->
            <ul class="nav align-items-center d-md-none">


                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="/admin/img/theme/team-1-800x800.jpg">
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Bienvenido</h6>
                        </div>
                        {{-- <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>Mi actividad</span>
            </a>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Ajustes</span>
            </a>

            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Soporte</span>
            </a> --}}
                        <div class="dropdown-divider"></div>
                        <a href="#!" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Salir</span>
                        </a>
                    </div>
                </li>
            </ul>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Collapse header -->
                <div class="navbar-collapse-header d-md-none">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="./index.html">
                                <img src="/admin/img/brand/blue.png">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <ul class="navbar-nav">
                    <h3 class="text-center bg-mute text-white pb-3 pt-3 border-bottom"><a href="/balances">Balance: CLP:
                            1500</a> </h3>
                    <li class="nav-item  class=" active" ">
          <a class=" nav-link active " href=" {{ route('panel.usuario.perfil') }}"> <i
                            class="ni ni-tv-2 text-primary"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('panel.usuario.ingresar') }}">
                            <i class="ni ni-money-coins text-green"></i> Ingresar dinero a cuenta
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('panel.usuario.historialremesas') }}">
                            <i class="ni ni-archive-2 text-orange"></i> Historial de remesas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('panel.usuario.historialdepositos') }}">
                            <i class="ni ni-single-02 text-yellow"></i> Historial de depósitos
                        </a>
                    </li>

                    {{-- <li class="nav-item">
                <a class="nav-link " href="{{ route('panel.usuario.faq') }}">
                    <i class="fas fa-file-invoice-dollar text-gray-dark"></i> Facturas
                    </a>
                    </li> --}}
                    {{-- <li class="nav-item">
            <a class="nav-link" href="./examples/login.html">
              <i class="ni ni-key-25 text-info"></i> Login
            </a>
          </li> --}}
                    {{-- <li class="nav-item">
            <a class="nav-link" href="./examples/register.html">
              <i class="ni ni-circle-08 text-pink"></i> Register
            </a>
          </li> --}}
                </ul>
                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <h6 class="navbar-heading text-muted"></h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-gavel"></i> Terminos y condiciones
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-lock"></i> Política de privacidad
                        </a>
                    </li>
                    {{-- <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html">
              <i class="ni ni-ui-04"></i> Components
            </a>
          </li> --}}
                </ul>
            </div>
        </div>
    </nav>
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a href="{{ route('panel.usuario.enviardinero') }}" class="btn btn-lg  btn-warning"> Enviar Remesa <i
                        class="fas fa-paper-plane"></i></a>

                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="/admin/img/theme/team-4-800x800.jpg">
                                </span>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">Nombre agente</span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Bienvenido</h6>
                            </div>
                            {{-- <a href="./examples/profile.html" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>Mi actividad</span>
              </a>
              <a href="./examples/profile.html" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Ajustes</span>
              </a>

              <a href="./examples/profile.html" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Soporte</span>
              </a> --}}
                            <div class="dropdown-divider"></div>
                            <a href="#!" class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>Salir</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
        <!-- Header -->
        @yield('content')
        <footer class="footer">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6">
                    <div class="copyright text-center text-xl-left text-muted">
                        &copy; 2018 <a href="/" class="font-weight-bold ml-1" target="_blank">Adrean Wize</a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <ul class="nav nav-footer justify-content-center justify-content-xl-end">

                        <li class="nav-item">
                            <a href="#" class="nav-link" target="_blank">Sobre nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" target="_blank">Blog</a>
                        </li>

                    </ul>
                </div>
            </div>
        </footer>

    </div>
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
    <script>
        window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
    </script>
</body>

</html>
