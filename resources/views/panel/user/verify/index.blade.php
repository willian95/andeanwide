@extends('layouts.user_adminly')
@section('content')
<div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
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
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="my-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row ">
        <div class="col-xl-12 mb-xl-0">
            @if(is_null($user->identity))
                @include('panel.user.verify.includes.identity')
            @elseif(is_null($user->identity->verified_at))
                @include('panel.user.verify.includes.identityCompleted')
            @elseif(is_null($user->address))
                @include('panel.user.verify.includes.address')
            @elseif(is_null($user->account_verified_at))
                @include('panel.user.verify.includes.addressCompleted')
            @else
                @include('panel.user.verify.includes.verified')
            @endif
        </div>
    </div>
</div>

@endsection
