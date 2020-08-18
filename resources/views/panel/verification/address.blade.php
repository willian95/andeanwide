<div class="card shadow">
    <div class="card-header border-0">
        <h6 class="heading-small text-muted mb-4">Verificación de cuenta</h6>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
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

        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-3">Residencia</h3>
            </div>
        </div>

        <form method="POST" action="{{ route('panel.user.create_address') }}" enctype="multipart/form-data">
            @csrf
            <input type="text" name="user_id" class="d-none" value="{{ $user->id }}">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="county_id">País</label>
                        <select class="custom-select" id="county_id" name="country_id" required>
                            <option selected disabled value="">Selecciona un país</option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <div class="invalid-feedback">Este campo es obligatorio</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="state">Estado/Región/Provincia</label>
                        <input type="text" class="form-control is-invalid" id="state" aria-describedby="state" name="state" placeholder="Estado/Región/Provincia" value="{{ old('state') }}" required>
                        @error('state')
                            <div class="invalid-feedback">Este campo es obligatorio</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="city">Ciudad</label>
                        <input type="text" class="form-control is-invalid" id="city" aria-describedby="city" name="city" placeholder="Ciudad" value="{{ old('city') }}" required>
                        @error('city')
                            <div class="invalid-feedback">Este campo es obligatorio</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="cod">Código postal</label>
                        <input type="text" class="form-control is-invalid" id="cod" aria-describedby="cod" name="cod" placeholder="Código postal" value="{{ old('cod') }}" required>
                        @error('cod')
                            <div class="invalid-feedback">Este campo es obligatorio</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control is-invalid" id="address" aria-describedby="Address" name="address" placeholder="Dirección" value="{{ old('address') }}" required>
                        @error('address')
                            <div class="invalid-feedback">Este campo es obligatorio</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="address_ext">Dirección (continuación)</label>
                        <input type="text" class="form-control is-invalid" id="address_ext" aria-describedby="Address continued" name="address_ext" placeholder="Dirección (opcional)" value="{{ old('address_ext') }}">
                        @error('address_ext')
                            <div class="invalid-feedback">Este campo es obligatorio</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="image">Prueba de residencia</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                </div>
            </div>
        </form>


    </div>
</div>
