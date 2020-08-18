@extends('layouts.adminly')
    @section('content')

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
          <div class="header-body">
            <!-- Card stats -->
            @role('admin')
            <div class="row">
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Agentes</h5>
                        <span class="h2 font-weight-bold mb-0">25</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2">Total</span>
                      <span class="text-nowrap">Agentes registrados</span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Usuarios </h5>
                        <span class="h2 font-weight-bold mb-0">15000</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                            <i class="fas fa-users"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2">Total </span>
                        <span class="text-nowrap">Usuarios registrados</span>
                      </p>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Ordenes</h5>
                        <span class="h2 font-weight-bold mb-0">2,356</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                          <i class="fas fa-archive"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2">Total</span>
                        <span class="text-nowrap">Ordenes aprobadas</span>
                      </p>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Nuevas ordenes</h5>
                        <span class="h2 font-weight-bold mb-0">924</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2">Total </span>
                        <span class="text-nowrap">Nuevas ordenes</span>
                      </p>
                  </div>
                </div>
              </div>

            </div>
            @endrole
            @hasanyrole('agent|user')

            <div class="row">
            <div class="col-12 mb-5 text-center">

                <a href="{{ route('panel.sendremesa') }}" class="btn btn-lg  btn-warning mb-2"> Enviar remesa <i
                    class="fas fa-paper-plane"></i></a>

                 </div>
            </div>

            <div class="row">
              <div class="col-xl-4 col-lg-4">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Cuenta</h5>
                        <span class="h2 font-weight-bold mb-0">No Verificada</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                          <i class="fas fa-check"></i>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Tus Envíos</h5>
                        <span class="h2 font-weight-bold mb-0">0</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Envíos pendientes</h5>
                        <span class="h2 font-weight-bold mb-0">1</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                          <i class="fas fa-pause"></i>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>


            </div>
            @endhasanyrole
          </div>
        </div>
      </div>

      <div class="container-fluid mt--7">
        @role('admin')
        <div class="row">
          <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card bg-gradient-default shadow">
              <div class="card-header bg-transparent">
                <div class="row align-items-center">
                  <div class="col">
                    <h6 class="text-uppercase text-light ls-1 mb-1"></h6>
                    <h2 class="text-white mb-0">Remesas enviadas</h2>
                  </div>
                  <div class="col">
                    <ul class="nav nav-pills justify-content-end">
                      <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                        <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                          <span class="d-none d-md-block">Mes</span>
                          <span class="d-md-none">M</span>
                        </a>
                      </li>
                      <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                        <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                          <span class="d-none d-md-block">Semana</span>
                          <span class="d-md-none">S</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <!-- Chart -->
                <div class="chart">
                  <!-- Chart wrapper -->
                  <canvas id="chart-sales" class="chart-canvas"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="card shadow">
              <div class="card-header bg-transparent">
                <div class="row align-items-center">
                  <div class="col">
                    <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                    <h2 class="mb-0">Depósitos por mes</h2>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <!-- Chart -->
                <div class="chart">
                  <canvas id="chart-orders" class="chart-canvas"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endrole
        @role('admin')
        <div class="row mt-5">
          <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
              <div class="card-header border-0">
                <div class="row align-items-center">
                  <div class="col">
                    <h3 class="mb-0">Ordenes Nuevas</h3>
                  </div>
                  <div class="col text-right">
                    <a href="/panel/ordenesnuevas" class="btn btn-sm btn-primary">ver todos</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Número</th>
                      <th scope="col">Usuario</th>
                      <th scope="col">total enviado</th>
                      <th scope="col">Fecha</th>
                      <th scope="col">País destino</th>

                      <th scope="col">Estatus</th>
                      <th scope="col">Ver</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">
                        25658
                      </th>
                      <td>
                        Nombre User
                      </td>
                      <td>
                        34000 CLP
                      </td>
                      <td>
                        <i class="fas fa-calendar text-success mr-3"></i> 25/10/2019
                      </td>
                      <td>
                        <i class="fas fa-map-pin text-success mr-3"></i> Colombia
                      </td>
                      <td>
                        <span class="badge badge-success">Completada</span>
                      </td>
                      <td>
                        <button type="button" class="btn btn-info">Ver</button>
                      </td>
                    </tr>


                  </tbody>
                </table>

              </div>
            </div>
          </div>

        </div>
        @endrole
        @hasanyrole('agent|user')
        <div class="row mt-5">
          <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
              <div class="card-header border-0">
                <div class="row align-items-center">
                  <div class="col">
                    <h3 class="mb-0">Remesas Creadas</h3>
                  </div>
                  <div class="col text-right">
                    <a href="/panel/crearemesa" class="btn btn-sm btn-primary">crear nueva</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Número</th>

                      <th scope="col">total enviado</th>
                      <th scope="col">Fecha</th>
                      <th scope="col">País destino</th>

                      <th scope="col">Estatus</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">
                        25658
                      </th>

                      <td>
                        34000 CLP
                      </td>
                      <td>
                        <i class="fas fa-calendar text-success mr-3"></i> 25/10/2019
                      </td>
                      <td>
                        <i class="fas fa-map-pin text-success mr-3"></i> Colombia
                      </td>
                      <td>
                        <span class="badge badge-danger">Pendiente</span>
                      </td>
                      <td>
                        <button type="button" class="btn btn-primary btn-sm">Enviar Remesa</button>
                        <button type="button" class="btn btn-danger btn-sm">Eliminar</button>
                      </td>
                    </tr>


                  </tbody>
                </table>

              </div>
            </div>
          </div>

        </div>
        @endhasanyrole


<!-- Modal -->



  @endsection
