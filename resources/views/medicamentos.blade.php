@extends('welcome')

@section('content')
    <div class="container">
        <h2>Medicamentos</h2>
        <form action="{{ route('medicamentos.index') }}" method="GET" class="mb-3">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Buscar medicamento...">
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
        <form method="GET" action="{{ route('medicamentos.index') }}" class="mb-3">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="filtroReceta" class="form-label">Receta</label>
                    <select id="filtroReceta" name="filtroReceta" class="form-select">
                        <option value="">Todos</option>
                        <option value="1">Con receta</option>
                        <option value="0">Sin receta</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="filtroConduc" class="form-label">Conducir</label>
                    <select id="filtroConduc" name="filtroConduc" class="form-select">
                        <option value="">Todos</option>
                        <option value="1">Se puede conducir</option>
                        <option value="0">No se puede conducir</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="filtroViasAdmin" class="form-label">Vías de administración</label>
                    <select id="filtroViasAdmin" name="filtroViasAdmin" class="form-select">
                        <option value="">Todos</option>
                        <option value="VÍA ORAL">Oral</option>
                        <option value="VÍA INTRAVENOSA">Intravenosa</option>
                        <option value="VÍA INTRAMUSCULAR">Intramuscular</option>
                        <option value="USO CUTÁNEO">Uso Cutaneo</option>
                        <option value="VÍA OFTÁLMICA">VÍA OFTÁLMICA</option>
                        <option value="VÍA INHALATORIA">Vía inhalatoria</option>
                        <option value="VÍA RECTAL">Vía Rectal</option>
                        
                        <!-- Agregar más opciones según sea necesario -->
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="filtroComercializado" class="form-label">Comercializado</label>
                    <select id="filtroComercializado" name="filtroComercializado" class="form-select">
                        <option value="">Todos</option>
                        <option value="1">Comercializado</option>
                        <option value="0">No comercializado</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        @if ($medicamentos->count() > 0)
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($medicamentos as $medicamento)
                    <div class="col">
                        <a class="card bg-info" style="height: 310px;width: 330px;text-decoration: none; color: inherit;" href="/medicamento/{{$medicamento->id}}">
                            @php
                                // Decodificar el JSON de la foto para obtener un array
                                $fotos = json_decode($medicamento->photo);
                            @endphp
                            {{-- Verificar si hay fotos --}}
                            @if ($fotos && is_array($fotos) && count($fotos) > 0)
                                {{-- Mostrar solo la primera foto --}}
                                <img src="{{ $fotos[0] }}" class="card-img-top rounded" width="190px" height="170px" alt="{{ $medicamento->nombre }}">
                            @else
                                {{-- Si no hay fotos, mostrar una imagen predeterminada o un texto alternativo --}}
                                <img src="{{ asset('medicamentosPredeterminado.png') }}" width="150px" height="180px" class="card-img-top" alt="{{ $medicamento->nombre }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $medicamento->nombre }}</h5>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{ $medicamentos->appends([
                'search' => $search,
                'filtroReceta' => $filtroReceta,
                'filtroConduc' => $filtroConduc,
                'filtroViasAdmin' => $filtroViasAdmin,
                'filtroComercializado' => $filtroComercializado,
            ])->links() }}
            
        @else
            <p>No se encontraron medicamentos.</p>
        @endif

    </div>
@endsection
