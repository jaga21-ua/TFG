@extends('welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name and Email -->
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="DNI" class="col-form-label">{{ __('DNI') }}</label>
                                <input id="DNI" type="text" class="form-control @error('DNI') is-invalid @enderror" name="DNI" value="{{ old('DNI') }}" required autocomplete="DNI">
                                @error('DNI')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password and Confirm Password -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- nombre and Apellidos -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="col-form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="Apellidos" class="col-form-label">{{ __('Apellidos') }}</label>
                                <input id="Apellidos" type="text" class="form-control @error('Apellidos') is-invalid @enderror" name="Apellidos" value="{{ old('Apellidos') }}" required autocomplete="Apellidos">
                                @error('Apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Telefono and Codigo Postal -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Telefono" class="col-form-label">{{ __('Telefono') }}</label>
                                <input id="Telefono" type="text" class="form-control @error('Telefono') is-invalid @enderror" name="Telefono" value="{{ old('Telefono') }}" required autocomplete="Telefono">
                                @error('Telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="Codigo_Postal" class="col-form-label">{{ __('Codigo Postal') }}</label>
                                <input id="Codigo_Postal" type="text" class="form-control @error('Codigo_Postal') is-invalid @enderror" name="Codigo_Postal" value="{{ old('Codigo_Postal') }}" required autocomplete="Codigo_Postal">
                                @error('Codigo_Postal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Comunidad Autónoma -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="comunidad" class="form-label">{{ __('Comunidad Autónoma') }}</label>
                                <select id="comunidad" class="form-select @error('comunidad') is-invalid @enderror" name="comunidad">
                                    <option value="">{{ __('Seleccione una Comunidad Autónoma') }}</option>
                                </select>
                                @error('comunidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Provincia and Ciudad -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="provincia" class="form-label">{{ __('Provincia') }}</label>
                                <select id="provincia" class="form-select @error('provincia') is-invalid @enderror" name="provincia" disabled>
                                    <option value="">{{ __('Seleccione una Provincia') }}</option>
                                </select>
                                @error('provincia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="ciudad" class="form-label">{{ __('Ciudad') }}</label>
                                <select id="ciudad" class="form-select @error('ciudad') is-invalid @enderror" name="ciudad" disabled>
                                    <option value="">{{ __('Seleccione una Ciudad') }}</option>
                                </select>
                                @error('ciudad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Edad and Sexo -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="edad" class="col-form-label">{{ __('Edad') }}</label>
                                <input id="edad" type="number" class="form-control @error('edad') is-invalid @enderror" name="edad" value="{{ old('edad') }}" required autocomplete="edad">
                                @error('edad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="sexo" class="col-form-label">{{ __('Sexo') }}</label>
                                <select id="sexo" class="form-select @error('sexo') is-invalid @enderror" name="sexo" required>
                                    <option value="">{{ __('Seleccione su Sexo') }}</option>
                                    <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>{{ __('Masculino') }}</option>
                                    <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>{{ __('Femenino') }}</option>
                                    <option value="Otro" {{ old('sexo') == 'Otro' ? 'selected' : '' }}>{{ __('Otro') }}</option>
                                </select>
                                @error('sexo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch('/locations.json')
        .then(response => response.json())
        .then(data => {
            let comunidadSelect = document.getElementById('comunidad');
            let provinciaSelect = document.getElementById('provincia');
            let ciudadSelect = document.getElementById('ciudad');

            data.forEach(comunidad => {
                let option = document.createElement('option');
                option.value = comunidad.label;
                option.text = comunidad.label;
                comunidadSelect.appendChild(option);
            });

            comunidadSelect.addEventListener('change', function () {
                let selectedComunidad = data.find(c => c.label === this.value);

                provinciaSelect.innerHTML = '<option value="">Seleccione una Provincia</option>';
                ciudadSelect.innerHTML = '<option value="">Seleccione una Ciudad</option>';
                provinciaSelect.disabled = !selectedComunidad;
                ciudadSelect.disabled = true;

                if (selectedComunidad) {
                    selectedComunidad.provinces.forEach(provincia => {
                        let option = document.createElement('option');
                        option.value = provincia.label;
                        option.text = provincia.label;
                        provinciaSelect.appendChild(option);
                    });
                }
            });

            provinciaSelect.addEventListener('change', function () {
                let selectedComunidad = data.find(c => c.label === comunidadSelect.value);
                let selectedProvincia = selectedComunidad.provinces.find(p => p.label === this.value);

                ciudadSelect.innerHTML = '<option value="">Seleccione una Ciudad</option>';
                ciudadSelect.disabled = !selectedProvincia;

                if (selectedProvincia) {
                    selectedProvincia.towns.forEach(ciudad => {
                        let option = document.createElement('option');
                        option.value = ciudad.label;
                        option.text = ciudad.label;
                        ciudadSelect.appendChild(option);
                    });
                }
            });
        });
});
</script>
@endsection
