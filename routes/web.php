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
use App\Http\Controllers\ProductoVarianteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleUserController;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


use App\Http\Controllers\KpiController;

/*DASHBOARD PRINCIPAL
*/

Route::get('/', function () {

    $categorias = DB::table('categorias')->count();

    $productos = DB::table('productos')->count();

    $clientes = DB::table('clientes')->count();

    $reservas = DB::table('reservas')->count();

    $pedidos = DB::table('pedidos')->count();

    $ventas = DB::table('ventas')->count();

    $devoluciones = DB::table('devoluciones')->count();

    $inventarios = DB::table('inventario')->count();

    // KPIs: valores obtenidos de las tablas existentes.
    $ingresosVentas = DB::table('ventas')->sum('total');
    $stockDisponible = DB::table('inventario')->sum('stock_disponible');
    $stockReservado = DB::table('inventario')->sum('stock_reservado');
    $stockBajo = DB::table('inventario')
        ->whereColumn('stock_disponible', '<=', 'stock_minimo')
        ->count();

    // Últimos 12 meses, incluyendo meses sin ventas.
    $inicioPeriodo = now()->startOfMonth()->subMonths(11);
    $ventasPorMes = DB::table('ventas')
        ->selectRaw('YEAR(fecha_venta) AS anio, MONTH(fecha_venta) AS mes, COUNT(*) AS cantidad, SUM(total) AS importe')
        ->where('fecha_venta', '>=', $inicioPeriodo->toDateString())
        ->groupByRaw('YEAR(fecha_venta), MONTH(fecha_venta)')
        ->get()
        ->keyBy(fn ($fila) => $fila->anio . '-' . $fila->mes);

    $mesesKpi = [];
    $importesKpi = [];
    $cantidadesKpi = [];
    for ($i = 0; $i < 12; $i++) {
        $fecha = $inicioPeriodo->copy()->addMonths($i);
        $clave = $fecha->year . '-' . $fecha->month;
        $fila = $ventasPorMes->get($clave);
        $mesesKpi[] = $fecha->translatedFormat('M Y');
        $importesKpi[] = (float) ($fila->importe ?? 0);
        $cantidadesKpi[] = (int) ($fila->cantidad ?? 0);
    }


    return view('dashboard', compact(
        'categorias',
        'productos',
        'clientes',
        'reservas',
        'pedidos',
        'ventas',
        'devoluciones',
        'inventarios',
        'ingresosVentas',
        'stockDisponible',
        'stockReservado',
        'stockBajo',
        'mesesKpi',
        'importesKpi',
        'cantidadesKpi'
    ));

})->middleware('auth')->name('home');


/*DASHBOARD DE BREEZE*/

Route::get('/dashboard', function () {

    return redirect()->route('home');

})->middleware(['auth', 'verified'])->name('dashboard');


/* PERFIL DE USUARIO*/


Route::middleware('auth')->group(function () {

  
    // PERFIL
   

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    // USUARIOS
  

    Route::resource('users', UserController::class);


  
    // ROLES
   

    Route::resource('roles', RoleController::class);



// ADMINISTRACIÓN - SOLO ADMIN
// CONTROL DE ACCESO POR ROLES


Route::middleware('role:admin')->group(function () {

    // USUARIOS
    Route::resource('users', UserController::class);

    // ROLES
    Route::resource('roles', RoleController::class);

    // ASIGNAR ROL
    Route::get('/asignar-rol', [RoleUserController::class, 'index'])
    ->name('asignar.index');

Route::get('/asignar-rol/create', [RoleUserController::class, 'create'])
    ->middleware('password.confirm')
    ->name('asignar.create');

Route::post('/asignar-rol', [RoleUserController::class, 'store'])
    ->middleware('password.confirm')
    ->name('asignar.store');

});

/*CRUD DEL SISTEMA*/


// CRUD Categorías
Route::resource('categorias', CategoriaController::class);


// CRUD Productos
Route::resource('productos', ProductoController::class);


// CRUD Clientes
Route::resource('clientes', ClienteController::class);


// CRUD Reservas
Route::resource('reservas', ReservaController::class);


// CRUD Pedidos
Route::resource('pedidos', PedidoController::class);


// CRUD Ventas
Route::resource('ventas', VentaController::class);


// CRUD Devoluciones
Route::resource('devoluciones', DevolucionController::class);


      /*
|--------------------------------------------------------------------------
| INVENTARIO
|--------------------------------------------------------------------------
| Primero colocamos la ruta especial "dinamico".
| Después el CRUD normal.
|--------------------------------------------------------------------------
*/


// INVENTARIO DINÁMICO
Route::get(
    '/inventarios/dinamico',
    [InventarioController::class, 'dinamico']
)->name('inventarios.dinamico');


// CRUD Inventarios
// Excluimos "show" porque no lo estamos utilizando.
Route::resource(
    'inventarios',
    InventarioController::class
)->except(['show']);


/*
|--------------------------------------------------------------------------
| VARIANTES DE PRODUCTOS
|--------------------------------------------------------------------------
*/

Route::resource(
    'producto-variantes',
    ProductoVarianteController::class
);  

});




/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN DE BREEZE
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
// INCREMENTO 5 - Estadísticas y KPIs (solo lectura)
Route::middleware('auth')->prefix('kpis')->name('kpis.')->group(function () {
    Route::get('/', [KpiController::class, 'resumen'])->name('resumen');
    Route::get('/ventas', [KpiController::class, 'ventas'])->name('ventas');
    Route::get('/productos', [KpiController::class, 'productos'])->name('productos');
    Route::get('/inventario', [KpiController::class, 'inventario'])->name('inventario');
    Route::get('/operaciones', [KpiController::class, 'operaciones'])->name('operaciones');
});
