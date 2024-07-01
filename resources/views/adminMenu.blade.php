@extends('welcome')

@section('content')
<div class="container text-center" style="margin-top: 10%; margin-bottom: 10%">
    <h1 class="text-white">Bienvenido Administrador!</h1>
    <h2 class="text-white">¿Qué deseas hacer hoy?</h2>
    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('users.index') }}" class="btn btn-custom mx-2">Usuarios</a>
        <a href="{{ route('medicamentos.indexAdmin') }}" class="btn btn-custom mx-2">Medicamentos</a>
    </div>
</div>

<style>
    body {
        background-color: #00AEEF; 
    }

    h1, h2 {
        font-weight: bold;
    }

    .btn-custom {
        color: #fff;
        background-color: transparent;
        border: 2px solid #fff;
        border-radius: 30px;
        padding: 10px 20px;
        font-size: 1.2rem;
        text-decoration: none;
    }

    .btn-custom:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
        text-decoration: none;
    }
</style>
@endsection
