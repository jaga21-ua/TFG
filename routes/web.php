<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentosController;
use App\Http\Controllers\farmacias;
use App\Http\Controllers\medicosController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Kernel;



Route::get('/', function () {
    return view('main');
});

Route::get('/medicamentos', [MedicamentosController::class, 'index'])->name('medicamentos.index');

Route::get('/medicamento/{id}', [MedicamentosController::class, 'show'])->name('medicamento.show');

Route::get('/Farmacias', [farmacias::class, 'show'])->name('farmacias.show');

Route::get('/Medicos', [medicosController::class, 'show'])->name('medicos.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware([App\Http\Middleware\MyMiddleWare::class])->group(function () {
    
    Route::get('/diagnosticoChat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/diagnosticoChat', [ChatController::class, 'store'])->name('chat.store');
    Route::get('/diagnosticoChat/{id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/handleChat', [ChatController::class, 'handleChat']);
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
    
});

Route::middleware([App\Http\Middleware\AdminMiddleware::class])->group(function () {
    // Rutas protegidas para administradores
    Route::get('/adminMenu', function () {
        return view('adminMenu');
    })->name('adminMenu');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'updateAdmin'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');   


    Route::get('/medicamentosAdmin', [MedicamentosController::class, 'indexAdmin'])->name('medicamentos.indexAdmin');
    Route::get('/medicamentosAdmin/{id}/edit', [MedicamentosController::class, 'edit'])->name('medicamento.edit');
    Route::put('/medicamentosAdmin/{id}', [MedicamentosController::class, 'update'])->name('medicamentos.update');
    Route::delete('/medicamentosAdmin/{id}', [MedicamentosController::class, 'destroy'])->name('medicamento.destroy');
    Route::get('/medicamentosAdmin/create', [MedicamentosController::class, 'create'])->name('medicamentos.create');
    Route::post('/medicamentosAdmin', [MedicamentosController::class, 'store'])->name('medicamentos.store');
    Route::get('/medicamentosAdmin/{id}', [MedicamentosController::class, 'showAdmin'])->name('medicamentos.showAdmin');

    
});
