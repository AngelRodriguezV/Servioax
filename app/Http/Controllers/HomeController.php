<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Servicio;
use App\Models\Valoracion;

class HomeController extends Controller
{
    public function index() {
        $categorias = Categoria::all();
        $servicios = Servicio::all();
        return view('welcome', compact('categorias', 'servicios'));
    }

    public function categorias() {
        return view('cliente.categorias');
    }

    public function categoria(Categoria $categoria) {
        return view('categoria', compact('categoria'));
    }

    public function servicio(Servicio $servicio) {
        $valoraciones = Valoracion::where('servicio_id', $servicio->id)
        ->latest('valoracion')
        ->get();

        $sv_pros = Servicio::where('proveedor_id', $servicio->proveedor_id)
        ->where('id', '!=', $servicio->id)
        ->get();

        $sv_siml = Servicio::where('categoria_id', $servicio->categoria_id)
        ->where('proveedor_id', '!=', $servicio->proveedor_id)
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
                'porcentaje' => ($rt*100)/$total
            ]);        
        }


        return view('cliente.servicio', compact('servicio', 'valoraciones', 'sv_pros', 'rating'));
    }
}
