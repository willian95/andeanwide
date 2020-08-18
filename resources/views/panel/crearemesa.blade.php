@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
	<div class="container-fluid">
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12">
					<h1 class="text-center text-white">Crear Remesa</h1> <br>

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
					<!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
						<span class="alert-icon"><i class="ni ni-bell-55"></i></span>
						<span class="alert-text"> <strong>Prioridad Alta:</strong> Colombia solo disponible para cuentas destinos en los bancos: <strong>Bancolombia y Banco de Bogota.</strong> </span>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div> -->
    			</div>
            </div>
		</div>
	</div>
</div>

<!-- Page content -->
@if(is_null($order))
	@include('panel.enviar.monto')
@elseif(is_null($order->recipient))
	@include('panel.enviar.beneficiario')
@elseif(is_null($order->completed_at))
	@include('panel.enviar.revision')
@else
	@include('panel.enviar.pago')
@endif

@endsection
