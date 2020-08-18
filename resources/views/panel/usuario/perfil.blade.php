@extends('layouts.adminuserly')
    @section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
          <div class="header-body">


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
                    <h3 class="mb-0">Últimas remesas enviadas</h3>
                  </div>
                  <div class="col text-right">
                    <a href="#!" class="btn btn-sm btn-primary">ver todas</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Numero</th>
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

  @endsection
