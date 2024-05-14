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

    public function gestionarServicios($id)
    {
        $proveedor = User::role('Proveedor')->find($id);
        if ($proveedor) {
            $servicios = Servicio::where('proveedor_id', $proveedor->id)->get();
            return view('admin.servicios-gestion', compact('proveedor', 'servicios'));
        } else {
            return redirect()->route('admin.adminProv');
        }
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

    public function editarCategoria($id){
        $categorias = Categoria::where('id', $id)->first();
        return view('admin.editarCategoria', compact('categorias'));
    }

    public function actualizarCategoria(Request $request, Categoria $categoria)
    {
        //Funcionalidad Pendiente
        return redirect()->route('admin.gestionCategorias');
    }

    public function storeCategoria(Request $request)
    {
        // Validar los datos del request
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required|image',
        ]);

        // Generar el slug a partir del nombre
        $data['slug'] = Str::slug($data['nombre']);

        // Guardar la imagen en el directorio especificado y obtener su ruta
        $rutaImagen = $request->file('imagen')->store('public/image/');

        // Crear una nueva categoria
        $categoria = new Categoria;
        $categoria->nombre = $data['nombre'];
        $categoria->descripcion = $data['descripcion'];
        $categoria->slug = $data['slug'];

        // Guardar la categoria
        $categoria->save();

        $categoria->image()->create([
            'url' => $rutaImagen,
        ]);

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
}
