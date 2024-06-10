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
    
});
