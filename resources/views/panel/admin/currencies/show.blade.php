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
                        Divisa
                    </h1>
                    <h3 class="text-center text-white d-flex align-items-center justify-content-center">
                        <img src="https://www.countryflags.io/{{$currency->country->abbr}}/flat/32.png" class="mx-2">
                        {{ $currency->name }} / {{ $currency->symbol }}
                    </h3>
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
                            <h3 class="mb-0">Divisa - {{ $currency->name }} / {{ $currency->symbol }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" class="d-none" name="country_id" value="country_id">
                            <div class="form-group">
                                <label for="country_id">País</label>
                                <input type="text" class="form-control-plaintext pl-2" id="country_name" name ="country_name" value="{{ $currency->country->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control-plaintext pl-2" id="name" name ="name" value="{{ $currency->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="symbol">Simbolo</label>
                                <input type="text" class="form-control-plaintext pl-2" id="symbol" name ="symbol" value="{{ $currency->symbol }}" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="can_send" name="can_send" value="1" disabled {{ $currency->can_send == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="can_send">Se pueden hacer envios en esta divisa.</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="can_receive" name="can_receive" value="1" disabled {{ $currency->can_receive == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="can_receive">Se puede recibir dinero en esta divisa.</label>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-4">
                        <div class="col-6 col-md-3">
                            <a href="{{ route('panel.admin.currencies.index') }}" class="btn btn-outline-dark btn-block">Volver</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('panel.admin.currencies.edit', ['currency' => $currency->id]) }}" class="btn btn-success btn-block">Editar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
