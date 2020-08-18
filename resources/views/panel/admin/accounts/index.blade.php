@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Cuentas Bancarias</h1>
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
                        <div class="col d-flex justify-content-between">
                            <h3 class="mb-0">Cuentas Bancarias</h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('panel.admin.accounts.create') }}">Nueva Cuenta</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">País</th>
                                <th scope="col">Divisa</th>
                                <th scope="col">Banco</th>
                                <th scope="col">Cuenta</th>
                                <th scope="col">Beneficiario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accounts as $account)
                                <tr class="text-center">
                                    <td class="text-left">
                                        <img src="https://www.countryflags.io/{{$account->country->abbr}}/flat/32.png">
                                        <span class="mx-1"></span>
                                        {{ $account->country->name }}
                                    </td>
                                    <td>
                                        {{ $account->currency->symbol }} - {{ $account->currency->name }}
                                    </td>
                                    <td>
                                        <a href="{{ route('panel.admin.accounts.show', ['account' => $account->id]) }}">
                                            {{ $account->bank_name }} / {{ $account->code }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('panel.admin.accounts.show', ['account' => $account->id]) }}">
                                            {{ $account->bank_account }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('panel.admin.accounts.show', ['account' => $account->id]) }}">
                                            {{ $account->account_name }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-4">
                    {{ $accounts->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
