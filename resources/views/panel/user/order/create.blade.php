@extends('layouts.user_adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
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
				<div class="card-body">
                    @if(is_null($order ?? null))
                        @include('panel.user.includes.order.amount')
                    @elseif(is_null($order->recipient))
                        @include('panel.user.includes.order.recipient')
                    @else
                        @include('panel.user.includes.order.verification')
                    @endif
                </div>
            </div>
		</div>
    </div>
</div>
@endsection
