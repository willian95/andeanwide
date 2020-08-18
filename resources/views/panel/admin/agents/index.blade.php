@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Lista de Agentes</h1>
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
                    <div class="row align-items-center justify-content-between">
                        <div class="col">
                            <h3 class="mb-0">Usuarios</h3>
                        </div>
                        <div>
                            <a href="{{ route('panel.admin.invitations.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-paper-plane mr-2" aria-hidden="true"></i>
                                Invitar
                            </a>
                            <a href="{{ route('panel.admin.agents.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>
                                Crear Agente
                            </a>
                        </div>
                    </div>
                </div>
                <div class=" pl-3 pr-3 pb-3 table-responsive">
                    <!-- Projects table -->
                    <table table class=" table-striped table align-items-center table-flush" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">Nombres</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">País</th>
                                <th scope="col" class="text-center">Email Verificado</th>
                                <th scope="col" class="text-center">Docs. Completados</th>
                                <th scope="col" class="text-center">Cuenta Verificada</th>
                                <th scope="col" class="text-center">Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
