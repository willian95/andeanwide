@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Ordenes</h1>
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
                            <h3 class="mb-0">Ordenes de envíos</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">Referencia</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Total enviado</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">País destino</th>
                                <th scope="col">Tasa</th>
                                <th scope="col">Prioridad</th>
                                <th scope="col">Estatus</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="text-center">
                                    <th>
                                        <a href="{{ route('panel.admin.orders.show', ['order' => $order->id]) }}">
                                            {{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                        </a>
                                    </th>
                                    <td>{{ $order->user->email }}</td>
                                    <td>{{ number_format($order->sended_amount, 2, ".", ",") }} {{ $order->currencySended->symbol }}</td>
                                    <td>{{ (new Carbon\Carbon($order->created_at))->format('d/m/Y h:m') }}</td>
                                    <td>
                                        <span>
                                            <img class="mx-2" src="https://www.countryflags.io/{{$order->currencySended->country->abbr}}/flat/32.png">
                                            <i class="fa fa-arrow-right"></i>
                                            <img class="mx-2" src="https://www.countryflags.io/{{$order->currencyReceived->country->abbr}}/flat/32.png">
                                        </span>
                                    </td>
                                    <td>{{ $order->exchange_rate }} {{ $order->currencySended->symbol }}/{{ $order->currencyReceived->symbol }}</td>
                                    <td>{{ $order->priority == 'high' ? 'Alta' : 'Normal' }}</td>
                                    <td>
                                        @print_status($order->status)
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if(isset($orders->links))
            <div class="card">
                <div class="d-flex justify-content-center align-items-center mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection
