<div class="container-fluid mt--7">
    <div class="row">

      	<div class="col-xl-12 order-xl-1">
        	<div class="card bg-secondary shadow">

				<div class="card-body">
					<h6 class="heading-small text-muted mb-4">Confirmación</h6>

					<form action="{{ route('panel.complete_remesa') }}" method="post">
						@csrf
                        <input type="text" class="d-none" name="order_id" value="{{ $order->id }}">
                        <div class="row">
                            <div class="col-12 col-md-6 px-2 py-2">
                                <div class="card">
                                    <div class="card-header">
                                        Transacción
                                    </div>
                                    <div class="card-body">
                                        <p>Monto a enviar: {{ $order->sended_amount }} {{ $order->currencySended->symbol }}</p>
                                        <p>Monto a recibir: {{ $order->received_amount }} {{ $order->currencyReceived->symbol }}</p>
                                        <p>Tipo de cambio: 1 {{ $order->currencySended->symbol }} = {{ $order->exchange_rate }} {{ $order->currencyReceived->symbol }}</p>
                                        <p>Costo total: {{ $order->total_cost }} {{ $order->currencySended->symbol }}</p>
                                        <p>Total a depositar: <strong>{{ $order->total_payment }} {{ $order->currencySended->symbol }}</strong></p>
                                        <p>Fecha de creación: {{ $order->created_at }}</p>
                                        <p>Fecha de caducidad: {{ $order->expired_at }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 px-2 py-2">
                                <div class="card">
                                    <div class="card-header">
                                        Beneficiario
                                    </div>
                                    <div class="card-body">
                                        <p>Nombre: {{ $order->recipient->name }} {{ $order->recipient->lastname }}</p>
                                        <p>Número de identificación: {{ $order->recipient->dni }}</p>
                                        <p>País: {{ $order->recipient->country->name }}</p>
                                        <p>Banco: {{ $order->recipient->bank_name }}</p>
                                        <p>Número de cuenta: {{ $order->recipient->bank_account }}</p>
                                        <p>Correo electrónico: {{ $order->recipient->email }}</p>
                                        <p>Telefóno: {{ $order->recipient->phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>


						<div class="pl-lg-4 mt-3">
							<div class="row justify-content-center">
								<div class="col-12 col-md-4 text-center">
									<button type="button mx-auto" class="btn btn-success btn-block">Confirmar </button>
								</div>
							</div>
						</div>
            		</form>
          		</div>
        	</div>
      	</div>
    </div>

    <div class="modal fade" id="modal-create-recipient" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="modal-title-notification">Crear Beneficiario</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="{{ route('panel.create_recipient') }}" method="post">
					@csrf
					<input type="text" class="d-none" name="user_id" value="{{ $order->user_id }}">
					<input type="text" class="d-none" name="country_id" value="{{ $order->currencyReceived->country_id }}">
					<input type="text" class="d-none" name="order_id" value="{{ $order->id }}">
					
					<div class="modal-body py-0">
						<div class="row">
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="name">Nombres</label>
									<input type="text" class="form-control" id="name" aria-describedby="name" name="name" placeholder="Nombres" value="{{ old('dni_number') }}" required>
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="lastname">Apellidos</label>
									<input type="text" class="form-control" id="lastname" aria-describedby="lastname" name="lastname" placeholder="Apellidos" value="{{ old('lastname') }}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label for="dni">Identificación</label>
									<input type="text" class="form-control" id="dni" aria-describedby="identity document number" name="dni" placeholder="Identificación" value="{{ old('dni') }}" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="bank_name">Banco</label>
									<input type="text" class="form-control" id="bank_name" aria-describedby="bank name" name="bank_name" placeholder="Banco" value="{{ old('bank_name') }}" required>
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="bank_account">Número de cuenta</label>
									<input type="text" class="form-control" id="lastname" aria-describedby="bank account number" name="bank_account" placeholder="Número de cuenta" value="{{ old('bank_account') }}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="email">Correo electrónico</label>
									<input type="text" class="form-control" id="email" aria-describedby="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="phone">Número telefónico</label>
									<input type="text" class="form-control" id="phone" aria-describedby="phone number" name="phone" placeholder="Número telefónico " value="{{ old('phone') }}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label for="address">Dirección</label>
									<input type="text" class="form-control" id="address" aria-describedby="address" name="address" placeholder="Dirección" value="{{ old('address') }}" required>
								</div>
							</div>
						</div>
					</div>

					<div class="modal-footer pt-0">
						<button type="submit" class="btn btn-primary btn-block">Crear</button>
					</div>
				</form>
            </div>
        </div>
	</div>

	<script>
		(function(){})()
	</script>
</div>