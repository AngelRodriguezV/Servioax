<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Servicio;

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
            return "Este proveedor no existe!!!";
        }
    }

    public function verPerfil()
    {
        return view('admin.perfil');
    }

    public function aprobarCuentas()
    {
        return view('admin.aprobar');
    }
}
