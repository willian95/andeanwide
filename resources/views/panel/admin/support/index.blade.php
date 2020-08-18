@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Soporte</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">

    <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow" style="min-height:350px">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Soporte</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">ID</th>
                                <th scope="col">F. Creación</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                                <tr class="text-center">
                                    <th>
                                        <a href="{{ route('panel.admin.support.show', ['ticket' => $ticket->id]) }}">
                                            {{ str_pad($ticket->id, 6, '0', STR_PAD_LEFT) }}
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('panel.admin.support.show', ['ticket' => $ticket->id]) }}">
                                            {{ $ticket->title }}
                                        </a>
                                    </th>
                                    <td>{{ (new Carbon\Carbon($ticket->created_at))->format('d/m/Y h:m') }}</td>
                                    <td>
                                        @if(is_null($ticket->received_at))
                                            <span class="badge badge-danger">Enviado</span>
                                        @elseif($ticket->received_at && is_null($ticket->closed_at))
                                            <span class="badge badge-warning">En proceso</span>
                                        @elseif($ticket->closed_at)
                                            <span class="badge badge-success">Cerrado</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-4">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
