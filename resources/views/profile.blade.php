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
                    <h5 class="card-title">Información del Usuario</h5>
                    <div id="infoSection">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Nombre:</strong> {{ auth()->user()->name }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ auth()->user()->email }}</li>
                            <li class="list-group-item"><strong>DNI:</strong> {{ auth()->user()->dni }}</li>
                            <li class="list-group-item"><strong>Apellidos:</strong> {{ auth()->user()->apellidos }}</li>
                            <li class="list-group-item"><strong>Teléfono:</strong> {{ auth()->user()->telefono }}</li>
                            <li class="list-group-item"><strong>Ciudad:</strong> {{ auth()->user()->ciudad }}</li>
                            <li class="list-group-item"><strong>Código Postal:</strong> {{ auth()->user()->codigoPostal }}</li>
                            <li class="list-group-item"><strong>Provincia:</strong> {{ auth()->user()->provincia }}</li>
                            <li class="list-group-item"><strong>Edad:</strong> {{ auth()->user()->edad }}</li>
                            <li class="list-group-item"><strong>Sexo:</strong> {{ auth()->user()->sexo }}</li>
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
                                <strong>Ciudad:</strong>
                                <input type="text" class="form-control" name="ciudad" value="{{ auth()->user()->ciudad }}">
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Segunda columna -->
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Código Postal:</strong>
                                <input type="text" class="form-control" name="codigoPostal" value="{{ auth()->user()->codigoPostal }}">
                            </li>
                            <li class="list-group-item">
                                <strong>Provincia:</strong>
                                <input type="text" class="form-control" name="provincia" value="{{ auth()->user()->provincia }}">
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
                <a class="btn btn-info" id="SeeData">Ver Datos</a>
            </form>
            
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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
