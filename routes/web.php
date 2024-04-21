<?php

use App\Http\Controllers\HomeController;
use App\Models\Conversacion;
use App\Models\User;
use Illuminate\Support\Facades\Route;

# Vistas que se muestran al cliente publicas
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('categorias/{categoria}', [HomeController::class, 'categoria'])->name('categorias');

Route::get('servicios', [HomeController::class, 'servicios'])->name('servicios');
Route::get('servicio/{servicio}', [HomeController::class, 'servicio'])->name('servicio');

# Vistas que requieren auntenticación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    # Vistas auntenticadas para el Administrador
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::prefix('admin')->name('admin.')->group(function() {
            
            # Agregar las rutas del admin
            Route::get('dashboard', function () {
                return 'Dashboard admin';
            })->name('dashboard');

        });  
    });
    # Vistas auntenticadas para el Proveedor
    Route::group(['middleware' => ['role:Proveedor']], function () {
        Route::prefix('proveedor')->name('proveedor.')->group(function() {

            # Agregar las rutas del proveedor
            Route::get('dashboard', function () {
                return 'Dashboard proveedor';
            })->name('dashboard');

        });
    });

    # Vistas auntenticadas para el Cliente
    Route::group(['middleware' => ['role:Cliente']], function () {
        Route::prefix('cliente')->name('cliente.')->group(function() {

            # Agregar las rutas del proveedor
            Route::get('dashboard', function () {
                return 'Dashboard cliente';
            })->name('dashboard');

        });
    });
});


# pruebas de consultas -- ingorar
Route::get('/d', function() {
    $user = User::all()->random();
    $conversaciones = Conversacion::select('*')
            ->join('mensajes', 'mensajes.conversacion_id', '=', 'conversaciones.id')
            ->where('mensajes.remitente_id', $user->id)
            ->get();
    return $conversaciones;
});