@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Verificación de usuario</h1>
                </div>
                @if($errors->all())
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Su solicitud no pudo ser procesada.
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
<!-- Page content -->
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">
                                Verificación de usuario: {{ $user->name }} {{ $user->lastname }}
                            </h3>
                        </div>
                    </div>
                </div>
                <show-user
                    :user="{{ json_encode($user) }}"
                    validate-identity-route="{{ route('panel.admin.users.validate_identity') }}"
                    unvalidate-identity-route="{{ route('panel.admin.users.unvalidate_identity') }}"
                    validate-address-route="{{ route('panel.admin.users.validate_address') }}"
                    unvalidate-address-route="{{ route('panel.admin.users.unvalidate_address') }}"
                    csrf="{{ csrf_token() }}"
                />
            </div>
        </div>
    </div>
</div>
@endsection
