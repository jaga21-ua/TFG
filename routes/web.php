<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentosController;
use App\Http\Controllers\farmacias;
use App\Http\Controllers\medicosController;

Route::get('/', function () {
    return view('main');
});

Route::get('/medicamentos', [MedicamentosController::class, 'index'])->name('medicamentos.index');

Route::get('/medicamento/{id}', [MedicamentosController::class, 'show'])->name('medicamento.show');

Route::get('/Farmacias', [farmacias::class, 'show'])->name('farmacias.show');

Route::get('/Medicos', [medicosController::class, 'show'])->name('medicos.show');



