@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
          <div class="header-body">
            <!-- Card stats -->
            <div class="row">
    <div class="col-md-12">
    <h1 class="text-center text-white">Reportes</h1>
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
                <h3 class="mb-0"></h3>Ver reportes</h3>
              </div>

            </div>
          </div>
          <div class="card-body">
                <div class="col-12 text-center">
                        <form action="">
                 <div class="form-group">
                <label for="inputStatus">Tipo de reporte</label>

                <select class="form-control custom-select">
                  <option selected disabled>Depósitos recibidos</option>

                  <option>Remesas enviadas</option>

                </select>
                 </div>
            </form>
              </div>
              <form action="">

                <div class="input-daterange datepicker row align-items-center">
                        <div class="col-12 text-center">
                        <label for="inputStatus">Rango de fecha</label>
                        </div>
                        <div class="col">

                            <div class="form-group">

                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Start date" type="text" value="06/18/2019">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="End date" type="text" value="06/22/2019">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-md-12 text-center">
                <button type="button" class="btn btn-success">
                       Buscar
                     </button>
                    </div>
          </div>
        </div>
      </div>
    </div>
@endsection
