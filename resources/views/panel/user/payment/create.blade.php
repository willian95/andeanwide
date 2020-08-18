@extends('layouts.user_adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
	<div class="container-fluid">
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12">
					<h1 class="text-center text-white">Registrar Pago - Orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }}</h1> <br>

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
                    <!-- datos de la orden -->
                    <div class="row my-2">
                        <div class="col-6">
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
                                    <p>Monto a enviar: {{ number_format($order->sended_amount, 2, ",", ".") }} {{ $order->currencySended->symbol }}</p>
                                    <p>Monto a recibir: {{ number_format($order->received_amount, 2, ",", ".") }} {{ $order->currencyReceived->symbol }}</p>
                                    <p>Tipo de cambio: 1 {{ $order->currencySended->symbol }} = {{ number_format($order->exchange_rate, 2, ",", ".") }} {{ $order->currencyReceived->symbol }}</p>
                                    <p>Costo total: {{ number_format($order->total_cost, 2, ",", ".") }} {{ $order->currencySended->symbol }}</p>
					                <p>Impuesto: {{ number_format($order->tax, 2) }} {{ $order->currencySended->symbol }}</p>
					                <p><strong class="text-uppercase">Total a depositar: {{ number_format($order->total_payment, 2, ",", ".") }} {{ $order->currencySended->symbol }}</strong></p>
                                    <p>Fecha de creación: {{ $order->created_at }}</p>
					                <p><strong class="text-uppercase">Fecha de caducidad: {{ $order->expired_at }}</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <span>Beneficiarios</span>
                                    <span>
                                        <img class="mx-2" src="https://www.countryflags.io/{{$order->currencyReceived->country->abbr}}/flat/32.png">
                                    </span>
                                </div>
                                <div class="card-body">
                                    <p>Nombre: {{ $order->recipient->name }} {{ $order->recipient->lastname }}</p>
                                    <p>Número de identificación: {{ $order->recipient->dni }}</p>
                                    <p>País: {{ $order->recipient->country->name }}</p>
                                    <p>Banco: {{ $order->recipient->bank_name }}</p>
                                    <p>IBAN/SWIFT: {{ $order->recipient->code }}</p>
                                    <p>Número de cuenta: {{ $order->recipient->bank_account }}</p>
                                    <p>Correo electrónico: {{ $order->recipient->email }}</p>
                                    <p>Telefóno: {{ $order->recipient->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fin datos de la orden -->
                    <!-- datos de pago -->
                    <div class="row my-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <span>Pago</span>
                                    <span>
                                        <img class="mx-2" src="https://www.countryflags.io/{{$order->currencySended->country->abbr}}/flat/32.png">
                                    </span>
                                </div>

                                <div class="card-body">
                                    <form action="{{ route('panel.user.payment.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" class="d-none" name="order_id" value="{{ $order->id }}">

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="accountSelect">Cuenta donde realizaste el pago <i class="fa fa-info-circle"data-toggle="tooltip" data-placement="top" title="Selecciona cuenta donde realizaste el pago"></i></label>
                                                    <select class="form-control" data-style="btn-primary"  id="accountSelect"
                                                    name="account_id">
                                                        <option selected disabled value="">Selecciona una cuenta</option>
                                                        @foreach($accounts as $account)
                                                            <option value="{{$account->id}}">
                                                                {{ $account->bank_name }} - IBAN/SWIFT: {{ $account->code }} - CTA: {{ $account->bank_account }} - Moneda: {{ $account->currency->symbol }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Número transacción </label>
                                                    <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="" name="transaction_number">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Fecha de transacción</label>
                                                    <div class="input-group input-group-alternative">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                        </div>
                                                        <input class="form-control datepicker" placeholder="Fecha de depósito o transferencia." type="text" name="transaction_date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Monto</label>
                                                    <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Monto depositado o transferido"
                                                    name="payment_amount_showed" value="{{ number_format($order->total_payment, 2, '.', ',') }} {{ $order->currencySended->symbol }}" disabled>
                                                    <input type="text" class="d-none" name="payment_amount" value="{{ $order->total_payment }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row my-3">
                                            <div class="col-12 text-center">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFileLang" lang="es" accept="image/*" name="image">
                                                    <label class="custom-file-label" for="customFileLang">Adjuntar información de pago</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center mt-5">
                                            <div class="col-12 col-md-4 text-center">
                                                <button type="button mx-auto" class="btn btn-success btn-block">Cargar Pago</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fin datas de pago -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
