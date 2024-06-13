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
                    <strong>Ciudad:</strong>
                    <input type="text" class="form-control" name="ciudad" value="{{ $user->ciudad }}">
                </li>
            </ul>
        </div>
        
        <!-- Segunda columna -->
        <div class="col-md-6">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Código Postal:</strong>
                    <input type="text" class="form-control" name="codigoPostal" value="{{ $user->codigoPostal }}">
                </li>
                <li class="list-group-item">
                    <strong>Provincia:</strong>
                    <input type="text" class="form-control" name="provincia" value="{{ $user->provincia }}">
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
                    <strong>Cambiar contraseña:</strong>
                    <input type="password" class="form-control" name="password">
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
        // Cargar comunidades autónomas
        fetch('https://spainsapi.com/api/v1/communities')
            .then(response => response.json())
            .then(data => {
                let comunidadSelect = document.getElementById('comunidad');
                data.forEach(comunidad => {
                    let option = document.createElement('option');
                    option.value = comunidad.id;
                    option.text = comunidad.name;
                    comunidadSelect.appendChild(option);
                });
            });
    
        // Cargar provincias cuando se seleccione una comunidad autónoma
        document.getElementById('comunidad').addEventListener('change', function () {
            let comunidadId = this.value;
            fetch(`https://spainsapi.com/api/v1/communities/${comunidadId}/provinces`)
                .then(response => response.json())
                .then(data => {
                    let provinciaSelect = document.getElementById('provincia');
                    provinciaSelect.innerHTML = '<option value="">Seleccione una Provincia</option>';
                    data.forEach(provincia => {
                        let option = document.createElement('option');
                        option.value = provincia.id;
                        option.text = provincia.name;
                        provinciaSelect.appendChild(option);
                    });
                });
        });
    
        // Cargar ciudades cuando se seleccione una provincia
        document.getElementById('provincia').addEventListener('change', function () {
            let provinciaId = this.value;
            fetch(`https://spainsapi.com/api/v1/provinces/${provinciaId}/cities`)
                .then(response => response.json())
                .then(data => {
                    let ciudadSelect = document.getElementById('ciudad');
                    ciudadSelect.innerHTML = '<option value="">Seleccione una Ciudad</option>';
                    data.forEach(ciudad => {
                        let option = document.createElement('option');
                        option.value = ciudad.id;
                        option.text = ciudad.name;
                        ciudadSelect.appendChild(option);
                    });
                });
        });
    });
</script>

@endsection