@extends('layouts.adminly')
@section('content')

<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Agentes</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $agentsQty }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                    <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2">Total</span>
                                <span class="text-nowrap">Agentes registrados</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Usuarios </h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $usersQty }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2">Total </span>
                                <span class="text-nowrap">Usuarios registrados</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Pagos por procesar</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $pendingOrdersQty }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fa fa-check"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2">Total </span>
                                <span class="text-nowrap">Pagos pendiente por procesar</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Ordenes por cerrar</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $pendingClosePaymentOrdersQty }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fa fa-check"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2">Total</span>
                                <span class="text-nowrap">Ordenes Procesadas</span>
                            </p>
                        </div>
                    </div>
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
                            <h3 class="mb-0">Ordenes con pago - Pendiente por procesar</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route("panel.admin.orders.index_new") }}" class="btn btn-sm btn-success">ver todos</a>
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
                                <th>Tasa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingOrders as $order)
                                <tr class="text-center">
                                    <th>
                                        <a href="{{ route('panel.admin.orders.show', ['order' => $order->id]) }}">
                                            {{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                        </a>
                                    </th>
                                    <td>{{ $order->user->email }}</td>
                                    <td>{{ number_format($order->payment_amount, 2, ".", ",") }} {{ $order->currencySended->symbol }}</td>
                                    <td><i class="fas fa-calendar text-success mr-3"></i> {{ (new Carbon\Carbon($order->created_at))->format('d/m/Y h:m') }}</td>
                                    <td><i class="fas fa-map-pin text-success mr-3"></i> {{ $order->currencyReceived->country->name }}</td>
                                    @if($order->symbol->show_inverse)
                                        <td>
                                            {{ number_format(1/$order->exchange_rate, $order->symbol->decimals) }} {{ $order->currencyReceived->symbol }}/{{ $order->currencySended->symbol }}
                                        </td>
                                    @else
                                        <td>
                                            {{ number_format($order->exchange_rate, $order->symbol->decimals) }} {{ $order->currencySended->symbol }}/{{ $order->currencyReceived->symbol }}
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Ordenes con pago verificado - Pendientes por cerrar</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('panel.admin.orders.index_unconfirmed') }}" class="btn btn-sm btn-success">ver todos</a>
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
                                <th>Tasa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingClosePaymentOrders as $order)
                                <tr class="text-center">
                                    <th>
                                        <a href="{{ route('panel.admin.orders.show', ['order' => $order->id]) }}">
                                            {{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                        </a>
                                    </th>
                                    <td>{{ $order->user->email }}</td>
                                    <td>{{ number_format($order->payment_amount, 2, ".", ",") }} {{ $order->currencySended->symbol }}</td>
                                    <td><i class="fas fa-calendar text-success mr-3"></i> {{ (new Carbon\Carbon($order->created_at))->format('d/m/Y h:m') }}</td>
                                    <td><i class="fas fa-map-pin text-success mr-3"></i> {{ $order->currencyReceived->country->name }}</td>
                                    @if($order->symbol->show_inverse)
                                        <td>
                                            {{ number_format(1/$order->exchange_rate, $order->symbol->decimals) }} {{ $order->currencyReceived->symbol }}/{{ $order->currencySended->symbol }}
                                        </td>
                                    @else
                                        <td>
                                            {{ number_format($order->exchange_rate, $order->symbol->decimals) }} {{ $order->currencySended->symbol }}/{{ $order->currencyReceived->symbol }}
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Ordenes Aprobadas</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('panel.admin.orders.index_confirmed') }}" class="btn btn-sm btn-success">ver todos</a>
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
                                <th>Tasa</th>
                                <th>Prioridad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($completedOrders as $order)
                                <tr class="text-center">
                                    <th>
                                        <a href="{{ route('panel.admin.orders.show', ['order' => $order->id]) }}">
                                            {{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                        </a>
                                    </th>
                                    <td>{{ $order->user->email }}</td>
                                    <td>{{ number_format($order->payment_amount, 2, ".", ",") }} {{ $order->currencySended->symbol }}</td>
                                    <td><i class="fas fa-calendar text-success mr-3"></i> {{ (new Carbon\Carbon($order->created_at))->format('d/m/Y h:m') }}</td>
                                    <td><i class="fas fa-map-pin text-success mr-3"></i> {{ $order->currencyReceived->country->name }}</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Usuarios Pendientes Verificación Nivel - 1</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route("panel.admin.orders.index_new") }}" class="btn btn-sm btn-success">ver todos</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <!-- Projects table -->
                    <table table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">Nombres</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">País</th>
                                <th scope="col" class="text-center">Nivel</th>
                                <th scope="col" class="text-center">Email Verificado</th>
                                <th scope="col" class="text-center">D. Identidad</th>
                                <th scope="col" class="text-center">D. Residencia</th>
                                <th scope="col" class="text-center">Pendiente Verificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingIdentityUsers as $user)
                            <tr>
                                <th class="text-center">
                                    @if(isset($user->name) && isset($user->lastname))
                                    <a href="{{ route('panel.admin.users.show', $user->id) }}">
                                        {{ $user->name }} {{ $user->lastname }}
                                    </a>
                                    @else
                                    S/N
                                    @endif
                                </th>
                                <th scope="row" class="text-center">
                                    <a href="{{ route('panel.admin.users.show', $user->id) }}">
                                        {{ $user->email }}
                                    </a>
                                </th>
                                <td class="text-center">
                                    {{ $user->country->name }}
                                </td>
                                <td class="text-center">{{ $user->verificationLevel }}</td>
                                <td class="text-center">
                                    @if(is_null($user->email_verified_at))
                                        <div class="badge badge-danger text-wrap" style="width: 4rem;">
                                            No
                                        </div>
                                    @else
                                        <div class="badge badge-success text-wrap" style="width: 4rem;">
                                            Si
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(is_null($user->identity))
                                        <div class="badge badge-danger text-wrap" style="width: 4rem;">
                                            No
                                        </div>
                                    @else
                                        <div class="badge badge-success text-wrap" style="width: 4rem;">
                                            Si
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(is_null($user->address))
                                        <div class="badge badge-danger text-wrap" style="width: 4rem;">
                                            No
                                        </div>
                                    @else
                                        <div class="badge badge-success text-wrap" style="width: 4rem;">
                                            Si
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($user->hasPendingApprovalLevel)
                                        <div class="badge badge-danger text-wrap" style="width: 4rem;">
                                            Si
                                        </div>
                                    @else
                                        <div class="badge badge-success text-wrap" style="width: 4rem;">
                                            No
                                        </div>
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

    <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Usuarios Pendientes Verificación Nivel - 2</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route("panel.admin.orders.index_new") }}" class="btn btn-sm btn-success">ver todos</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <!-- Projects table -->
                    <table table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">Nombres</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">País</th>
                                <th scope="col" class="text-center">Nivel</th>
                                <th scope="col" class="text-center">Email Verificado</th>
                                <th scope="col" class="text-center">D. Identidad</th>
                                <th scope="col" class="text-center">D. Residencia</th>
                                <th scope="col" class="text-center">Pendiente Verificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingAddressUsers as $user)
                            <tr>
                                <th class="text-center">
                                    @if(isset($user->name) && isset($user->lastname))
                                    <a href="{{ route('panel.admin.users.show', $user->id) }}">
                                        {{ $user->name }} {{ $user->lastname }}
                                    </a>
                                    @else
                                    S/N
                                    @endif
                                </th>
                                <th scope="row" class="text-center">
                                    <a href="{{ route('panel.admin.users.show', $user->id) }}">
                                        {{ $user->email }}
                                    </a>
                                </th>
                                <td class="text-center">
                                    {{ $user->country->name }}
                                </td>
                                <td class="text-center">{{ $user->verificationLevel }}</td>
                                <td class="text-center">
                                    @if(is_null($user->email_verified_at))
                                        <div class="badge badge-danger text-wrap" style="width: 4rem;">
                                            No
                                        </div>
                                    @else
                                        <div class="badge badge-success text-wrap" style="width: 4rem;">
                                            Si
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(is_null($user->identity))
                                        <div class="badge badge-danger text-wrap" style="width: 4rem;">
                                            No
                                        </div>
                                    @else
                                        <div class="badge badge-success text-wrap" style="width: 4rem;">
                                            Si
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(is_null($user->address))
                                        <div class="badge badge-danger text-wrap" style="width: 4rem;">
                                            No
                                        </div>
                                    @else
                                        <div class="badge badge-success text-wrap" style="width: 4rem;">
                                            Si
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($user->hasPendingApprovalLevel)
                                        <div class="badge badge-danger text-wrap" style="width: 4rem;">
                                            Si
                                        </div>
                                    @else
                                        <div class="badge badge-success text-wrap" style="width: 4rem;">
                                            No
                                        </div>
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
</div>
<!-- Modal -->
@endsection
