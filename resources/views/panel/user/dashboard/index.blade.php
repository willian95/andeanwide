@extends('layouts.user_adminly')
@section('content')
    <div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                @hasanyrole('user')

                <div class="row mb-5">
                    <div class="col-md-12">
                        <h1 class="text-center text-white">Panel de Control</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                @if(is_null($user->identity))
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Cuenta</h5>
                                            <span class="h2 font-weight-bold mb-0">No Verificada</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                <i class="fas fa-times"></i>
                                            </div>
                                        </div>
                                    </div>
                                @elseif(is_null($user->identity->verified_at))
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Cuenta</h5>
                                            <span class="h2 font-weight-bold mb-0">Pendiente Verificación Nivel 1</span>
                                            <span class="h2 font-weight-bold mb-0">{{ $user->email }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                <i class="fa fa-hand-paper"></i>
                                            </div>
                                        </div>
                                    </div>
                                @elseif(is_null($user->address))
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Cuenta</h5>
                                            <span class="h2 font-weight-bold mb-0">Verificación Nivel 1</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                @elseif(is_null($user->address->verified_at))
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Cuenta</h5>
                                            <span class="h2 font-weight-bold mb-0">Pendiente Verificación Nivel 2</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                                <i class="fa fa-clock"></i>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Cuenta</h5>
                                            <span class="h2 font-weight-bold mb-0">Verificación Nivel 2</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2">Cuenta </span>
                                    <span class="text-nowrap">{{ $user->email }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Ordenes Cerradas</h5>
                                        <span class="h2 font-weight-bold mb-0">
                                            {{ $ordersQty }}
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fa fa-exchange"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2">Total </span>
                                    <span class="text-nowrap">Ordenes cerradas</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Pendientes por Pago</h5>
                                        <span class="h2 font-weight-bold mb-0">
                                            {{ $pendingPaymentOrderQty }}
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2">Total </span>
                                    <span class="text-nowrap">Pendientes por pago</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Ordenes en Proceso</h5>
                                        <span class="h2 font-weight-bold mb-0">
                                            {{ $processingOrderQty }}
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fa fa-info-circle"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2">Total </span>
                                    <span class="text-nowrap">Ordenes en proceso</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endhasanyrole
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        @hasanyrole('agent|user')
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow" style="min-height:350px">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Ultimas Ordenes</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('panel.user.order.create') }}" class="btn btn-success">
                                    <i class="fa fa-paper-plane mr-2"></i>
                                    Crear Orden
                                </a>
                            </div>
                        </div>
                        @if(is_null($user->identity))
                        <div class="alert alert-default alert-dismissible fade show my-4" role="alert">
                            <strong>
                                Se requiere verificar tu información personal.
                            </strong>
                            <a href="{{ route('panel.user.verify') }}" class="btn btn-sm btn-success ml-2"> Verificar</a>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @elseif(is_null($user->identity->verified_at))
                        <div class="alert alert-default alert-dismissible fade show my-4" role="alert">
                            <strong>
                                Tu información ha sido recibida, estas verificando. Te mantendremos informado.
                            </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
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
                                    <th scope="col">Tasa</th>
                                    <th scope="col">Prioridad</th>
                                    <th scope="col">Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr class="text-center">
                                        <th>
                                            <a href="{{ route('panel.user.order.show', ['order' => $order->id]) }}">
                                                {{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                            </a>
                                        </th>
                                        <td>{{ number_format($order->payment_amount, 2, ".", ",") }} {{ $order->currencySended->symbol }}</td>
                                        <td><i class="fa fa-calendar text-success mr-3"></i> {{ (new Carbon\Carbon($order->created_at))->format('d/m/Y h:m') }}</td>
                                        <td><i class="fa fa-map-pin text-success mr-3"></i> {{ $order->currencyReceived->country->name }}</td>
                                        @if($order->symbol->show_inverse)
                                            <td>
                                                {{ number_format(1/$order->exchange_rate, $order->symbol->decimals) }} {{ $order->currencyReceived->symbol }}/{{ $order->currencySended->symbol }}
                                            </td>
                                        @else
                                            <td>
                                                {{ number_format($order->exchange_rate, $order->symbol->decimals) }} {{ $order->currencySended->symbol }}/{{ $order->currencyReceived->symbol }}
                                            </td>
                                        @endif
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
            </div>
        </div>
    </div>
    @endhasanyrole
<!-- Modal -->
@endsection
