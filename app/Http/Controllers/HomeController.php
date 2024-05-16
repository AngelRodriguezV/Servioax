<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Servicio;
use App\Models\User;
use App\Models\Valoracion;

class HomeController extends Controller
{
    public function index() {
        $proveedores = User::select('id')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Proveedor');
            })
            ->whereHas('documento', function ($query) {
                $query->whereIn('estatus', ['ACEPTADA', 'EN REVISION']);
            })
            ->get();

        $categorias = Categoria::all();
        $servicios = Servicio::whereIn('proveedor_id', $proveedores)
            ->where('estatus', 'ACEPTADA')->latest('updated_at')->get();
        return view('welcome', compact('categorias', 'servicios'));
    }

    public function categorias() {
        return view('cliente.categorias');
    }

    public function categoria(Categoria $categoria) {
        return view('categoria', compact('categoria'));
    }

    public function servicios() {
        return view('cliente.servicios');
    }

    public function servicio(Servicio $servicio) {
        $valoraciones = Valoracion::where('servicio_id', $servicio->id)
        ->latest('valoracion')
        ->get();

        $sv_pros = Servicio::where('proveedor_id', $servicio->proveedor_id)
        ->where('id', '!=', $servicio->id)
        ->where('estatus', 'ACEPTADA')
        ->get();

        $sv_siml = Servicio::where('categoria_id', $servicio->categoria_id)
        ->where('proveedor_id', '!=', $servicio->proveedor_id)
        ->where('estatus', 'ACEPTADA')
        ->get();

        $ratings = $servicio->ratings();
        $total = 0;
        foreach ($ratings as $valor) {
            $total += $valor['rating'];
        }
        $rating = [];
        for ($i=5; $i > 0; $i--) {
            $rt = 0;
            foreach ($ratings as $valor) {
                if ($valor['valoracion'] == $i) {
                    $rt = $valor['rating'];
                }
            }
            array_push($rating, [
                'estrellas' => $i,
                'porcentaje' => ($rt==0 ) ? 0 : ($rt*100)/$total
            ]);
        }

        return view('cliente.servicio', compact('servicio', 'valoraciones', 'sv_pros', 'rating'));
    }

    public function proveedores() {
        return view('cliente.proveedores');
    }

    public function proveedor(User $proveedor) {
        return view('cliente.proveedor', compact('proveedor'));
    }

    public function proveedoresServicio() {
        return view('cliente.proveedores-servicio');
    }
}
