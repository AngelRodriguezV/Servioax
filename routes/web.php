<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\UserRegisterController;
use App\Models\Conversacion;
use App\Models\User;
use App\Livewire\Messenger;
use Illuminate\Support\Facades\Route;

# Vistas que se muestran al cliente publicas
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('categorias', [HomeController::class, 'categorias'])->name('categorias');
Route::get('categorias/{categoria}', [HomeController::class, 'categoria'])->name('categoria');

Route::get('servicios', [HomeController::class, 'servicios'])->name('servicios');
Route::get('servicio/{servicio}', [HomeController::class, 'servicio'])->name('servicio');

Route::get('proveedores-de-servicio', [HomeController::class, 'proveedores'])->name('proveedores');
Route::get('proveedor-de-servicio/{proveedor}', [HomeController::class, 'proveedor'])->name('proveedor');

# Vistas que requieren auntenticación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [LoginController::class, 'login'])->name('dashboard');
    Route::get('/messenger/{user2}', Messenger::class)->name('messenger');

    # ---
    Route::post('/register', [RegisterController::class, 'registerUser'])->name('register-user');
    Route::get('/tipo-de-usuario', [RegisterController::class, 'tipoUsuario'])->name('tipo-usuario');
    Route::get('/subir-id', [UserRegisterController::class, 'subirId'])->name('subirId');

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
            Route::get('dashboard', [ProveedorController::class, 'dashboard'])->name('dashboard');
            Route::get('direcciones', [ProveedorController::class, 'direcciones'])->name('direcciones');
            Route::get('perfil', [ProveedorController::class, 'perfil'])->name('perfil');
            Route::get('horarios', [ProveedorController::class, 'horarios'])->name('horarios');

            Route::resource('servicios', ServiciosController::class);
        });
    });

    # Vistas auntenticadas para el Cliente
    Route::group(['middleware' => ['role:Cliente']], function () {
        Route::prefix('cliente')->name('cliente.')->group(function() {

            # Agregar las rutas del proveedor
            Route::get('home', [ClienteController::class, 'dashboard'])->name('dashboard');
            Route::get('mis-solicitudes', [ClienteController::class, 'solicitudes'])->name('solicitudes');
            Route::get('mis-solicitudes/{solicitud}', [ClienteController::class, 'solicitud'])->name('solicitud');
            Route::get('direcciones', [ClienteController::class, 'direcciones'])->name('direcciones');
            Route::get('perfil', [ClienteController::class, 'perfil'])->name('perfil');
            Route::get('soporte', [ClienteController::class, 'soporte'])->name('soporte');
            Route::get('solicitud/create', [ClienteController::class, 'saveSolicitud'])->name('solicitud.show');

            Route::get('solicitar-servicio/{servicio}', [ClienteController::class, 'solicitarServicio'])->name('solicitarservicio');

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
