@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
	<div class="container-fluid">
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12">
					<h1 class="text-center text-white">Crear Nueva Cuenta</h1>
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
                            <h3 class="mb-0">Nueva Cuenta Bancaria</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('panel.admin.accounts.store') }}" method="post" id="createForm">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="country_id">País</label>
                                    <select class="form-control selectpicker" data-style="btn-primary" id="country_id" name="country_id">
                                        <option selected value="">Selecccione un País</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}" data-content='<img src="https://www.countryflags.io/{{$country->abbr}}/flat/32.png"> <span>{{ $country->name }}</span>'>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="currency_id">Divisa</label>
                                    <select class="form-control selectpicker" data-style="btn-primary" id="currency_id" name="currency_id">
                                        <option selected value="">Selecccione un País</option>
                                        @foreach($currencies as $currency)
                                        <option value="{{ $currency->id }}" data-content='<img src="https://www.countryflags.io/{{$currency->country->abbr}}/flat/32.png"> <span>{{ $currency->symbol }} - {{ $currency->name }}</span>'></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="bank_name">Banco</label>
                                    <input type="text" class="form-control" id="bank_name" name ="bank_name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="bank_account">IBAN/SWIFT</label>
                                    <input type="text" class="form-control" id="code" name ="code">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="bank_account">Cuenta</label>
                                    <input type="text" class="form-control" id="bank_account" name ="bank_account">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="account_name">Beneficiario</label>
                                    <input type="text" class="form-control" id="account_name" name ="account_name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <div class="col-6 col-md-3">
                                <a href="{{ route('panel.admin.accounts.index') }}" class="btn btn-outline-dark btn-block">Cancelar</a>
                            </div>
                            <div class="col-6 col-md-3">
                                <button class="btn btn-success btn-block">Crear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
