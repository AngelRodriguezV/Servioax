<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrarUsuarioController extends Controller
{
    public function elegirRol()
    {
        return view('auth.elegir-rol');
    }

    public function asignarRol()
    {
        
    }
}
