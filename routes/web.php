<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\InventarioController;

use Illuminate\Support\Facades\Route;


// Página principal
Route::get('/', function () {
    return view('welcome');
});


// Dashboard de Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Perfil de usuario - Breeze
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// CRUD DEL SISTEMA
Route::resource('categorias', CategoriaController::class);

Route::resource('productos', ProductoController::class);

Route::resource('clientes', ClienteController::class);

Route::resource('reservas', ReservaController::class);

Route::resource('pedidos', PedidoController::class);

Route::resource('ventas', VentaController::class);

Route::resource('devoluciones', DevolucionController::class);

Route::resource('inventarios', InventarioController::class);


// Rutas de autenticación de Breeze
require __DIR__.'/auth.php';