@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
          <div class="header-body">
            <!-- Card stats -->
            <div class="row">
    <div class="col-md-12">
    <h1 class="text-center text-white">Términos y Condiciones</h1>
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

          <div class="card-body">
            <form>

              <div class="pl-lg-4">

                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Crear terminos y condiciones</label>
                        <textarea name="editor1" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                      </div>
                  </div>



                </div>

              </div>


              <div class="pl-lg-4">
              </div>

              <!-- Description -->


              <div class="col-lg-12 text-center">
              <button type="button mx-auto" class="btn btn-success">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection
