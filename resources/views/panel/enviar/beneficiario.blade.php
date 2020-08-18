<div class="container-fluid mt--7">
    <div class="row">

      	<div class="col-xl-12 order-xl-1">
        	<div class="card bg-secondary shadow">

				<div class="card-body">
					<h6 class="heading-small text-muted mb-4">Beneficiario</h6>
					<div class="pl-lg-4">
						<div class="row justify-content-center">
							<div class="col-12 col-md-4">
								<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-create-recipient">
									Crear Beneficiario
								</button>
							</div>
						</div>
					</div>
					<hr>

					<form action="{{ route('panel.add_recipient_remesa') }}" method="post">
						@csrf
						<input type="text" class="d-none" name="order_id" value="{{ $order->id }}">
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-12">
									<ul class="list-group">
										@if($recipients->isNotEmpty())
											@foreach($recipients as $recipient)
												<li class="list-group-item">
													<div class="form-check py-3 px-4">
														<input class="form-check-input mt-2 mr-4" type="radio" name="recipient_id" id="recipient_{{ $recipient->id }}" value="{{ $recipient->id }}">
														<label class="form-check-label w-100 ml-2" for="exampleRadios1">
															<div class="d-flex justify-content-between">
																<h2 class="my-0">{{ $recipient->name }} {{ $recipient->lastname }}</h2>
																<img src="https://www.countryflags.io/{{ $recipient->country->abbr }}/flat/32.png">
															</div>
															<p class="my-0">Documento de identidad: {{ $recipient->dni }}</p>
															<p class="my-0">Banco: {{ $recipient->bank_name }} | Número de cuenta: {{ $recipient->bank_account }}</p>
															<p class="my-0">Correo electrónico: {{ $recipient->email }} | Telefóno: {{ $recipient->phone }}</p>
															<p class="my-0">Dirección: {{ $recipient->address }}</p>
														</label>
													</div>
												</li>
											@endforeach
										@else
											<p class="my-2">No existen beneficiarios registrados.</p>
										@endif
									</ul>
                                </div>
							</div>
							@if($recipients->isNotEmpty())
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label for="reason">Propósito</label>
										<input type="text" class="form-control" id="reason" name="reason">
									</div>
								</div>
							</div>
							@endif
						</div>

						<hr>

						<div class="pl-lg-4">
							<div class="row justify-content-center">
								<div class="col-12 col-md-4 text-center">
									<button type="button mx-auto" class="btn btn-success btn-block">Agregar Beneficario</button>
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
</div>