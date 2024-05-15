<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Servicio;
use App\Models\Categoria;
use App\Models\Image;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function administrarProv()
    {
        #$servicios = Servicio::where('proveedor_id', $proveedors->id)->get();
        return view('admin.proveedores');
        #return view('admin.proveedores');
    }

    public function administrarCli()
    {
        return view('admin.clientes');
    }

    public function gestionarServicios(User $proveedor)
    {
        if ($proveedor->hasRole('Proveedor')) {
            return view('admin.servicios-gestion', compact('proveedor'));
        } else {
            return redirect()->route('admin.adminProv');
        }
    }

    public function aprobarServicio(User $proveedor, Servicio $servicio)
    {
        return view('admin.aprobarServicio', compact('proveedor','servicio'));
    }

    public function verPerfil()
    {
        return view('admin.perfil');
    }

    public function aprobarCuentas($id)
    {
        $proveedor = User::role('Proveedor')->find($id);
        if ($proveedor) {
            $servicios = Servicio::where('proveedor_id', $proveedor->id)->get();
            return view('admin.aprobar', compact('proveedor', 'servicios'));
        }else {
            return redirect()->route('admin.adminProv');
        }
    }

    public function gestionCategorias(){


        return view('admin.gestionCategorias');
    }

    public function crearCategoria()
    {
        return view('admin.crearCategoria');
    }

    public function editarCategoria(Categoria $categoria){
        return view('admin.editarCategoria', compact('categoria'));
    }

    public function actualizarCategoria(Request $request, Categoria $categoria)
    {
        // Validar los datos del request
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'file' => 'image',
        ]);

        $data['slug'] = Str::slug($data['nombre']);
        $categoria->update($data);

        if ($request->file('file')) {
            $url = Storage::disk('public')->put('categoria', $request->file('file'));
            if ($categoria->image) {
                Storage::disk('public')->delete($categoria->image->url);
                $categoria->image->update([
                    'url' => $url
                ]);
            } else {
                $categoria->image()->create([
                    'url' => $url,
                ]);
            }
        }
        return redirect()->route('admin.gestionCategorias');
    }

    public function storeCategoria(Request $request)
    {
        // Validar los datos del request
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'file' => 'required|image',
        ]);

        // Generar el slug a partir del nombre
        $data['slug'] = Str::slug($data['nombre']);

        // Crear una nueva categoria
        $categoria = Categoria::create($data);

        if ($request->file('file')) {
            $url = Storage::disk('public')->put('categoria', $request->file('file'));
            $categoria->image()->create([
                'url' => $url
            ]);
        }
        return redirect()->route('admin.gestionCategorias');
    }

    public function cambiarEstadoCategoria(Request $request, Categoria $categoria)
    {
        //Arreglar pendiente
        $categoria = Categoria::where('estado', true)->first();
        $categoria->estado = !$categoria->estado;
        $categoria->save();

        // Redirigir al usuario a la página anterior con un mensaje de éxito
        return back()->with('status', 'El estado de la categoría ha sido cambiado exitosamente.');
    }

    public function mensajes(User $user2)
    {
        return view('admin.mensajes', compact('user2'));
    }
}
