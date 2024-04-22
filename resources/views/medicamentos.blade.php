@extends('welcome')

@section('content')
    <div class="container">
        <h2>Medicamentos</h2>
        <form action="{{ route('medicamentos.index') }}" method="GET" class=" ">
            @csrf
            <input class="" type="text" name="search" placeholder="Buscar medicamento...">
            <button type="submit">Buscar</button>
        </form>
        <form method="GET" action="{{ route('medicamentos.index') }}">
            @csrf
            <label for="Filtro"></label>
            <select id="Filtro" name="Filtro" >
                <option selected value></option>
                <option value="Delantero">Delanteros</option>
                <option value="Centrocampista">Centrocampistas</option>
                <option value="Defensa">Defensas</option>
                <option value="Portero">Porteros</option>
            </select>
            
            <button type="submit">filtrar</button>
        </form>

        @if ($medicamentos->count() > 0)
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($medicamentos as $medicamento)
                    <div class="col">
                        <div class="card">
                            <img src="{{($medicamento->photo) }}" class="card-img-top" alt="{{ $medicamento->nombre }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $medicamento->nombre }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $medicamentos->links() }} <!-- Mostrar enlaces de paginación -->
        @else
            <p>No se encontraron medicamentos.</p>
        @endif
    </div>
@endsection
