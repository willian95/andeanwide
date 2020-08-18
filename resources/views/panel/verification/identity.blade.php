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
                <h3 class="mb-3">Identificación</h3>
            </div>
        </div>

        <form method="POST" action="{{ route('panel.user.create_identity') }}" enctype="multipart/form-data">
            @csrf
            <input type="text" name="user_id" class="d-none" value="{{ $user->id }}">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="county_id">País emisor del documento</label>
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
                        <label for="nationality">Nacionalidad</label>
                        <input type="text" class="form-control" id="nationality" aria-describedby="nationality" name="nationality" placeholder="Nacionalidad" value="{{ old('nationality') }}" required>
                        @error('nationality')
                            <div class="invalid-feedback">Este campo es obligatorio</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="document_type">Tipo de documento</label>
                        <select class="custom-select" id="document_type" name="document_type" required>
                            <option selected disabled value="">Selecciona un tipo de documento</option>
                            <option value="dni">Documento de ídentidad</option>
                            <option value="passport">Pasaporte</option>
                            <option value="driver_license">Licencia de conducir</option>
                        </select>
                        @error('document_type')
                            <div class="invalid-feedback">Este campo es obligatorio</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="gender">Género</label>
                        <select class="custom-select" id="gender" name="gender" required>
                            <option selected disabled value="">Selecciona un género</option>
                            <option value="F">Femenino</option>
                            <option value="M">Masculino</option>
                            <option value="Unknown">Desconocido</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">Este campo es obligatorio</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="dni_number">Número de documento</label>
                        <input type="text" class="form-control is-invalid" id="dni_number" aria-describedby="document number" name="dni_number" placeholder="Número de documento" value="{{ old('dni_number') }}" required>
                        @error('dni_number')
                            <div class="invalid-feedback">Este campo es obligatorio</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="validation_number">Número de validación</label>
                        <input type="text" class="form-control is-invalid" id="validation_number" aria-describedby="validation number" name="validation_number" placeholder="Número de validación" value="{{ old('validation_number') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="issue_date">Fecha de emisión</label>
                        <input type="text" class="form-control is-invalid" id="issue_date" aria-describedby="issue date" name="issue_date" placeholder="mes/día/año" value="{{ old('issue_date') }}" required>
                        @error('issue_date')
                            <div class="invalid-feedback">Este campo es obligatorio</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="expiration_date">Fecha de vencimiento</label>
                        <input type="text" class="form-control is-invalid" id="expiration_date" aria-describedby="expiration date" name="expiration_date" placeholder="mes/día/año" value="{{ old('expiration_date') }}" required>
                        @error('expiration_date')
                            <div class="invalid-feedback">Este campo es obligatorio</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="dob">Fecha de nacimiento</label>
                        <input type="text" class="form-control is-invalid" id="dob" aria-describedby="dob date" name="dob" placeholder="mes/día/año" value="{{ old('dob') }}" required>
                        @error('dob')
                            <div class="invalid-feedback">Este campo es obligatorio</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="first_name">Primer Nombre</label>
                        <input type="text" class="form-control is-invalid" id="first_name" aria-describedby="first name" name="first_name" placeholder="Primer Nombre" value="{{ old('first_name') }}" required>
                        @error('first_name')
                            <div class="invalid-feedback">Este campo es obligatorio</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="middle_name">Segundo Nombre</label>
                        <input type="text" class="form-control is-invalid" id="middle_name" aria-describedby="middle name" name="middle_name" placeholder="Segundo Nombre" value="{{ old('middle_name') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="last_name">Primer Apellido</label>
                        <input type="text" class="form-control is-invalid" id="last_name" aria-describedby="last name" name="last_name" placeholder="Primer Apellido" value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <div class="invalid-feedback">Este campo es obligatorio</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="second_surname">Segundo Apellido</label>
                        <input type="text" class="form-control is-invalid" id="second_surname" aria-describedby="second surname name" name="second_surname" placeholder="Segundo Apellido" value="{{ old('second_surname') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="front_image">Imagen del documento - Frente</label>
                        <input type="file" class="form-control-file" id="front_image" name="front_image" accept="image/*" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="back_image">Imagen del documento - Reverso</label>
                        <input type="file" class="form-control-file" id="back_image" name="back_image" accept="image/*">
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