@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
	<div class="container-fluid">
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12">
					<h1 class="text-center text-white">Crear Nueva Divisa</h1> <br>

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
                            <h3 class="mb-0">Crear Divisa</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('panel.admin.currencies.store') }}" method="post" id="createForm">
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
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" id="name" name ="name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="symbol">Simbolo</label>
                                    <input type="text" class="form-control" id="symbol" name ="symbol">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="can_send" name="can_send" value="1" checked>
                                    <label class="form-check-label" for="can_send">Se pueden hacer envios en esta divisa.</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="can_receive" name="can_receive" value="1" checked>
                                    <label class="form-check-label" for="can_receive">Se puede recibir dinero en esta divisa.</label>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <div class="col-6 col-md-3">
                                <a href="{{ route('panel.admin.currencies.index') }}" class="btn btn-outline-dark btn-block">Cancelar</a>
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

<script>
    (function(){
        var countries = <?php echo json_encode($countries); ?>;
        document.querySelector('#country_id').addEventListener('change', function(e){
            var val = e.target.value;
            var index = countries.findIndex(function(country){
                return country.id == val;
            });
            if(index == -1){
                document.querySelector('#name').value = '';
                document.querySelector('#symbol').value = '';
            } else {
                document.querySelector('#name').value = countries[index].currency;
                document.querySelector('#symbol').value = countries[index].symbol;
            }
        });
    })()
</script>
@endsection
