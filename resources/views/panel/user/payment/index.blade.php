@extends('layouts.user_adminly')
@section('content')
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Mis Pagos</h1>
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
                            <h3 class="mb-0">Mis Pagos</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">Orden No.</th>
                                <th scope="col">No. Transacción</th>
                                <th scope="col">Banco</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Estatus</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                                <tr class="text-center">
                                    <th>
                                        <a href="{{ route('panel.user.order.show', ['order' => $payment->order_id]) }}">
                                            {{ str_pad($payment->order_id, 6, '0', STR_PAD_LEFT) }}
                                        </a>
                                    </th>
                                    <td>
                                        {{ $payment->transaction_number }}
                                    </td>
                                    <td>
                                        {{ $payment->account->bank_name }} - CTA: {{ $payment->account->bank_account }}
                                    </td>
                                    <td>
                                        {{ number_format($payment->payment_amount, 2) }}
                                    </td>
                                    <td>
                                        <i class="fa fa-calendar text-success mr-3"></i> {{ (new Carbon\Carbon($payment->transaction_data))->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        @if(isset($payment->verified_at))
                                            <span class="badge badge-success" title="Pago confirmado.">Pago Confirmado</span>
                                        @elseif(isset($payment->rejected_at))
                                            <span class="badge badge-danger" title="Error en confirmación de pago.">Pago Rechazado</span>
                                        @else
                                            <span class="badge badge-warning" title="No hay pago registrado">En Proceso</span>
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
