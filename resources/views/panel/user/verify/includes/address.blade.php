<div class="card shadow">
    <div class="card-header border-0">
        <h6 class="heading-small text-muted mb-4">Verificación de cuenta</h6>

        @error('image')
        <div class="alert alert-danger alert-dismissible fade show">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @enderror

        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-3">Residencia</h3>
            </div>
        </div>

        <create-address
            :user="{{ json_encode($user) }}"
            :countries="{{ json_encode($countries) }}"
            csrf="{{ csrf_token() }}"
            action="{{ route('panel.user.create_address') }}"
        />
    </div>
</div>
