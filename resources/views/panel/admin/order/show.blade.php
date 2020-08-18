@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
	<div class="container-fluid">
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12">
                    <h1 class="text-center text-white">Orden - No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }}</h1>
                    <p class="text-center text-white my-0">Usuario: {{ $order->user->name }} {{ $order->user->lastname }}</p>
                    <p class="text-center text-white my-0">Email: {{ $order->user->email }}</p>
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
                <div class="card-body">
                    <show-order
                        :order="{{ json_encode($order) }}"
                        :recipient="{{ json_encode($order->recipient) }}"
                        csrf="{{ csrf_token() }}"
                        verify-route="{{ route('panel.admin.orders.verify_order', ['order' => $order->id]) }}"
                        reject-route="{{ route('panel.admin.orders.reject_order', ['order' => $order->id]) }}"
                        complete-route="{{ route('panel.admin.orders.complete_order', ['order' => $order->id]) }}"
                    />
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
