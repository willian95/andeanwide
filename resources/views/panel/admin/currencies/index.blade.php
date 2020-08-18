@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Divisas</h1>
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
                            <h3 class="mb-0">Divisas</h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('panel.admin.currencies.create') }}">Nueva Divisa</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">País</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Simbolo</th>
                                <th scope="col">Enviar</th>
                                <th scope="col">Recibir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($currencies as $currency)
                                <tr class="text-center">
                                    <td class="text-left">
                                        <img src="https://www.countryflags.io/{{$currency->country->abbr}}/flat/32.png">
                                        <span class="mx-1"></span>
                                        <a href="{{ route('panel.admin.currencies.show', ['currency' => $currency->id]) }}">
                                            {{ $currency->country->name }}
                                        </a>
                                    </td>
                                    <th>
                                        <a href="{{ route('panel.admin.currencies.show', ['currency' => $currency->id]) }}">
                                            {{ $currency->name }}
                                        </a>
                                    </th>
                                    <td>
                                        <a href="{{ route('panel.admin.currencies.show', ['currency' => $currency->id]) }}">
                                            {{ $currency->symbol }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($currency->can_send)
                                            <span class="badge badge-success">Si</span>
                                        @else
                                            <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($currency->can_receive)
                                            <span class="badge badge-success">Si</span>
                                        @else
                                            <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-4">
                    {{ $currencies->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
