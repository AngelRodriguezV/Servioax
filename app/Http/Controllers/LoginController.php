<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function login()
    {
        if (auth()->user()->hasRole('Admin')) {
            return "Es admin";
        }
        if (auth()->user()->hasRole('Proveedor')) {
            return "Es Proveedor";
        }
        if (auth()->user()->hasRole('Cliente')) {
            return redirect()->route('cliente.dashboard');
        } else {
            return "No tienes roll asignado";
        }

    }

}
