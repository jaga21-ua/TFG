@extends('welcome')

@section('content')
    <h1>Bienvenido administrador, ¿qué quieres hacer hoy?</h1>
    <div>
        <a href="{{ route('users.index') }}"><button>Ver Usuarios</button></a>
        <a href="{{ route('medicamentos.indexAdmin') }}"><button>Ver Medicamentos</button></a>
    </div>
@endsection