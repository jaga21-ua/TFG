@extends('welcome')

@section('content')
<div class="container mt-5">
    <h2>Medicamentos</h2>

    <!-- Formulario de búsqueda -->
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

    <!-- Formulario de filtros -->
    <form method="GET" action="{{ route('medicamentos.indexAdmin') }}" class="mb-3">
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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Receta</th>
                    <th>Conducir</th>
                    <th>Vías de administración</th>
                    <th>Comercializado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicamentos as $medicamento)
                    <tr>
                        <td>{{ $medicamento->id }}</td>
                        <td>{{ $medicamento->nombre }}</td>
                        <td>{{ $medicamento->receta ? 'Sí' : 'No' }}</td>
                        <td>{{ $medicamento->conducir ? 'Sí' : 'No' }}</td>
                        <td>{{ $medicamento->vias_administracion }}</td>
                        <td>{{ $medicamento->comercializado ? 'Sí' : 'No' }}</td>
                        <td>
                            <a href="{{ route('medicamento.show', $medicamento->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('medicamento.edit', $medicamento->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('medicamento.destroy', $medicamento->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

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
