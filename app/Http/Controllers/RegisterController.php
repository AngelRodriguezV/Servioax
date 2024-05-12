<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;

class RegisterController extends Controller
{
    public function register()
    {
        if (Auth::user()->getRoleNames()) {
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }

    public function registerUser(UserRequest $request)
    {

        return redirect()->route('tipo-usuario');
    }

    public function tipoUsuario(Request $request)
    {
        if (Auth::user()->getRoleNames()) {
            return redirect()->route('dashboard');
        }
        if ($request) {
            if ($request['tipo'] == 'cliente') {
                Auth::user()->assignRole('Cliente');
                return redirect()->route('dashboard');
            } if ($request['tipo'] == 'proveedor') {
                Auth::user()->assignRole('Proveedor');
                return view('auth.asignarRol');
            }
        }
        return view('auth.asignarRol');
    }


}
