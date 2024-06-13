@extends('welcome')
@section('content')
<form id="editForm" enctype="multipart/form-data" method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- Primera columna -->
        <div class="col-md-6">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Nombre:</strong>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                </li>
                <li class="list-group-item">
                    <strong>Email:</strong>
                    <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                </li>
                <li class="list-group-item">
                    <strong>DNI:</strong>
                    <input type="text" class="form-control" name="dni" value="{{ $user->dni }}">
                </li>
                <li class="list-group-item">
                    <strong>Apellidos:</strong>
                    <input type="text" class="form-control" name="apellidos" value="{{ $user->apellidos }}">
                </li>
                <li class="list-group-item">
                    <strong>Teléfono:</strong>
                    <input type="text" class="form-control" name="telefono" value="{{ $user->telefono }}">
                </li>
                <li class="list-group-item">
                    <strong>Código Postal:</strong>
                    <input type="text" class="form-control" name="codigoPostal" value="{{ $user->codigoPostal }}">
                </li>
                <li class="list-group-item">
                    <strong>Cambiar contraseña:</strong>
                    <input type="password" class="form-control" name="password">
                </li>
            </ul>
        </div>
        
        <!-- Segunda columna -->
        <div class="col-md-6">
            <ul class="list-group list-group-flush">
                
                <li class="list-group-item">
                    <div class="mb-3">
                        <label for="comunidad" class="form-label">Comunidad Autónoma</label>
                        <select id="comunidad" class="form-select @error('comunidad') is-invalid @enderror" name="comunidad">
                            <option selected value="{{$user->comunidad}}">{{$user->comunidad}}</option>
                        </select>
                        @error('comunidad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="mb-3">
                        <label for="provincia" class="form-label">Provincia</label>
                        <select id="provincia" class="form-select @error('provincia') is-invalid @enderror" name="provincia" disabled>
                            <option selected value="{{$user->provincia}}">{{$user->provincia}}</option>
                        </select>
                        @error('provincia')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="mb-3">
                        <label for="ciudad" class="form-label">Ciudad</label>
                        <select id="ciudad" class="form-select @error('ciudad') is-invalid @enderror" name="ciudad" disabled>
                            <option selected value="{{$user->ciudad}}">{{$user->ciudad}}</option>
                        </select>
                        @error('ciudad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  
                </li>
                <li class="list-group-item">
                    <strong>Edad:</strong>
                    <input type="text" class="form-control" name="edad" value="{{ $user->edad }}">
                </li>
                <li class="list-group-item">
                    <strong>Sexo:</strong>
                    <input type="text" class="form-control" name="sexo" value="{{ $user->sexo }}">
                </li>
                <li class="list-group-item">
                    <strong>Repite Nueva contraseña:</strong>
                    <input type="password" class="form-control" name="Rpassword">
                </li>
            </ul>
        </div>
    </div>

    <!-- Botones fuera de las columnas -->
    <button type="submit" class="btn btn-primary" id="saveChanges">Guardar Cambios</button>
    <a class="btn btn-info" href="/users" id="SeeData">Volver a Usuarios</a>
</form>
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
        document.getElementById('editButton').addEventListener('click', function () {
            // Mostrar el formulario de edición y ocultar la información estática
            document.getElementById('infoSection').style.display = 'none';
            document.getElementById('editForm').style.display = 'block';
        });
        document.getElementById('SeeData').addEventListener('click', function () {
            // Mostrar el formulario de edición y ocultar la información estática
            document.getElementById('editForm').style.display = 'none';
            document.getElementById('infoSection').style.display = 'block';
        });
    });
</script>

@endsection