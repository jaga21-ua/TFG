@extends('welcome')

@section('content')
    <div class="container">
        <div class="row justify-content-center ">
            <div class="card bg-info" style="width: 900px; height: 750px;">
                <div class="row">
                    <div class="col">

                        @php
                        // Decodificar el JSON de la foto para obtener un array
                            $fotos = json_decode($medicamento->photo);
                        @endphp
                        @if ($fotos && is_array($fotos) && count($fotos) > 0)
                            {{-- Mostrar solo la primera foto --}}
                            <img src="{{ $fotos[0] }}" class="card rounded" width="325px" height="285px" style="margin-top: 5%;margin-left:5%"  alt="{{ $medicamento->nombre }}">
                        @else
                            {{-- Si no hay fotos, mostrar una imagen predeterminada o un texto alternativo --}}
                            <img src="{{ asset('medicamentosPredeterminado.png') }}"  class="card" alt="{{ $medicamento->nombre }}">
                        @endif

                    </div>
                    <div class="col" style="margin-top: 10%">
                        <h5 class="card-title">{{ $medicamento->nombre }}</h5>
                    </div>
                </div>
                
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col">
                            <p class="card-text"><strong>Número de Registro:</strong> {{ $medicamento->nregistro }}</p>
                            <p class="card-text"><strong>Laboratorio Titular:</strong> {{ $medicamento->labtitular }}</p>
                            <p class="card-text"><strong>Estado:</strong> {{ $medicamento->estado }}</p>
                            <p class="card-text"><strong>Condiciones de Prescripción:</strong> {{ $medicamento->cpresc ?: 'No especificado' }}</p>
                            <p class="card-text"><strong>Comercializado:</strong> {{ $medicamento->comerc ? 'Sí' : 'No' }}</p>
                            <p class="card-text"><strong>Receta:</strong> {{ $medicamento->receta ? 'Sí' : 'No' }}</p>
                        </div>
                        <div class="col">
                            <p class="card-text"><strong>Conducir:</strong> {{ $medicamento->conduc ? 'Sí' : 'No' }}</p>
                            <p class="card-text"><strong>Triángulo Negro:</strong> {{ $medicamento->triangulo ? 'Sí' : 'No' }}</p>
                            <p class="card-text"><strong>Huérfano:</strong> {{ $medicamento->huerfano ? 'Sí' : 'No' }}</p>
                            <p class="card-text"><strong>Biosimilar:</strong> {{ $medicamento->biosimilar ? 'Sí' : 'No' }}</p>
                            <p class="card-text"><strong>Vías de Administración:</strong> {{ $medicamento->viasAdministracion ?: 'No especificado' }}</p>
                            <p class="card-text"><strong>Dosis:</strong> {{ $medicamento->dosis ?: 'No especificado' }}</p>
                        </div>
                    </div>
                    <!-- Agrega aquí más detalles del medicamento si es necesario -->
                </div>
                
            </div>
        </div>
    </div>
@endsection