<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Servicio;
use App\Models\Categoria;
use App\Http\Requests\ServicioRequest;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedors = User::role('Proveedor')->get()->random();
        $servicios = Servicio::where('proveedor_id',$proveedors->id)->get();
        return view('proveedor.index', compact('proveedors', 'servicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::pluck('nombre', 'id');
        return view('proveedor.servicios.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio)
    {
       /* $proveedors = User::role('Proveedor')->get()->random();
        $servicios = Servicio::where('proveedor_id',$proveedors->id)->get();
        return view('proveedor.servicios.show',compact('id','proveedors', 'servicios'));*/
        $categorias = Categoria::pluck('nombre', 'id');
        return view('proveedor.servicios.show', compact('servicio', 'categorias'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {
        $categorias = Categoria::pluck('nombre', 'id');
        return view('proveedor.servicios.edit', compact('servicio', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServicioRequest $request, Servicio $servicio)
    {
        return "Esta autorizado";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
