<div class="container-fluid mt--7">
    <div class="row">

      	<div class="col-xl-12 order-xl-1">
        	<div class="card bg-secondary shadow">

				<div class="card-body">
					<form method="post" action="{{ route('panel.create_remesa') }}">
						@csrf
						<h6 class="heading-small text-muted mb-4">Datos de orden de remesa</h6>
						<div class="pl-lg-4">
							<div class="row justify-content-center">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="fromCountrySelect">Desde <i class="fa fa-info-circle"data-toggle="tooltip" data-placement="top" title="Selecciona el país desde donde envías la remesa"></i> </label>
										<select class="selectpicker form-control form-control-alternative" data-style="btn-primary"  id="fromCountrySelect"
										name="currency_sended_id">
											<option selected disabled value="">Selecciona un país</option>
											@foreach($currencies as $currency)
												@if($currency->can_send)
												<option data-content='<img src="https://www.countryflags.io/{{$currency->country->abbr}}/flat/32.png"> <span>{{ $currency->country->name }}</span>'value="{{$currency->id}}"></option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="toCountrySelect">País Destino <i class="fa fa-info-circle"data-toggle="tooltip" data-placement="top" title="Selecciona el país destino de la remesa"></i></label>
										<select class="selectpicker form-control form-control-alternative " data-style="btn-primary"  id="toCountrySelect"
										name="currency_received_id">
											<option selected disabled value="">Selecciona un país</option>
											@foreach($currencies as $currency)
												@if($currency->can_receive)
												<option data-content='<img src="https://www.countryflags.io/{{$currency->country->abbr}}/flat/32.png"> <span>{{ $currency->country->name }}</span>'value="{{$currency->id}}"></option>
												@endif
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-lg-4">
									<label class="form-control-label" for="sending-amount">Total a enviar <i class="fa fa-info-circle"data-toggle="tooltip" data-placement="top" title="Monto a enviar"></i></label>
									<div class="input-group">
										<input type="number" id="sending-amount"
										name="sended_amount" class="form-control" placeholder="Monto a enviar" value="">
										<div class="input-group-append">
											<label class="input-group-text" for="sending-amount" id="sending-label">$</label>
										</div>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="form-group">
										<label for="prioritySelect">Prioridad  <i class="fa fa-info-circle"data-toggle="tooltip" data-placement="top" title="Selecciona tipo de prioridad"></i> <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-notification">¿Qué son las prioridades?</button></label>
										<select class="selectpicker form-control " data-style="btn-primary" id="prioritySelect"
										name="priority">
											<option data-subtext="Mismo día" value="high">ALTA</option>
											<option data-subtext="3 días hábiles" value="normal" selected>BAJA</option>
										</select>
									</div>
								</div>

								<div class="d-none">
									<input type="text" id="transaction_cost" name="transaction_cost">
									<input type="text" id="priority_cost" name="priority_cost">
									<input type="text" id="total_cost" name="total_cost">
									<input type="text" id="total_payment" name="total_payment">
									<input type="text" id="exchange_rate" name="exchange_rate">
								</div>

								<div class="col-lg-4">
									<label class="form-control-label" for="receiving-amount">Total a recibir  <i class="fa fa-info-circle"data-toggle="tooltip" data-placement="top" title="Monto a recibir por el beneficiario"></i></label>
									<div class="input-group">
										<input type="text" id="receiving-amount"
										name="received_amount" class="form-control" placeholder="" value="" readonly>
										<div class="input-group-append">
											<label class="input-group-text" for="receiving-amount" id="receiving-label">$</label>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-lg-6 pt-4 pb-5">
									<div class="card d-none" id="infoCard">
										<div class="card-body text-center">
											<p class="mb-1"><small class="text-red" id="exchangeText"></small></p>
											<p class="mb-1"><small class="text-red" id="priorityText"></small></p>
											<p class="mb-1"><small class="text-red" id="sendingText"></small></p>
											<p class="mb-1"><small class="text-red" id="receivingText"></small></p>
											<p class="mb-1"><small class="text-red" id="transactionText"></small></p>
											<p class="mb-1"><small class="text-red" id="totalCostText"></small></p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-12 text-center">
							<button type="button mx-auto" class="btn btn-success">Guardar</button>
						</div>
            		</form>
          		</div>
        	</div>
      	</div>
    </div>

    <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">
				<div class="modal-header">
					<h6 class="modal-title" id="modal-title-notification">Prioridades</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>

                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="heading mt-4">Tipos de prioridades</h4>
                        <p>Prioridad alta: Tu remesa llegará el mismo día</p>
                        <P>Prioridad alta valida para envíos a Chile y Venezuela,  Colombia solo disponible para beneficiarios cuyas cuentas destinos sean en los bancos: Bancolombia y Banco de Bogota.</P>
                        <p>Prioridad Baja: Tu remesa llegará en tres días hábiles</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Crear</button>
                </div>
            </div>
        </div>
	</div>

	<script>
		(function(){

			var currencies = <?php echo json_encode($currencies); ?>;
			var priorities = [
				{
					name: 'normal',
					dispaly: 'Normal (3 días hábiles)',
					cost: 0
				},
				{
					name: 'high',
					display: 'Alta (mismo día)',
					cost: 5000,
				}
			];

			var fromSelect = document.querySelector('#fromCountrySelect');
			var fromLabel = document.querySelector('#sending-label');
			var fromInput = document.querySelector('#sending-amount');
			var toSelect = document.querySelector('#toCountrySelect');
			var toLabel = document.querySelector('#receiving-label');
			var toInput = document.querySelector('#receiving-amount');
			var prioritySelect = document.querySelector('#prioritySelect');

			var fromCurrency = '';
			var fromAmount = 0;
			var toCurrency = '';
			var toAmount = 0;
			var priority = 'Normal (3 días hábiles)';
			var priorityCost = 0;

			// data from query
			var exchangeRate = 4.25;
			var transactionCost = 1500;


			fromSelect.addEventListener('change', function(e){
				var currencyId = e.target.value;
				var index = currencies.findIndex(function(currency){
					return currency.id == currencyId
				});
				fromCurrency = currencies[index].symbol;
				fromLabel.innerText = fromCurrency
				updateText();
			});

			toSelect.addEventListener('change', function(e){
				var currencyId = e.target.value;
				var index = currencies.findIndex(function(currency){
					return currency.id == currencyId;
				});
				toCurrency = currencies[index].symbol;
				toLabel.innerText = toCurrency
				updateText();
			});

			fromInput.addEventListener('keyup', function(e){
				fromAmount = e.target.value
				toAmount = (e.target.value * exchangeRate).toFixed(2);;
				toInput.value = toAmount;
				updateText();
			});

			prioritySelect.addEventListener('change', function(e){
				var index = priorities.findIndex(function(priority){
					return priority.name == e.target.value;
				});
				priority = priorities[index].display;
				priorityCost = priorities[index].cost;
				updateText();
			});

			var updateText = function(){
				var cost = + parseFloat(transactionCost) + parseFloat(priorityCost);
				var total = parseFloat(fromAmount) + parseFloat(cost);
				document.querySelector('#infoCard').classList.remove('d-none')

				document.querySelector('#exchangeText').innerText = 'Tipo de Cambio : 1 ' + fromCurrency + ' = ' + exchangeRate + ' ' + toCurrency;

				document.querySelector('#priorityText').innerText = 'Prioridad : ' + priority;

				document.querySelector('#sendingText').innerText = 'Monto a enviar: ' + fromAmount + ' ' + fromCurrency;

				document.querySelector('#receivingText').innerText = ' Monto a recibir: ' + toAmount + ' ' + toCurrency;

				document.querySelector('#transactionText').innerText = 'Costo de transacción: ' + cost + ' ' + fromCurrency;

				document.querySelector('#totalCostText').innerText = 'Costo Total: ' + total + ' ' + fromCurrency;

				document.querySelector('#transaction_cost').value = transactionCost;
				document.querySelector('#priority_cost').value = priorityCost;
				document.querySelector('#total_cost').value = cost;
				document.querySelector('#total_payment').value = total;
				document.querySelector('#exchange_rate').value = exchangeRate;
			}
			
		})()
	</script>
</div>