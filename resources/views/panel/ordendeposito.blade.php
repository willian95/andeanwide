@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
      <div class="header-body">
        <!-- Card stats -->
        <div class="row">
<div class="col-md-12">
<h1 class="text-center text-white">Orden Número : </h1>
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
                <h3 class="mb-0">Nombre agente: Prueba C.A. </h3>
                <p><b><small>RUT: 589289678</small> </b></p>
                <p><strong>Pedro Perez</strong></p>
                <p><strong>Email: info@almasaeedstudio.com</strong></p>

              </div>
              <div class="col text-right">
                    <p></strong>Fecha:24/10/09 </strong></p>
                    <p class="text-danger">Número de orden:2525658 </p>
                  </div>
            </div>
          </div>
          <!-- Table row -->
          <div class="row">
                <div class="col-12 table-responsive">
                  <table class=" table align-items-center table-flus">
                    <thead class="thead-light">
                    <tr>
                      <th>Cantidad</th>
                      <th>Banco</th>
                      <th>Captura</th>
                      <th>Número de transacción</th>
                      <th>Método de pago</th>
                       <th>Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>CLP 2500</td>
                      <td>Banco de Chile</td>
                      <td>
                            <img src="/admin/img/descarga.png" width="80px" height="80px" alt="">
                           </td>
                      <td>5896278829</td>
                      <td>Depósito</td>
                       <td>4/10/2019</td>
                    </tr>


                    </tbody>
                  </table>

        </div>
      </div>
      <div class="row ml-3 mt-5">

            <div class="col-6">
                    <form action="">
             <div class="form-group">
            <label for="inputStatus">Estado de orden</label>

            <select class="form-control custom-select">
              <option selected disabled>Pendiente</option>

              <option>Acreditar</option>
              <option>Contacto cliente</option>

               <option>Eliminar</option>
            </select>
        </form>
          </div>
            </div>

          </div>
          <div class="row no-print ml-3 mr-3 mb-5">
                <div class="col-12">
                  <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right">
                     Guardar
                  </button>
                  <button type="button" class="btn btn-danger float-right">
                        Cancelar
                     </button>
                  <button type="button" class="btn btn-primary " style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generar .pdf
                  </button>
                </div>
              </div>
          <!-- /.row -->
        </div>
    </div>
    </div>
@endsection
