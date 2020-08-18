@extends('layouts.adminly')
@section('content')
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
	<div class="container-fluid">
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-md-12">
                    <h1 class="text-center text-white">Crear Ticket</h1>
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
                    <form action="{{ route('panel.support.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="title">Titulo*</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="category">Categoria*</label>
                                    <select class="form-control" id="category" name="category">
                                        <option value="" selected disabled>Selecciona una categoría</option>
                                        <option value="Consulta">Consulta</option>
                                        <option value="Recomendación">Recomendación</option>
                                        <option value="Solicitud">Solicitud</option>
                                        <option value="Reclamo">Reclamo</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="content">Mensaje*</label>
                                    <textarea class="form-control" id="content" name="content" rows="5">{{ old('content') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="image">Agregar Imagen (opcional)</label>
                                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mt-4">
                                <a href="{{ route('panel.support.index') }}" class="btn btn-btn-outline-light btn-block">
                                    Salir
                                </a>
                            </div>
                            <div class="col-12 col-md-4 mt-4">
                                <button type="submit" class="btn btn-success btn-block">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
