<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function login()
    {
        if (auth()->user()->hasRole('Admin')) {
            return redirect()->route('admin.dashboard');
        }
        if (auth()->user()->hasRole('Proveedor')) {
            return redirect()->route('proveedor.dashboard');
        }
        if (auth()->user()->hasRole('Cliente')) {
            return redirect()->route('cliente.dashboard');
        } else {
            return redirect()->route('tipo-usuario');
        }

    }

}
