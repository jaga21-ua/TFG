<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento; 

class MedicamentosController extends Controller
{
    // Método para mostrar una lista de medicamentos
    public function index(Request $request)
    {
        // Obtener los datos de búsqueda del formulario
        $search = $request->input('search');
        $filtroReceta = $request->input('filtroReceta');
        $filtroConduc = $request->input('filtroConduc');
        $filtroViasAdmin = $request->input('filtroViasAdmin');
        $filtroComercializado = $request->input('filtroComercializado');

        // Inicializar una consulta de Eloquent para los medicamentos
        $query = Medicamento::query();

        // Aplicar los filtros según los parámetros recibidos
        if (!empty($search)) {
            $query->where('nombre', 'like', '%' . $search . '%');
        }
        if (!is_null($filtroReceta)) {
            $query->where('receta', $filtroReceta);
        }
        if (!is_null($filtroConduc)) {
            $query->where('conduc', $filtroConduc);
        }
        if (!empty($filtroViasAdmin)) {
            $query->where('viasAdministracion', $filtroViasAdmin);
        }
        if (!is_null($filtroComercializado)) {
            $query->where('comerc', $filtroComercializado);
        }

        // Ejecutar la consulta y paginar los resultados
        $medicamentos = $query->paginate(20);

        // Devolver la vista con los datos de los medicamentos
        return view('medicamentos', [
            'medicamentos' => $medicamentos,
            'search' => $search,
            'filtroReceta' => $filtroReceta,
            'filtroConduc' => $filtroConduc,
            'filtroViasAdmin' => $filtroViasAdmin,
            'filtroComercializado' => $filtroComercializado,
        ]);
    } 
}
