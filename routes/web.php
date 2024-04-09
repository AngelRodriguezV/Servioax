<?php

use App\Http\Controllers\HomeController;
use App\Models\Direccion;
use App\Models\Servicio;
use App\Models\User;
use App\Models\Valoracion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

# Vistas que se muestran al cliente
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('categorias/{categoria}', [HomeController::class, 'categoria'])->name('categorias');

Route::get('servicios', [HomeController::class, 'servicios'])->name('servicios');
Route::get('servicio/{servicio}', [HomeController::class, 'servicio'])->name('servicio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/d', function() {
    $servicio = Servicio::all()->random();
    $valoracion = Valoracion::select('valoracion', DB::raw('count(*) as rating'))
        ->groupBy('valoracion')
        ->where('servicio_id', $servicio->id)
        ->latest('rating')
        ->get();
    return $servicio->ratings();
});