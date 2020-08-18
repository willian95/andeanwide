@extends('layouts.adminloginly')

@section('content')
<div class="container mt-3   pb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card bg-secondary shadow border-0">

                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                        <div class="text-center">
                            <img class="mb-2 justify-content" src="/admin/img/brand/blue.png" alt="Andean Wide"
                                width="120px">
                        </div>
                        <h2 class="text-primary pt-4 text-uppercase text-bold">Crea tu cuenta</h2>
                    </div>
                    @if ($errors->any())
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<ul class="mb-0 text-bold">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif
                    <div id="register_app">
                        <register-form-component
                            action="{{ route('register') }}"
                            csrf_token="{{ csrf_token() }}"
                            :countries="{{ json_encode($countries) }}"
                        />
                    </div>

                    <div class="row ">
                        <div class="col-6 text-left">
                            <a href="/login"><small> <i class="fa fa-key"> </i> ¿Ya tienes
                                    cuenta?</small></a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="/" ><small> <i class="fa fa-home"> </i> Volver al inicio</small></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
