@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Lista de Usuarios</h1>
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
                    </div>
                </div>
                <div class=" pl-3 pr-3 pb-3 table-responsive">
                    <!-- Projects table -->
                    <table table class=" table-striped table align-items-center table-flush" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">Nombres</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">País</th>
                                <th scope="col" class="text-center">Nivel</th>
                                <th scope="col" class="text-center">Email Verificado</th>
                                <th scope="col" class="text-center">D. Identidad</th>
                                <th scope="col" class="text-center">D. Residencia</th>
                                <th scope="col" class="text-center">Pendiente Verificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th class="text-center">
                                    @if(isset($user->name) && isset($user->lastname))
                                    <a href="{{ route('panel.admin.users.show', $user->id) }}">
                                        {{ $user->name }} {{ $user->lastname }}
                                    </a>
                                    @else
                                    S/N
                                    @endif
                                </th>
                                <th scope="row" class="text-center">
                                    <a href="{{ route('panel.admin.users.show', $user->id) }}">
                                        {{ $user->email }}
                                    </a>
                                </th>
                                <td class="text-center">
                                    {{ $user->country->name }}
                                </td>
                                <td class="text-center">{{ $user->verificationLevel }}</td>
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
                                    @if(is_null($user->identity))
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
                                    @if(is_null($user->address))
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
                                    @if($user->hasPendingApprovalLevel)
                                        <div class="badge badge-danger text-wrap" style="width: 4rem;">
                                            Si
                                        </div>
                                    @else
                                        <div class="badge badge-success text-wrap" style="width: 4rem;">
                                            No
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                 @if(isset($users->links))
                    <div class="card">
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            {{ $users->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
