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
                    <h3 class="mb-0">Balances en cuenta</h3>
                  </div>

                </div>
              </div>
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                        <th scope="col">Numero de orden</th>
                      <th scope="col">Fecha</th>
                      <th scope="col">Monto</th>
                      <th scope="col">Disponible</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">
                        25658
                      </th>
                      <td>
                       01/01/2020
                      </td>
                      <td>
                        34000 CLP
                      </td>
                      <td>
                       2500 CLP
                      </td>



                    </tr>


                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>

  @endsection
