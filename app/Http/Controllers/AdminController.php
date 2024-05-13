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
        $proveedors = User::role('Proveedor')->get();
        #$servicios = Servicio::where('proveedor_id', $proveedors->id)->get();
        return view('admin.proveedores', compact('proveedors'));
        #return view('admin.proveedores');
    }

    public function administrarCli()
    {
        $clientes = User::role('Cliente')->get();
        return view('admin.clientes', compact('clientes'));
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
