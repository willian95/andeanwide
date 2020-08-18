@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Invitación a Registro de Agente</h1>
                </div>
                @if ($errors->any())
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
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
                            <h3 class="mb-0">Invitar a Resgistro de Agente</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('panel.admin.invitations.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombres</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="row justify-content-end mr-1">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-paper-plane mr-2" aria-hidden="true"></i>
                                Enviar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
