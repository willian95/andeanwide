@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Ordenes Nuevas</h1>
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
                        <div class="col">
                            <h3 class="mb-0">Mis envíos</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">Referencia</th>

                                <th scope="col">Total enviado</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">País destino</th>
                                <th>Tasa</th>
                                <th>Prioridad</th>
                                <th scope="col">Estatus</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="text-center">
                                    <th>
                                        <a href="{{ route('user_show_order', ['id' => $order->id]) }}">
                                            {{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                        </a>
                                    </th>
                                    <td>{{ number_format($order->sended_amount, 2, ".", ",") }} {{ $order->currencySended->symbol }}</td>
                                    <td><i class="fas fa-calendar text-success mr-3"></i> {{ (new Carbon\Carbon($order->created_at))->format('d/m/Y h:m') }}</td>
                                    <td><i class="fas fa-map-pin text-success mr-3"></i> {{ $order->currencyReceived->country->name }}</td>
                                    <td>{{ $order->exchange_rate }} {{ $order->currencySended->symbol }}/{{ $order->currencyReceived->symbol }}</td>
                                    <td>{{ $order->priority == 'high' ? 'Alta' : 'Normal' }}</td>
                                    <td>
                                        @if($order->verified_at)
                                            <span class="badge badge-success">Ejecutada</span>
                                        @elseif($order->rejected_at)
                                            <span class="badge badge-danger">No ejecutada</span>
                                        @elseif($order->completed_at)
                                            <span class="badge badge-warning">Pendiente</span>
                                        @else
                                            <span class="badge badge-info">En proceso</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @endsection
