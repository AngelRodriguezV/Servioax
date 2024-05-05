<?php

namespace App\Http\Controllers;

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
}
