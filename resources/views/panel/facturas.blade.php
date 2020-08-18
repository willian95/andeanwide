@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
      <div class="header-body">
        <!-- Card stats -->
        <div class="row">
<div class="col-md-12">
<h1 class="text-center text-white">Facturas</h1>
</div>

        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid mt--7">

    <div class="row mt-5">
      <div class="col-xl-12 mb-5 mb-xl-0">
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Historial Facturas</h3>
              </div>

            </div>
          </div>
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>

                  <th scope="col">Cantidad</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Banco</th>
                  <th scope="col">Id transacción</th>
                  <th scope="col">Captura</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Método de pago</th>
                  <th scope="col">Estatus</th>

                  <th scope="col">Ver</th>
                </tr>
              </thead>
              <tbody>
                <tr>

                  <th scope="row">
                    CLP 25658
                  </th>
                  <td>
                        Email
                       </td>
                  <td>
                   Banco Chile
                  </td>
                  <td>
                    # 256256
                  </td>
                  <td>
                   <img src="/admin/img/descarga.png" width="80px" height="80px" alt="">
                  </td>
                  <td>
                    <i class="fas fa-calendar text-success mr-3"></i> 25/10/2019
                  </td>
                  <td>
                    <i class="fas fa-map-pin text-success mr-3"></i> Transferencia
                  </td>
                  <td>
                    <span class="badge badge-success">Completado</span>
                  </td>
                  <td>
                        <a href="/ordendeposito" class="btn  btn-info">Ver</a>
                  </td>
                </tr>
                <tr>
                        <th scope="row">
                          CLP 25658
                        </th>
                        <td>
                                Email
                               </td>
                        <td>
                         Banco Chile
                        </td>
                        <td>
                          # 256256
                        </td>
                        <td>
                         <img src="/admin/img/descarga.png" width="80px" height="80px" alt="">
                        </td>
                        <td>
                          <i class="fas fa-calendar text-success mr-3"></i> 25/10/2019
                        </td>
                        <td>
                          <i class="fas fa-map-pin text-success mr-3"></i> Transferencia
                        </td>
                        <td>
                          <span class="badge badge-warning">Pendiente</span>
                        </td>
                        <td>
                              <a href="/ordendeposito" class="btn  btn-info">Ver</a>
                        </td>
                      </tr>
                      <tr>
                            <th scope="row">
                              CLP 25658
                            </th>
                            <td>
                                    Email
                                   </td>
                            <td>
                             Banco Chile
                            </td>
                            <td>
                              # 256256
                            </td>
                            <td>
                             <img src="/admin/img/descarga.png" width="80px" height="80px" alt="">
                            </td>
                            <td>
                              <i class="fas fa-calendar text-success mr-3"></i> 25/10/2019
                            </td>
                            <td>
                              <i class="fas fa-map-pin text-success mr-3"></i> Transferencia
                            </td>
                            <td>
                              <span class="badge badge-danger">Eliminada</span>
                            </td>
                            <td>
                                  <a href="/ordendeposito" class="btn  btn-info">Ver</a>
                            </td>
                          </tr>
                          <tr>
                                <th scope="row">
                                  CLP 25658
                                </th>
                                <td>
                                        Email
                                       </td>
                                <td>
                                 Banco Chile
                                </td>
                                <td>
                                  # 256256
                                </td>
                                <td>
                                 <img src="/admin/img/descarga.png" width="80px" height="80px" alt="">
                                </td>
                                <td>
                                  <i class="fas fa-calendar text-success mr-3"></i> 25/10/2019
                                </td>
                                <td>
                                  <i class="fas fa-map-pin text-success mr-3"></i> Transferencia
                                </td>
                                <td>
                                  <span class="badge badge-warning">Pendiente</span>
                                </td>
                                <td>
                                      <a href="/ordendeposito" class="btn  btn-info">Ver</a>
                                </td>
                              </tr>



              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
@endsection
