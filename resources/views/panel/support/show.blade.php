@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
	<div class="container-fluid">
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12">
                    <h1 class="text-center text-white">Ticket No. {{ str_pad($ticket->id, 6, '0', STR_PAD_LEFT) }}</h1>
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
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="title">Titulo</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $ticket->title }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="category">Categoria</label>
                                <input type="text" class="form-control" id="category" name="category" value="{{ $ticket->category }}" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="content">Mensaje</label>
                                <textarea class="form-control" id="content" name="content" rows="5" readonly>{{ $ticket->content }}</textarea>
                            </div>
                        </div>
                        @if(isset($ticket->response))
                        <div class="col-12">
                            <div class="form-group">
                                <label for="content">Respuesta</label>
                                <textarea class="form-control" id="response" name="response" rows="5" readonly>{{ $ticket->response }}</textarea>
                            </div>
                        </div>
                        @endif
                        @if(isset($ticket->image_url))
                        <div class="col-8">
                            <img src="{{ $ticket->image_url }}" alt="image" class="rounded mx-auto d-block">
                        </div>
                        @endif
                        <div class="col-12 col-md-6 mt-4">
                            <a href="{{ route('panel.support.index') }}" class="btn btn-btn-outline-info btn-block">
                                Salir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
