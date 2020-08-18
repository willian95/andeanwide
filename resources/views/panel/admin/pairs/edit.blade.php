@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
	<div class="container-fluid">
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12">
                    <h1 class="text-center text-white">Editar</h1> 
                    <h3 class="text-center text-white">{{ $symbol->name }}</h3>
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
                            <h3 class="mb-0">Editar Par de Divisa {{ $symbol->name }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('panel.admin.symbols.update', ['symbol' => $symbol->id]) }}" method="post" id="createForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <input type="text" class="d-none" name="base_cur_id" id="base_cur_id" value="{{ $symbol->base->id }}">
                                <div class="form-group">
                                    <label for="base_cur_id">Divisa Base</label>
                                    <input type="text" class="form-control-plaintext pl-2" id="base_cur" value="{{ $symbol->base->symbol }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="text" class="d-none" name="quote_cur_id" id="quote_cur_id" value="{{ $symbol->quote->id }}">
                                <div class="form-group">
                                    <label for="quote_cur_id">Divisa Cotizada</label>
                                    <input type="text" class="form-control-plaintext pl-2" id="quote_cur" value="{{ $symbol->quote->symbol }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="text" class="d-none" name="name" value="{{ $symbol->name }}">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control-plaintext pl-2" id="name" value="{{ $symbol->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
								<div class="form-group">
									<label for="api_class">API</label>
									<select name="api_class" id="api_class" class="form-control">
                                        @foreach($apis as $api)
										<option value="{{ $api }}" {{ $symbol->api_class == '$api' ? 'selected' : '' }}>{{ $api }}</option>
                                        @endforeach
									</select>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label for="spread_by">Tipo de Diferencial</label>
									<select name="spread_by" id="spread_by" class="form-control">
										<option value="point" {{ $symbol->spread_by == 'point' ? 'selected' : '' }}>Por Puntos</option>
										<option value="percentage" {{ $symbol->spread_by == 'percentage' ? 'selected' : '' }}>Por Porcentaje</option>
									</select>
								</div>
							</div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="spread_value">Diferencial</label>
                                    <input type="number" class="form-control" id="spread_value" name ="spread_value" value="{{ $symbol->spread_value }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="offset">Compensación (En Puntos)</label>
                                    <input type="number" class="form-control" id="offset" name ="offset" value="{{ $symbol->offset }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="min_pip_value">Valor minimo de cambio (En Punto)</label>
                                <select name="min_pip_value" id="min_pip_value" class="form-control">
                                    <option value="10" {{ $symbol->min_pip_value == 10 ? 'selected' : null }}>10</option>
                                    <option value="1" {{ $symbol->min_pip_value == 1 ? 'selected' : null }}>1</option>
                                    <option value="0.1" {{ $symbol->min_pip_value == 0.1 ? 'selected' : null }}>0.1</option>
                                    <option value="0.01" {{ $symbol->min_pip_value == 0.01 ? 'selected' : null }}>0.01</option>
                                    <option value="0.001" {{ $symbol->min_pip_value == 0.001 ? 'selected' : null }}>0.001</option>
                                    <option value="0.0001" {{ $symbol->min_pip_value == 0.0001 ? 'selected' : null }}>0.0001</option>
                                    <option value="0.00001" {{ $symbol->min_pip_value == 0.00001 ? 'selected' : null }}>0.00001</option>
                                </select>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="row justify-content-center">
                                    <div class="col-4">
                                        <button class="btn btn-warning btn-block" type="button" data-toggle="modal" data-target="#apiTestModal">Probar API</button>
                                    </div>
                                </div>
                            </div>
							<div class="col-12 mt-3">
								<div class="form-group">
									<label for="observation">Observaciones</label>
									<textarea name="observation" id="observation" rows="3" class="form-control">{{ $symbol->observation }}</textarea>
                                </div>
							</div>
							<div class="col-12">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ $symbol->is_active == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">El Par es activo.</label>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <div class="col-6 col-md-3">
                                <a href="{{ route('panel.admin.symbols.show', ['symbol' => $symbol->id]) }}" class="btn btn-outline-dark btn-block">Cancelar</a>
                            </div>
                            <div class="col-6 col-md-3">
                                <button type="submit" class="btn btn-success btn-block">Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="apiTestModal" tabindex="-1" role="dialog" aria-labelledby="apiTestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="apiTestModalLabel">Prueba de API</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row d-none" id="errorTest">
                    <div class="alert alert-danger w-100 mx-2">
                        Información incompleta, verifique la misma e intente realizar la prueba de nuevo.
                    </div>
                </div>
                <div class="row d-none" id="noResultTest">
                    <div class="alert alert-warning w-100 mx-2">
                        Este API no es compatible con el par que desea crear.
                    </div>
                </div>
                <div class="row d-none" id="successTest">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="api_rate">Valor del API</label>
                            <input type="number" class="form-control-plaintext pl-2" id="api_rate" disabled>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="bid">Valor de Compra</label>
                            <input type="number" class="form-control-plaintext pl-2" id="bid" disabled>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="ask">Valor de Venta</label>
                            <input type="number" class="form-control-plaintext pl-2" id="ask" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal" id="cancelButton">Salir</button>
                <button type="button" class="btn btn-primary" id="testButton">Realizar Prueba</button>
            </div>
        </div>
    </div>
</div>

<script>
	(function(){

        document.querySelector('#testButton').addEventListener('click', function(e){
            hideTestResults();
			var base = document.querySelector('#base_cur').value;
			var quoted = document.querySelector('#quote_cur').value;

            if(base && quoted){
                $.ajax({
                    url: "/exchange_rate/" + base + "/" + quoted + "/test",
                    method: 'POST',
                    dataType: "json",
                    data: {
                        name: document.querySelector('#name').value,
                        api_class: document.querySelector('#api_class').value,
                        base_cur_id: document.querySelector('#base_cur_id').value,
                        quote_cur_id: document.querySelector('#quote_cur_id').value,
                        spread_by: document.querySelector('#spread_by').value,
                        spread_value: document.querySelector('#spread_value').value,
                        offset: document.querySelector('#offset').value,
                        min_pip_value: document.querySelector('#min_pip_value').value,
                        _token: document.querySelector('[name="_token"]').value
                    },
                    success: function(data){
                        if(data.api_rate){
                            document.querySelector('#api_rate').value = data.api_rate;
                            document.querySelector('#bid').value = data.bid;
                            document.querySelector('#ask').value = data.ask;
                            document.querySelector('#successTest').classList.remove('d-none');
                        } else {
                            document.querySelector('#noResultTest').classList.remove('d-none');
                        }
                    },
                    error: function(data){
                        document.querySelector('#errorTest').classList.remove('d-none');
                    }
                });
            } else {
                alert('Debes seleccionar el par de divisas para continuar.');
            }
        });

        var hideTestResults = function() {
            document.querySelector('#errorTest').classList.add('d-none');
            document.querySelector('#noResultTest').classList.add('d-none');
            document.querySelector('#successTest').classList.add('d-none');
        }

        document.querySelector('#cancelButton').addEventListener('click', function(e){
            hideTestResults();
        });

        document.querySelector('button.close').addEventListener('click', function(e){
            hideTestResults();
        });

	})();
</script>

@endsection
