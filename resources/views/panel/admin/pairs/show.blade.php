@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
	<div class="container-fluid">
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12">
					<h1 class="text-center text-white text-uppercase">Par de Divisa</h1>
					<h3 class="text-center text-white">{{ $symbol->name }}</h3> <br>

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
    <show-symbol
        :symbol="{{ json_encode($symbol) }}"
        :apis="{{ json_encode($apis) }}"
        action="{{ route('panel.admin.symbols.show', ['symbol' => $symbol->id]) }}"
        index-route="{{ route('panel.admin.symbols.index') }}"
    />
</div>

@endsection
