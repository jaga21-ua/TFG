<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento; 

class MedicamentosController extends Controller
{
    // Método para mostrar una lista de medicamentos
    public function index()
    {
        $medicamentos = Medicamento::Paginate(20);
        return view('medicamentos', ['medicamentos' => $medicamentos]);
    } 
}
