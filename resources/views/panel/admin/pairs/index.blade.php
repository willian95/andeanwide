@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white text-uppercase">Pares de Divisas</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">

    <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow" style="min-height:350px">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col d-flex justify-content-between">
                            <h3 class="mb-0">Pares de Divisas</h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('panel.admin.symbols.create') }}">Nuevo Par</a>
                        </div>
                    </div>
                </div>


                <div class="table-responsive">
                    <!-- Projects table -->
                    <index-symbol
                        :data="{{ json_encode($symbols) }}"
                    />
                </div>
            </div>
            @if(isset($symbols->links))
            <div class="card">
                <div class="d-flex justify-content-center align-items-center mt-3">
                    {{ $symbols->links() }}
                </div>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection
