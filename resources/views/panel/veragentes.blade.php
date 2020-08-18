@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Agentes</h1>
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
                            <h3 class="mb-0">Agentes</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('panel.crearagente') }}" class="btn btn-sm btn-primary">Crear nuevo</a>
                        </div>
                    </div>
                </div>
                <div class=" pl-3 pr-3 pb-3 table-responsive">
                    <!-- Projects table -->
                    <table table id="example"  class=" table-striped table align-items-center table-flush" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nombre empresa</th>
                                <th scope="col">RUT</th>
                                <th scope="col">Rep. Legal</th>



                                <th scope="col">Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    Prueba
                                </th>
                                <td>
                                    25648969
                                </td>
                                <td>
                                    Predo Perez
                                </td>


                                <td>
                                    <a href="{{ route('panel.editaragente') }}" class="btn btn-primary">Ver</a>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @endsection
