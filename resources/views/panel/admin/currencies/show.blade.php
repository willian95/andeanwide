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

    <show-currency
        action="{{ route('panel.admin.currencies.update', ['currency' => $currency->id]) }}"
        index-route="{{ route('panel.admin.currencies.index') }}"
        csrf_token="{{ csrf_token() }}"
        :countries="{{ json_encode($countries) }}"
        :currency = "{{ json_encode($currency) }}"
    />
    
</div>

@endsection
