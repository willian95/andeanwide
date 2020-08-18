<div class="container-fluid mt--7">
    <div class="row">

      	<div class="col-xl-12 order-xl-1">
        	<div class="card bg-secondary shadow">

				<div class="card-body">
					<h6 class="heading-small text-muted mb-4 py-2">Pago</h6>

					<form action="{{ route('panel.send_payment') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="d-none" name="order_id" value="{{ $order->id }}">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="accountSelect">Cuenta donde realizaste el pago<i class="fa fa-info-circle"data-toggle="tooltip" data-placement="top" title="Selecciona cuenta donde realizaste el pago"></i></label>
                                    <select class="form-control" data-style="btn-primary"  id="accountSelect"
                                    name="account_id">
                                        <option selected disabled value="">Selecciona una cuenta</option>
                                        @foreach($accounts as $account)
                                            <option value="{{$account->id}}">
                                                {{ $account->bank_name }} - CTA: {{ $account->bank_account }} - Moneda: {{ $account->currency->symbol }}
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

	<script>
		(function(){})()
	</script>
</div>