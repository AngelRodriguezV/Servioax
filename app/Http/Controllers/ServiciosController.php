<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Categoria;
use App\Http\Requests\ServicioRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('proveedor.servicios.index');
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
        $request['categoria_id'] = $request['categoria'];
        $request['slug'] = Str::slug($request['nombre']);
        $request['estatus'] = 'NUEVA';
        $request['proveedor_id'] = Auth::user()->id;
        $servicio = Servicio::create($request->all());

        if ($request->file('file')) {
            $url = Storage::disk('public')->put('servicio', $request->file('file'));
            $servicio->image()->create([
                'url' => $url
            ]);
        }
        return redirect()->route('proveedor.servicios.index');
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
        $request['categoria_id'] = $request['categoria'];
        $request['slug'] = Str::slug($request['nombre']);
        $request['estatus'] = 'EN REVISION';

        $servicio->update($request->all());

        if ($request->file('file')) {
            $url = Storage::disk('public')->put('servicio', $request->file('file'));
            if ($servicio->image) {
                Storage::disk('public')->delete($servicio->image->url);
                $servicio->image->update([
                    'url' => $url
                ]);
            } else {
                $servicio->image()->create([
                    'url' => $url
                ]);
            }
        }
        return redirect()->route('proveedor.servicios.show', $servicio);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return redirect()->route('proveedor.servicios.index');
    }
}
