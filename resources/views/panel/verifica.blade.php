@extends('layouts.adminly')
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-white">Verificación de cuenta</h1>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row ">
        <div class="col-xl-12 mb-xl-0">
            @if(is_null($user->identity))
                @include('panel.verification.identity')
            @elseif(is_null($user->address))
                @include('panel.verification.address')
            @elseif(is_null($user->account_verified_at))
                @include('panel.verification.completed')
            @else
                @include('panel.verification.verified')
            @endif
        </div>
    </div>
</div>

@endsection
