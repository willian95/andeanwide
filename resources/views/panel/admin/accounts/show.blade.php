@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
	<div class="container-fluid">
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12">
					<h1 class="text-center text-white">
                        Cuenta Bancaria
                    </h1>
                    <h3 class="text-center text-white">
                        Banco: {{ $account->bank_name }} - Cuenta: {{$account->bank_account }}
                    </h3>
                    <h4 class="text-center text-white">
                        <img src="https://www.countryflags.io/{{$account->country->abbr}}/flat/32.png" class="mx-2">
                        {{ $account->country->name }} | {{ $account->currency->symbol }} - {{ $account->currency->name }}
                    </h4>
                    <br>

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
                <div class="card-header bg-secondary border-0">
                    <div class="row align-items-center">
                        <div class="col d-flex justify-content-between">
                            <h3 class="mb-0">Cuenta Bancaria</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="country_id">País</label>
                                <input type="text" value="{{ $account->country->name }}" class="form-control-plaintext pl-2" id="country_id" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="currency_id">Divisa</label>
                                <input type="text" value="{{ $account->currency->symbol }} - {{ $account->currency->name }}" class="form-control-plaintext pl-2" id="currency_id" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="bank_name">Banco</label>
                                <input type="text" value="{{ $account->bank_name }}" class="form-control-plaintext pl-2" id="bank_name" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="code">IBAN/SWIFT</label>
                                <input type="text" value="{{ $account->code }}" class="form-control-plaintext pl-2" id="code" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="bank_account">Cuenta</label>
                                <input type="text" value="{{ $account->bank_account }}" class="form-control-plaintext pl-2" id="bank_account" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="account_name">Beneficiario</label>
                                <input type="text" value="{{ $account->account_name }}" class="form-control-plaintext pl-2" id="account_name" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <input type="text" value="{{ $account->description }}" class="form-control-plaintext pl-2" id="description" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-4">
                        <div class="col-6 col-md-3">
                            <a href="{{ route('panel.admin.accounts.index') }}" class="btn btn-outline-dark btn-block">Volver</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('panel.admin.accounts.edit', ['account' => $account->id]) }}" class="btn btn-success btn-block">Editar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
