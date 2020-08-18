@extends('layouts.user_adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
	<div class="container-fluid">
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12">
					<h1 class="text-center text-white">Crear Pago</h1> <br>

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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <span>
                                        Selecciona la orden para registar el pago
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="order_id">Orden <i class="fa fa-info-circle"data-toggle="tooltip" data-placement="top" title="Selecciona una orden"></i></label>
                                                <select class="form-control" data-style="btn-primary"  id="orderSelect"
                                                name="orderSelect">
                                                    <option selected disabled value="">Selecciona una orden</option>
                                                    @foreach($orders as $order)
                                                        <option value="{{$order->id}}">
                                                            Orden: {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fin datos de la orden -->
                    <!-- datos de Orden -->
                    @foreach($orders as $order)
                    <div class="row my-2 d-none" id="order_{{$order->id}}" name="orders">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <span>
                                        Orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }}
                                    </span>
                                    <span>
                                        <img class="mx-2" src="https://www.countryflags.io/{{$order->currencySended->country->abbr}}/flat/32.png">
                                        <i class="fa fa-arrow-right"></i>
					                    <img class="mx-2" src="https://www.countryflags.io/{{$order->currencyReceived->country->abbr}}/flat/32.png">
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <p class="my-0">Monto a enviar: {{ number_format($order->sended_amount, 2) }} {{ $order->currencySended->symbol }}</p>
                                            <p class="my-0">Monto a recibir: {{ number_format($order->received_amount, 2) }} {{ $order->currencyReceived->symbol }}</p>
                                            <p class="my-0">Tipo de cambio: 1 {{ $order->currencySended->symbol }} = {{ number_format($order->exchange_rate, 2) }} {{ $order->currencyReceived->symbol }}</p>
                                            <p class="my-0">Costo total: {{ number_format($order->total_cost, 2) }} {{ $order->currencySended->symbol }}</p>
					                        <p class="my-0">Impuesto: {{ number_format($order->tax, 2) }} {{ $order->currencySended->symbol }}</p>
                                            <p class="my-0"><strong class="text-uppercase">Total a depositar: {{ number_format($order->total_payment, 2) }} {{ $order->currencySended->symbol }}</strong></p>
                                            <p class="my-0">Fecha de creación: {{ (new Carbon\Carbon($order->created_at))->format('d/m/Y H:m') }}</p>
                                            <p class="my-0"><strong class="text-uppercase">Fecha de caducidad: {{(new Carbon\Carbon($order->expired_at))->format('d/m/Y H:m') }}</strong></p>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <p class="my-0">Nombre: {{ $order->recipient->name }} {{ $order->recipient->lastname }}</p>
                                            <p class="my-0">Número de identificación: {{ $order->recipient->dni }}</p>
                                            <p class="my-0">País: {{ $order->recipient->country->name }}</p>
                                            <p class="my-0">Banco: {{ $order->recipient->bank_name }}</p>
					                        <p class="my-0">IBAN/SWIFT: </p>
                                            <p class="my-0">Número de cuenta: {{ $order->recipient->bank_account }}</p>
                                            <p class="my-0">Correo electrónico: {{ $order->recipient->email }}</p>
                                            <p class="my-0">Telefóno: {{ $order->recipient->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mt-3">
                                        <div class="col-12 col-md-4">
                                            <a href="{{ route('panel.user.payment.create', ['order' => $order]) }}" class="btn btn-success btn-block">
                                                Registrar Pago
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- fin datas de pago -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function(){
        document.querySelector('#orderSelect').addEventListener('change', function(e){
            var ordersBox = document.querySelectorAll("div[name='orders']");
            for(var i=0; i<ordersBox.length; i++){
                ordersBox[i].classList.add('d-none');
            }
            document.querySelector('#order_'+e.target.value).classList.remove('d-none');
        })
    })()
</script>
@endsection
