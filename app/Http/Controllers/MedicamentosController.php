<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento; 
use Illuminate\Support\Str;


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

    public function indexAdmin(Request $request)
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
        $medicamentos = $query->paginate(5);

        // Devolver la vista con los datos de los medicamentos
        return view('medicamentos.medicamentosAdmin', [
            'medicamentos' => $medicamentos,
            'search' => $search,
            'filtroReceta' => $filtroReceta,
            'filtroConduc' => $filtroConduc,
            'filtroViasAdmin' => $filtroViasAdmin,
            'filtroComercializado' => $filtroComercializado,
        ]);
    } 

    public function show($id)
    {
        $medicamento = Medicamento::find($id);
        return view('medicamento', ['medicamento' => $medicamento]);
    }
    public function showAdmin($id)
    {
        $medicamento = Medicamento::find($id);
        return view('medicamento.medicamentoAdmin', ['medicamento' => $medicamento]);
    }
    public function create()
    {
        return view('medicamentos.form');
    }
    public function store(Request $request)
    {
        $medicamento = new Medicamento();
        $medicamento->nombre = $request->input('nombre');
        
        $medicamento->receta = $request->input('receta');
        $medicamento->conduc = $request->input('conduc');
        $medicamento->viasAdministracion = $request->input('viasAdministracion');
        $medicamento->dosis = $request->input('dosis');
        $medicamento->nregistro = $request->input('nregistro');
        $medicamento->pactivos = $request->input('pactivos');
        $medicamento->labtitular = $request->input('labtitular');
        $medicamento->estado = $request->input('estado');
        $medicamento->cpresc = $request->input('cpresc');
        $medicamento->triangulo = $request->input('triangulo');
        $medicamento->huerfano = $request->input('huerfano');
        $medicamento->biosimilar = $request->input('biosimilar');
        $medicamento->comerc = $request->input('comerc');

        if($request->hasFile("imagen")){
            
            $imagen = $request->file("imagen");
            $nombreimagen = Str::slug($request->nombre).".".$imagen->guessExtension();
            $ruta = public_path("medicamentosFotos/");

            //$imagen->move($ruta,$nombreimagen);
            copy($imagen->getRealPath(),$ruta.$nombreimagen);
            

            $medicamento->photo ="medicamentosFotos/".$nombreimagen;
        }
        $medicamento->save();

        return redirect()->route('medicamentos.indexAdmin')->with('mensaje', 'Medicamento creado correctamente.');
    }
    public function edit($id)
    {
        $medicamento = Medicamento::find($id);
        return view('medicamentos.form', ['medicamento' => $medicamento]);
    }
    public function update(Request $request, $id)
    {
        $medicamento = Medicamento::find($id);
        $medicamento->nombre = $request->input('nombre');
        $medicamento->receta = $request->input('receta');
        $medicamento->conduc = $request->input('conduc');
        $medicamento->viasAdministracion = $request->input('viasAdministracion');
        $medicamento->dosis = $request->input('dosis');
        $medicamento->nregistro = $request->input('nregistro');
        $medicamento->pactivos = $request->input('pactivos');
        $medicamento->labtitular = $request->input('labtitular');
        $medicamento->estado = $request->input('estado');
        $medicamento->cpresc = $request->input('cpresc');
        $medicamento->triangulo = $request->input('triangulo');
        $medicamento->huerfano = $request->input('huerfano');
        $medicamento->biosimilar = $request->input('biosimilar');
        $medicamento->comerc = $request->input('comerc');

        if($request->hasFile("imagen")){
            
            $imagen = $request->file("imagen");
            $nombreimagen = Str::slug($request->nombre).".".$imagen->guessExtension();
            $ruta = public_path("medicamentosFotos/");

            //$imagen->move($ruta,$nombreimagen);
            copy($imagen->getRealPath(),$ruta.$nombreimagen);
            

            $medicamento->photo ="medicamentosFotos/".$nombreimagen;
        }
        $medicamento->save();

        return redirect()->route('medicamentos.indexAdmin')->with('mensaje', 'Medicamento actualizado correctamente.');
    }
    public function destroy($id)
    {
        $medicamento = Medicamento::find($id);
        $medicamento->delete();
        return redirect()->route('medicamentos.indexAdmin')->with('mensaje', 'Medicamento eliminado correctamente.');
    }


}
