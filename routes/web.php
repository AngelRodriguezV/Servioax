<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\AdminController;
use App\Models\Conversacion;
use App\Models\User;
use App\Livewire\Messenger;
use App\Models\DiasTrabajo;
use App\Models\Horario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

# Vistas que se muestran al cliente publicas
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('categorias', [HomeController::class, 'categorias'])->name('categorias');
Route::get('categorias/{categoria}', [HomeController::class, 'categoria'])->name('categoria');

Route::get('servicios', [HomeController::class, 'servicios'])->name('servicios');
Route::get('servicio/{servicio}', [HomeController::class, 'servicio'])->name('servicio');

Route::get('proveedores', [HomeController::class, 'proveedores'])->name('proveedores');
Route::get('proveedor-de-servicio/{proveedor}', [HomeController::class, 'proveedor'])->name('proveedor');

Route::post('/register', [RegisterController::class, 'registerUser'])->name('register-user');

Route::get('proveedores-servicio', [HomeController::class, 'proveedoresServicio'])->name('proveedoresServicio');

# Vistas que requieren auntenticación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [LoginController::class, 'login'])->name('dashboard');
    Route::get('/messenger/{user2}', Messenger::class)->name('messenger');

    # ---
    Route::get('/tipo-de-usuario', [RegisterController::class, 'tipoUsuario'])->name('tipo-usuario');
    Route::post('/tipo-de-usuario', [RegisterController::class, 'tipoUsuario'])->name('tipo-usuario');
    Route::get('/set-direccion', [RegisterController::class, 'setDireccion'])->name('set-direccion');
    Route::post('/set-direccion', [RegisterController::class, 'setDireccion'])->name('set-direccion');
    Route::get('/set-ine', [RegisterController::class, 'setIne'])->name('set-ine');
    Route::post('/set-ine', [RegisterController::class, 'setIne'])->name('set-ine');
    Route::get('/subir-id', [UserRegisterController::class, 'subirId'])->name('subirId');

    # Vistas auntenticadas para el Administrador
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::prefix('admin')->name('admin.')->group(function() {

            # Agregar las rutas del admin
            #Route::get('dashboard', function () {
                #return 'Dashboard admin';
            #})->name('dashboard');

            Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::get('proveedores', [AdminController::class, 'administrarProv'])->name('adminProv');
            Route::get('clientes', [AdminController::class, 'administrarCli'])->name("adminClie");
            Route::get('proveedor/{proveedor}/servicios', [AdminController::class, 'gestionarServicios'])->name('gestionServicios');
            Route::get('proveedor/{proveedor}/servicios/{servicio}', [AdminController::class, 'aprobarServicio'])->name('aprobarServicio');
            Route::get('perfil', [AdminController::class, 'verPerfil'])->name('perfil');
            Route::get('aprobar-cuenta/{user}', [AdminController::class, 'aprobarCuentas'])->name('aprobarCuentas');
            Route::get('crear-categoria',[AdminController::class, 'crearCategoria'])->name('crearCategoria');
            Route::post('guardar-categoria', [AdminController::class, 'storeCategoria'])->name('storeCategoria');
            Route::get('gestion-categorias', [AdminController::class, 'gestionCategorias'])->name('gestionCategorias');
            Route::get('editar-categoria/{categoria}', [AdminController::class, 'editarCategoria'])->name('editarCategoria');
            Route::put('actualizar-categoria/{categoria}', [AdminController::class, 'actualizarCategoria'])->name('actualizarCategoria');
            Route::patch('cambiarEstadocat/{categoria', [AdminController::class, 'cambiarEstadoCategoria'])->name('cambiarEstadoCategoria');

            Route::get('mensajes/{user2}', [AdminController::class, 'mensajes'])->name('mensajes');
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

            Route::get('aprobar/{solicitud}', [ProveedorController::class, 'abrobarSolicitud'])->name('aprobar');

            Route::get('mensajes/{user2}', [ProveedorController::class, 'mensajes'])->name('mensajes');
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
            Route::get('mensajes/{user2}', [ClienteController::class, 'mensajes'])->name('mensajes');
        });
    });
});


# pruebas de consultas -- ingorar
Route::get('/d', function() {
    #$user = User::all()->random();
    #$conversaciones = Conversacion::select('*')
    #        ->join('mensajes', 'mensajes.conversacion_id', '=', 'conversaciones.id')
    #        ->where('mensajes.remitente_id', $user->id)
    #        ->get();
    $dias = DiasTrabajo::where('proveedor_id', Auth::user()->id)->pluck('dia_semana', 'id');
    return $dias->keys()->first();
});
