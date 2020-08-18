@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Lista de usuario</h1>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">

    <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Usuarios</h3>
                        </div>
                        {{-- <div class="col text-right">
                            <a href="{{ route('panel.crearagente') }}" class="btn btn-sm btn-danger">Por verificar</a>
                    </div> --}}
                </div>
            </div>
            <div class=" pl-3 pr-3 pb-3 table-responsive">
                <!-- Projects table -->
                <table table id="example"  class=" table-striped table align-items-center table-flush" style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="text-center">Nombres</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col" class="text-center">País</th>
                            <th scope="col" class="text-center">Email Verificado</th>
                            <th scope="col" class="text-center">Docs. Completados</th>
                            <th scope="col" class="text-center">Cuenta Verificada</th>
                            <th scope="col" class="text-center">Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th>
                                {{ $user->name }} {{ $user->lastname }}
                            </th>
                            <th scope="row" class="text-center">
                                {{ $user->email }}
                            </th>
                            <td class="text-center">
                                {{ $user->country }}
                            </td>
                            <td class="text-center">
                                @if(is_null($user->email_verified_at))
                                    <div class="badge badge-danger text-wrap" style="width: 4rem;">
                                        No
                                    </div>
                                @else
                                    <div class="badge badge-success text-wrap" style="width: 4rem;">
                                        Si
                                    </div>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($user->is_completed == false)
                                    <div class="badge badge-danger text-wrap" style="width: 4rem;">
                                        No
                                    </div>
                                @else
                                    <div class="badge badge-success text-wrap" style="width: 4rem;">
                                        Si
                                    </div>
                                @endif
                            </td>
                            <td class="text-center">
                                @if(is_null($user->account_verified_at))
                                    <div class="badge badge-danger text-wrap" style="width: 4rem;">
                                        No
                                    </div>
                                @else
                                    <div class="badge badge-success text-wrap" style="width: 4rem;">
                                        Si
                                    </div>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('panel.editarusuario', $user->id) }}" class="btn btn-primary">Ver</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
