@extends('layouts.adminuserly')
    @section('content')


  <!-- Content Wrapper. Contains page content -->
   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ingreso de dinero a cuenta</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/perfil">Incio</a></li>
              <li class="breadcrumb-item active">Nombre de usuario</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <!-- START ALERTS AND CALLOUTS -->
     <div class="row">


          <div class="col-md-12 mb-5">
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                  Añade nuevo destinatario
                </button>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END ALERTS AND CALLOUTS -->

         <div class="row">
             <div class="col-md-12">
          <!-- left column -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Destinatarios agregados</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Email usuario</th>
                  <th>Monto Ingresado</th>
                  <th>Fecha</th>
                  <th>Estatus</th>
                  <th>Editar</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Pedro Perez</td>
                  <td>Pedrop@gmail.com
                  </td>
                  <td>$ 25000</td>
                    <td>4/10/2019</td>
                  <td> <span class="badge badge-warning">Pendiente</span></td>
                  <td><a href="/ordendeposito"> <button class="btn btn-success btn-block" >Ver </button> </a>
                    </td>
                </tr>
                  <tr>
                  <td>Pedro Perez</td>
                  <td>Pedrop@gmail.com
                  </td>
                  <td>$ 25000</td>
                <td>4/10/2019</td>
                  <td> <span class="badge badge-success">Aprobado</span></td>
                  <td><a href="/ordendeposito"> <button class="btn btn-success btn-block" >Ver </button> </a>
                    </td>
                </tr>

                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
             </div>
         </div>
          <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- /.content-wrapper -->

<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Default Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


  @endsection
