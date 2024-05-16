<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function dashboard()
    {
        return view('proveedor.dashboard');
    }

    public function perfil()
    {
        return view('proveedor.perfil');
    }

    public function direcciones()
    {
        return view('proveedor.direcciones');
    }

    public function horarios()
    {
        return view('proveedor.horarios');
    }

    public function mensajes(User $user2)
    {
        return view('proveedor.mensajes', compact('user2'));
    }

    public function abrobarSolicitud(Solicitud $solicitud) {
        return view('proveedor.aprobar', compact('solicitud'));
    }
}
