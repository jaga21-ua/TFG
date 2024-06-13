@extends('welcome')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="background-color: #B0E0E6">
                <div class="card-body">
                    <h5 class="card-title">Gestión de Usuarios</h5>
                    <a class="btn btn-info" href="/adminMenu">Volver al Menu</a>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre y apellidos</th>
                                <th>DNI</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>CP</th>
                                <th>Provincia</th>
                                <th>Ciudad</th>
                                <th>Comunidad</th>
                                <th>Edad</th>
                                <th>Sexo</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }} {{ $user->apellidos }}</td>
                                    <td>{{ $user->dni }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->telefono }}</td>
                                    <td>{{ $user->codigoPostal }}</td>
                                    <td>{{ $user->provincia }}</td>
                                    <td>{{ $user->ciudad }}</td>
                                    <td>{{ $user->comunidad }}</td>
                                    <td>{{ $user->edad }}</td>
                                    <td>{{ $user->sexo }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table {
        background-color: #00BFFF;
        border-radius: 10px;
        overflow: hidden;
    }
    .table th, .table td {
        background-color: #B0E0E6;
    }
    .table th {
        text-align: center;
    }
    .table td {
        text-align: center;
        vertical-align: middle;
    }
    .table .btn {
        margin-right: 5px;
    }
    .pagination {
        background-color: #00BFFF;
        border-radius: 10px;
    }
    .page-link {
        color: #ffffff;
        background-color: #00BFFF;
        border: 1px solid #00BFFF;
    }
    .page-link:hover {
        color: #00BFFF;
        background-color: #ffffff;
    }
</style>

@endsection
