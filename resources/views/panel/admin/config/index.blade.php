@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Configuración</h1>
                </div>
            </div>
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
<div class="container-fluid mt--7">
    <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow" style="min-height:350px">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col d-flex justify-content-between">
                            <h3 class="mb-0">Configuración</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Parámetros</h6>
                    <form action="{{ route('panel.admin.config.update') }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="transactionCostPct" class="col-sm-3 col-form-label">
                                Cargo por transacción:
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="transactionCostPct" id="transactionCostPct" value="{{ number_format($params->transactionCostPct, 2) }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="transactionCostPct" class="col-sm-3 col-form-label">
                                Impuestos:
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="taxPct" id="taxPct" value="{{ number_format($params->taxPct, 2) }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-5">
                            <button type="submit" class="btn btn-success">
                                Actualizar
                            </button>
                        </div>
                    </form>
                    <hr class="mt-6">
                    <div class="d-flex justify-content-between align-items-center mt-5 mb-4">
                        <h6 class="heading-small text-muted">Prioridades</h6>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNewPriorityModal">
                            <i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>
                            Agregar Prioridad
                        </button>
                    </div>
                    @foreach($priorities as $priority)
                        <div class="card my-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="card-title my-0">
                                        Prioridad: {{ $priority->label }}
                                    </h5>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editPriorityModal_{{$priority->id}}">
                                        Editar
                                    </button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="editPriorityModal_{{$priority->id}}" tabindex="-1" role="dialog" aria-labelledby="editPriorityLabel_{{$priority->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('panel.admin.config.updatePriority', ['priority' => $priority->id]) }}" method="POST" novalidate>
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="editPriorityLabel_{{$priority->id}}">Agregar nueva prioridad</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group row">
                                                        <label for="name" class="col-sm-3 col-form-label">
                                                            Nombre:
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control-plaintext" name="name" id="name" value="{{ $priority->name}}" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="label" class="col-sm-3 col-form-label">
                                                            Etiqueta:
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="label" id="label" value="{{ $priority->label}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="sublabel" class="col-sm-3 col-form-label">
                                                            Sub etiqueta:
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="sublabel" id="sublabel" value="{{ $priority->sublabel}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="description" class="col-sm-3 col-form-label">
                                                            Descripción:
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="description" id="description" value="{{ $priority->description}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="costPct" class="col-sm-3 col-form-label">
                                                            Costo:
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" name="costPct" id="costPct" value="{{ number_format($priority->costPct, 2) }}">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-danger" onclick="if(confirm('Desea eliminar esta prioridad?')){document.querySelector('#delete_{{ $priority->id }}').submit()}">Eliminar</button>
                                                    <div>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <form id="delete_{{ $priority->id }}" action="{{ route('panel.admin.config.destroyPriority', ['priority' => $priority->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Edit Modal -->

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">
                                        Etiqueta:
                                    </label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control-plaintext" value="{{ $priority->label }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">
                                        Sub etiqueta:
                                    </label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control-plaintext" value="{{ $priority->sublabel }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">
                                        Descripción:
                                    </label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control-plaintext" value="{{ $priority->description }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">
                                        Costo:
                                    </label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control-plaintext" value="{{ number_format($priority->costPct, 2) }} %" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Create Priority Modal -->
<div class="modal fade" id="addNewPriorityModal" tabindex="-1" role="dialog" aria-labelledby="addNewPriorityLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('panel.admin.config.storePriority') }}" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title" id="addNewPriorityLabel">Agregar nueva prioridad</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">
                            Nombre:
                        </label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="label" class="col-sm-3 col-form-label">
                            Etiqueta:
                        </label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="label" id="label">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sublabel" class="col-sm-3 col-form-label">
                            Sub etiqueta:
                        </label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="sublabel" id="sublabel">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">
                            Descripción:
                        </label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="description" id="description">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="costPct" class="col-sm-3 col-form-label">
                            Costo:
                        </label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="number" class="form-control" name="costPct" id="costPct">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
