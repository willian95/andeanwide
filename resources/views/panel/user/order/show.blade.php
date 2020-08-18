@extends('layouts.user_adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
	<div class="container-fluid">
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12">
					<h1 class="text-center text-white">Orden - No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }}</h1> <br>

					@if ($errors->any())
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
                    @endif

    			</div>
            </div>
		</div>
	</div>
</div>

<!-- Page content -->
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12">
            <div class="card bg-secondary shadow">
				<div class="card-body">
                    <show-order
                        :order="{{ json_encode($order) }}"
                        :message="{{ json_encode($message) }}"
                        :recipients="{{ json_encode($recipients) }}"
                        :accounts="{{ json_encode($accounts) }}"
                        validate-route="{{ route('panel.user.order.fill_order', ['order' => $order->id]) }}"
                        reject-route="{{ route('panel.user.order.destroy', ['order' => $order->id]) }}"
		                create-recipient-route="{{ route('panel.user.recipient.store') }}"
		                add-recipient-route="{{ route('panel.user.order.add_recipient' , ['order' => $order->id ]) }}"
                        create-payment-route="{{ route('panel.user.payment.store') }}"
                        csrf="{{ csrf_token() }}"
                    />
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page content -->
{{-- <div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12">
            <div class="card bg-secondary shadow">
                <div class="card-body">
                    @if(isset($bag))
                        <div class="alert alert-dismissible {{ $bag['class'] }} fade show" role="alert">
                            <p class="my-0"><strong>{{ $bag['message'] }}</strong></p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(isset($order->filled_at) && is_null($order->payment) && is_null($order->rejected_at))
                    <div class="row my-3 d-flex justify-content-center">
                        <div class="col-12 col-md-4">
                            <a href="{{ route('panel.user.payment.create', ['order' => $order]) }}" class="btn btn-success btn-block">
                                Registrar Pago
                            </a>
                        </div>
                    </div>
                    @endif
                    <!-- datos de la orden -->
                    <div class="row my-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <span>
                                        Orden Número: {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }}
                                    </span>
                                    <span>
                                        <img class="mx-2" src="https://www.countryflags.io/{{$order->currencySended->country->abbr}}/flat/32.png">
                                        <i class="fa fa-arrow-right"></i>
					                    <img class="mx-2" src="https://www.countryflags.io/{{$order->currencyReceived->country->abbr}}/flat/32.png">
                                    </span>
                                </div>
                                <div class="card-body">
                                    <p>Monto a enviar: {{ number_format($order->sended_amount, 2) }} {{ $order->currencySended->symbol }}</p>
                                    <p>Monto a recibir: {{ number_format($order->received_amount, 2) }} {{ $order->currencyReceived->symbol }}</p>
                                    <p>Tipo de cambio: 1 {{ $order->currencySended->symbol }} = {{ number_format($order->exchange_rate, 2) }} {{ $order->currencyReceived->symbol }}</p>
                                    <p>Costo total: {{ number_format($order->total_cost, 2) }} {{ $order->currencySended->symbol }}</p>
					                <p>Impuesto: {{ number_format($order->tax, 2) }} {{ $order->currencySended->symbol }}</p>
                                    <p><strong class="text-uppercase">Total a depositar: {{ number_format($order->total_payment, 2) }} {{ $order->currencySended->symbol }}</strong></p>
                                    <p>Fecha de creación: {{ (new Carbon\Carbon($order->created_at))->format('d/m/Y H:m') }}</p>
                                    <p><strong class="text-uppercase">Fecha de caducidad: {{(new Carbon\Carbon($order->expired_at))->format('d/m/Y H:m') }}</strong></p>
                                    <div class="d-flex justify-content-end">
                                        @if(is_null($order->rejected_at) && is_null($order->payment))
                                        <div class="mx-2">
                                            <form action="{{ route('panel.user.order.destroy', ['order' => $order]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="text" class="d-none" name="observation" value="Orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }} ha sido eliminada por el usuario.">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Eliminar Orden
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fin datos de la orden -->
                    <!-- datos de beneficiarios -->
                    <div class="row my-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <span>Beneficiarios</span>
                                    <span>
                                        <img class="mx-2" src="https://www.countryflags.io/{{$order->currencyReceived->country->abbr}}/flat/32.png">
                                    </span>
                                </div>
                                <div class="card-body">
                                    @if(isset($order->recipient))
                                        <p>Nombre: {{ $order->recipient->name }} {{ $order->recipient->lastname }}</p>
                                        <p>Número de identificación: {{ $order->recipient->dni }}</p>
                                        <p>País: {{ $order->recipient->country->name }}</p>
                                        <p>Banco: {{ $order->recipient->bank_name }}</p>
					                    <p>IBAN/SWIFT: {{ $order->recipient->code }}</p>
                                        <p>Número de cuenta: {{ $order->recipient->bank_account }}</p>
                                        <p>Correo electrónico: {{ $order->recipient->email }}</p>
                                        <p>Telefóno: {{ $order->recipient->phone }}</p>
                                    @else
                                        <div class="text-center">
                                            <p>No se ha registrado ningún beneficiario para esta orden.</p>
                                        </div>
                                        @if(is_null($order->filled_at) && is_null($order->verified_at) && is_null($order->rejected_at))
                                        <div class="text-center">
                                            <a class="btn btn-success" href="{{ route('panel.user.order.create', ['order_id' => $order->id]) }}"> Agregar Beneficiario</a>
                                        </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fin datos de beneficiarios -->
                    <!-- datos de pago -->
                    <div class="row my-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <span>Pago Registrado</span>
                                    <span>
                                        @if(isset($order->payment))
                                            @if(isset($order->payment->rejected_at))
                                                <span class="badge badge-danger">Pago Rechazado</span>
                                            @elseif(isset($order->payment->verified_at))
                                                <span class="badge badge-success">Pago Confirmado</span>
                                            @else
                                                <span class="badge badge-info">Pendiente por confirmación</span>
                                            @endif
                                        @else
                                            <span class="badge badge-warning">No hay pago registrado</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="card-body">
                                    @if(isset($order->rejected_at))
                                        <div class="text-center">
                                            <p class="my-0">Esta orden ha sido eliminada.</p>
                                            <p class="my-0">{{ $order->observation }}</p>
                                        </div>
                                    @elseif(is_null($order->filled_at) && is_null($order->completed_at) && is_null($order->verified_at))
                                        <div class="text-center">
                                            <p>Esta orden no se ha completado.</p>
                                            <a class="btn btn-success" href="{{ route('panel.user.order.create', ['order_id' => $order->id]) }}">
                                                Completar Orden
                                            </a>
                                        </div>
                                    @endif
                                    @if(isset($order->filled_at) && isset($order->payment))
                                        <div>
                                            <div class="d-flex justify-content-between">
                                            <p>
                                                Banco:
                                                {{ $order->payment->account->bank_name }} - IBAN/SWIFT: {{ $order->payment->account->code }}
                                            </p>
                                            <span>
                                                <img class="mx-2" src="https://www.countryflags.io/{{$order->currencySended->country->abbr}}/flat/32.png">
                                            </span>
                                            </div>
                                            <p>
                                                Cuenta: {{ $order->payment->account->bank_account }}
                                            </p>
                                            <p>
                                                Numero de Transacción:
                                                {{ $order->payment->transaction_number }}
                                            </p>
                                            <p>
                                                Fecha de la Transacción:
                                                {{ (new Carbon\Carbon($order->payment->transaction_date))->format('d/m/Y') }}
                                            </p>
                                            <p>
                                                Monto Pagado:
                                                {{ number_format($order->payment->payment_amount, 2) }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fin datas de pago -->
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
