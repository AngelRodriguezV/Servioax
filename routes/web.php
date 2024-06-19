<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\AdminController;
use App\Livewire\Cliente\Scheduler;
use App\Livewire\Cliente\Scheduler2;
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
    Route::get('/scheduler', Scheduler2::class)->name('scheduler');

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
        Route::prefix('admin')->name('admin.')->group(function () {

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
            Route::get('crear-categoria', [AdminController::class, 'crearCategoria'])->name('crearCategoria');
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
        Route::prefix('proveedor')->name('proveedor.')->group(function () {

            # Agregar las rutas del proveedor
            Route::get('dashboard', [ProveedorController::class, 'dashboard'])->name('dashboard');
            Route::get('direcciones', [ProveedorController::class, 'direcciones'])->name('direcciones');
            Route::get('perfil', [ProveedorController::class, 'perfil'])->name('perfil');
            Route::get('horarios', [ProveedorController::class, 'horarios'])->name('horarios');

            Route::resource('servicios', ServiciosController::class);

            Route::get('aprobar/{solicitud}', [ProveedorController::class, 'abrobarSolicitud'])->name('aprobar');

            Route::get('mensajes/{user2}', [ProveedorController::class, 'mensajes'])->name('mensajes');

            #Notificaciones
            Route::get('notificaciones', [ProveedorController::class, 'mostrarNotificaionesPro'])->name('notificacionP');

            Route::get('markAsRead/{id}', function ($id) {
                $notification = auth()->user()->unreadNotifications()->find($id);

                if ($notification) {
                    $notification->markAsRead();
                }

                return redirect()->back();
            })->name('markAsReadId');

            Route::get('markAsRead', function () {
                auth()->user()->unreadNotifications->markAsRead();
                return redirect()->back();
            })->name('markAsRead');

            Route::get('deleteNotification/{id}', [ProveedorController::class, 'deleteNotification'])->name('deleteNotification');
        });
    });

    # Vistas auntenticadas para el Cliente
    #Route::group(['middleware' => ['role:Cliente']], function () {
    Route::prefix('cliente')->name('cliente.')->group(function () {

        # Agregar las rutas del proveedor
        Route::get('home', [ClienteController::class, 'dashboard'])->middleware('can:cliente-ver-dashboard')->name('dashboard');
        Route::get('mis-solicitudes', [ClienteController::class, 'solicitudes'])->middleware('can:cliente-ver-solicitudes')->name('solicitudes');
        Route::get('mis-solicitudes/{solicitud}', [ClienteController::class, 'solicitud'])->middleware('can:cliente-ver-solicitud')->name('solicitud');
        Route::get('direcciones', [ClienteController::class, 'direcciones'])->middleware('can:cliente-ver-direcciones')->name('direcciones');
        Route::get('perfil', [ClienteController::class, 'perfil'])->middleware('can:cliente-ver-perfil')->name('perfil');
        Route::get('soporte', [ClienteController::class, 'soporte'])->middleware('can:cliente-ver-soporte')->name('soporte');
        Route::get('solicitud/create', [ClienteController::class, 'saveSolicitud'])->middleware('can:cliente-crear-solicitud')->name('solicitud.show');

        Route::get('solicitar-servicio/{servicio}', [ClienteController::class, 'solicitarServicio'])->middleware('can:cliente-solicitar-servicio')->name('solicitarservicio');
        Route::get('mensajes/{user2}', [ClienteController::class, 'mensajes'])->middleware('can:cliente-ver-mensajes')->name('mensajes');

        #Convierte al cliente en proveedor
        Route::get('convertir-proveedor-view', [ClienteController::class, 'convertirAProveedorview'])->name('convertirAProveedorView');
        Route::get('convertir-proveedor', [ClienteController::class, 'convertirAProveedor'])->name('convertirAProveedor');
    });
    #});
});


# pruebas de consultas -- ingorar
Route::get('/d', function () {
    #$user = User::all()->random();
    #$conversaciones = Conversacion::select('*')
    #        ->join('mensajes', 'mensajes.conversacion_id', '=', 'conversaciones.id')
    #        ->where('mensajes.remitente_id', $user->id)
    #        ->get();

    #$dias = DiasTrabajo::where('proveedor_id', Auth::user()->id)->pluck('dia_semana', 'id');

    $apiKey = 'AIzaSyCPQPf8PLFzC3CdyHzuX8ooThc9krKYrAs';
    $location = '17.0732,-96.7266';
    $radius = 10000;  # Radio en metros
    $url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location={$location}&radius={$radius}&key={$apiKey}";
    $response = file_get_contents($url);
    $json = json_decode($response, true);
    $datos = collect($json['results']);

    $data = [];

    while (count($data) < 8) {

        $place_id = $datos->random()['place_id'];
        $details_url = "https://maps.googleapis.com/maps/api/place/details/json?place_id={$place_id}&key={$apiKey}";
        $response = file_get_contents($details_url);
        $json = json_decode($response, true);

        $data['latitud'] = $json['result']['geometry']['location']['lat'];
        $data['longitud'] = $json['result']['geometry']['location']['lng'];

        foreach ($json['result']['address_components'] as $result) {
            if (in_array('street_number', $result['types'])) {
                $data['num_exterior'] = $result['long_name'];
            }
            if (in_array('route', $result['types'])) {
                $data['calle'] =  $result['long_name'];
            }
            if (in_array('sublocality', $result['types'])) {
                $data['colonia'] = $result['long_name'];
            }
            if (in_array('locality', $result['types'])) {
                $data['municipio'] = $result['long_name'];
            }
            if (in_array('administrative_area_level_1', $result['types'])) {
                $data['estado'] = $result['long_name'];
            }
            if (in_array('postal_code', $result['types'])) {
                $data['codigo_postal'] = $result['long_name'];
            }
        }
    }
    return $data;
    #return $json['result']['address_components'];
    #return $dias->keys()->first();
});
