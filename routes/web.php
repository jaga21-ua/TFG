<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentosController;

Route::get('/', function () {
    return view('main');
});

Route::get('/medicamentos', [MedicamentosController::class, 'index'])->name('medicamentos.index');

Route::get('/medicamento/{id}', [MedicamentosController::class, 'show'])->name('medicamento.show');

