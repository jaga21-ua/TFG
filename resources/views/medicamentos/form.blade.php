@extends('welcome')

@section('content')
<div class="container mt-5">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (isset($medicamento))
        <form action="{{ route('medicamentos.update', $medicamento->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            <h2>Editar Medicamento</h2>
    @else
        <form action="{{ route('medicamentos.store') }}" method="POST" enctype="multipart/form-data">
            <h2>Crear Medicamento</h2>
    @endif
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $medicamento->nombre ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="receta" class="form-label">Receta</label>
            <select class="form-select" id="receta" name="receta" required>
                <option value="1" {{ (old('receta', $medicamento->receta ?? '') == '1') ? 'selected' : '' }}>Con receta</option>
                <option value="0" {{ (old('receta', $medicamento->receta ?? '') == '0') ? 'selected' : '' }}>Sin receta</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="conduc" class="form-label">Conducir</label>
            <select class="form-select" id="conduc" name="conduc" required>
                <option value="1" {{ (old('conduc', $medicamento->conduc ?? '') == '1') ? 'selected' : '' }}>Se puede conducir</option>
                <option value="0" {{ (old('conduc', $medicamento->conduc ?? '') == '0') ? 'selected' : '' }}>No se puede conducir</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="filtroViasAdmin" class="form-label">Vías de administración</label>
                <select id="filtroViasAdmin" name="filtroViasAdmin" class="form-select" required>
                    <option value="">Todos</option>
                    <option value="VÍA ORAL" {{ old('filtroViasAdmin', $medicamento->viasAdministracion ?? '') == 'VÍA ORAL' ? 'selected' : '' }}>Oral</option>
                    <option value="VÍA INTRAVENOSA" {{ old('filtroViasAdmin', $medicamento->viasAdministracion ?? '') == 'VÍA INTRAVENOSA' ? 'selected' : '' }}>Intravenosa</option>
                    <option value="VÍA INTRAMUSCULAR" {{ old('filtroViasAdmin', $medicamento->viasAdministracion ?? '') == 'VÍA INTRAMUSCULAR' ? 'selected' : '' }}>Intramuscular</option>
                    <option value="USO CUTÁNEO" {{ old('filtroViasAdmin', $medicamento->viasAdministracion ?? '') == 'USO CUTÁNEO' ? 'selected' : '' }}>Uso Cutaneo</option>
                    <option value="VÍA OFTÁLMICA" {{ old('filtroViasAdmin', $medicamento->viasAdministracion ?? '') == 'VÍA OFTÁLMICA' ? 'selected' : '' }}>Vía oftálmica</option>
                    <option value="VÍA INHALATORIA" {{ old('filtroViasAdmin', $medicamento->viasAdministracion ?? '') == 'VÍA INHALATORIA' ? 'selected' : '' }}>Vía inhalatoria</option>
                    <option value="VÍA RECTAL" {{ old('filtroViasAdmin', $medicamento->viasAdministracion ?? '') == 'VÍA RECTAL' ? 'selected' : '' }}>Vía rectal</option>
                </select>
        </div>
        <div class="mb-3">
            <label for="dosis" class="form-label">Dosis</label>
            <input type="text" class="form-control" id="dosis" name="dosis" value="{{ old('dosis', $medicamento->dosis ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="nregistro" class="form-label">Número de Registro</label>
            <input type="text" class="form-control" id="nregistro" name="nregistro" value="{{ old('nregistro', $medicamento->nregistro ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="pactivos" class="form-label">Principios Activos</label>
            <input type="text" class="form-control" id="pactivos" name="pactivos" value="{{ old('pactivos', $medicamento->pactivos ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="labtitular" class="form-label">Laboratorio Titular</label>
            <input type="text" class="form-control" id="labtitular" name="labtitular" value="{{ old('labtitular', $medicamento->labtitular ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" value="{{ old('estado', $medicamento->estado ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="cpresc" class="form-label">Condiciones de Prescripción</label>
            <textarea class="form-control" id="cpresc" name="cpresc" rows="3">{{ old('cpresc', $medicamento->cpresc ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="triangulo" class="form-label">Triángulo</label>
            <select class="form-select" id="triangulo" name="triangulo" required>
                <option value="1" {{ (old('triangulo', $medicamento->triangulo ?? '') == '1') ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ (old('triangulo', $medicamento->triangulo ?? '') == '0') ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="huerfano" class="form-label">Huéfano</label>
            <select class="form-select" id="huerfano" name="huerfano" required>
                <option value="1" {{ (old('huerfano', $medicamento->huerfano ?? '') == '1') ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ (old('huerfano', $medicamento->huerfano ?? '') == '0') ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="biosimilar" class="form-label">Biosimilar</label>
            <select class="form-select" id="biosimilar" name="biosimilar" required>
                <option value="1" {{ (old('biosimilar', $medicamento->biosimilar ?? '') == '1') ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ (old('biosimilar', $medicamento->biosimilar ?? '') == '0') ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="comerc" class="form-label">Comercializado</label>
            <select class="form-select" id="comerc" name="comerc" required>
                <option value="1" {{ (old('comerc', $medicamento->comerc ?? '') == '1') ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ (old('comerc', $medicamento->comerc ?? '') == '0') ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($medicamento) ? 'Actualizar' : 'Crear' }}</button>
    </form>
</div>
@endsection
