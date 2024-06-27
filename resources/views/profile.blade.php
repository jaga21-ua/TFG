@extends('welcome')

@section('content')

<div class="container mt-5">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    {{-- Mensajes de error --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" >Información del Usuario</h5>
                    <div id="infoSection">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Nombre:</strong> {{ auth()->user()->name }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ auth()->user()->email }}</li>
                            <li class="list-group-item"><strong>DNI:</strong> {{ auth()->user()->dni }}</li>
                            <li class="list-group-item"><strong>Apellidos:</strong> {{ auth()->user()->apellidos }}</li>
                            <li class="list-group-item"><strong>Teléfono:</strong> {{ auth()->user()->telefono }}</li>
                            <li class="list-group-item"><strong>Código Postal:</strong> {{ auth()->user()->codigoPostal }}</li>
                            <li class="list-group-item"><strong>Edad:</strong> {{ auth()->user()->edad }}</li>
                            <li class="list-group-item"><strong>Sexo:</strong> {{ auth()->user()->sexo }}</li>
                            <li class="list-group-item"><strong>Comunidad Autónoma:</strong> {{ auth()->user()->comunidad }}</li>
                            <li class="list-group-item"><strong>Provincia:</strong> {{ auth()->user()->provincia }}</li>
                            <li class="list-group-item"><strong>Ciudad:</strong> {{ auth()->user()->ciudad }}</li>
                            <li class="list-group-item"><strong>Es Administrador:</strong> {{ auth()->user()->esAdmin ? 'Sí' : 'No' }}</li>
                        </ul>
                        <div>
                            <a class="btn btn-info" id="editButton">Editar Información</a>
                        </div>
                    </div>
                </div>
            </div>
            <form id="editForm" enctype="multipart/form-data" method="POST" action="{{ route('profile.update') }}" style="display: none;">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Primera columna -->
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Nombre:</strong>
                                <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                            </li>
                            <li class="list-group-item">
                                <strong>Email:</strong>
                                <input type="text" class="form-control" name="email" value="{{ auth()->user()->email }}">
                            </li>
                            <li class="list-group-item">
                                <strong>DNI:</strong>
                                <input type="text" class="form-control" name="dni" value="{{ auth()->user()->dni }}">
                            </li>
                            <li class="list-group-item">
                                <strong>Apellidos:</strong>
                                <input type="text" class="form-control" name="apellidos" value="{{ auth()->user()->apellidos }}">
                            </li>
                            <li class="list-group-item">
                                <strong>Teléfono:</strong>
                                <input type="text" class="form-control" name="telefono" value="{{ auth()->user()->telefono }}">
                            </li>
                            <li class="list-group-item">
                                <strong>Código Postal:</strong>
                                <input type="text" class="form-control" name="codigoPostal" value="{{ auth()->user()->codigoPostal }}">
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
                                        <option selected value="{{auth()->user()->comunidad}}">{{auth()->user()->comunidad}}</option>
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
                                        <option selected value="{{auth()->user()->provincia}}">{{auth()->user()->provincia}}</option>
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
                                        <option selected value="{{auth()->user()->ciudad}}">{{auth()->user()->ciudad}}</option>
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
                                <input type="text" class="form-control" name="edad" value="{{ auth()->user()->edad }}">
                            </li>
                            <li class="list-group-item">
                                <strong>Sexo:</strong>
                                <input type="text" class="form-control" name="sexo" value="{{ auth()->user()->sexo }}">
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
                <a class="btn btn-info" id="SeeData">Ver Datos</a>
            </form>
            
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

        // Función para llenar el select de provincias
        function populateProvincias(comunidad) {
            provinciaSelect.innerHTML = '<option value="">Seleccione una Provincia</option>';
            ciudadSelect.innerHTML = '<option value="">Seleccione una Ciudad</option>';
            provinciaSelect.disabled = !comunidad;
            ciudadSelect.disabled = true;

            if (comunidad) {
                comunidad.provinces.forEach(provincia => {
                    let option = document.createElement('option');
                    option.value = provincia.label;
                    option.text = provincia.label;
                    provinciaSelect.appendChild(option);
                });
            }
        }

        // Función para llenar el select de ciudades
        function populateCiudades(provincia) {
            ciudadSelect.innerHTML = '<option value="">Seleccione una Ciudad</option>';
            ciudadSelect.disabled = !provincia;

            if (provincia) {
                provincia.towns.forEach(ciudad => {
                    let option = document.createElement('option');
                    option.value = ciudad.label;
                    option.text = ciudad.label;
                    ciudadSelect.appendChild(option);
                });
            }
        }

        // Llenar el select de comunidades autónomas
        data.forEach(comunidad => {
            let option = document.createElement('option');
            option.value = comunidad.label;
            option.text = comunidad.label;
            comunidadSelect.appendChild(option);
        });

        // Evento cuando se cambia la comunidad
        comunidadSelect.addEventListener('change', function () {
            let selectedComunidad = data.find(c => c.label === this.value);
            populateProvincias(selectedComunidad);
        });

        // Evento cuando se cambia la provincia
        provinciaSelect.addEventListener('change', function () {
            let selectedComunidad = data.find(c => c.label === comunidadSelect.value);
            let selectedProvincia = selectedComunidad.provinces.find(p => p.label === this.value);
            populateCiudades(selectedProvincia);
        });

        // Pre-seleccionar valores existentes
        let preSelectedComunidad = "{{ auth()->user()->comunidad }}";
        let preSelectedProvincia = "{{ auth()->user()->provincia }}";
        let preSelectedCiudad = "{{ auth()->user()->ciudad }}";

        comunidadSelect.value = preSelectedComunidad;
        let selectedComunidad = data.find(c => c.label === preSelectedComunidad);
        populateProvincias(selectedComunidad);

        if (preSelectedProvincia) {
            provinciaSelect.value = preSelectedProvincia;
            let selectedProvincia = selectedComunidad.provinces.find(p => p.label === preSelectedProvincia);
            populateCiudades(selectedProvincia);
        }

        if (preSelectedCiudad) {
            ciudadSelect.value = preSelectedCiudad;
        }
    });

    document.getElementById('editButton').addEventListener('click', function () {
        document.getElementById('infoSection').style.display = 'none';
        document.getElementById('editForm').style.display = 'block';
    });

    document.getElementById('SeeData').addEventListener('click', function () {
        document.getElementById('editForm').style.display = 'none';
        document.getElementById('infoSection').style.display = 'block';
    });
});


</script>

@endsection
