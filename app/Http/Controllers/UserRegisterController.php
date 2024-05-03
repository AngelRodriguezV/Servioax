<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserRegisterController extends Controller
{
    public function subirId()
    {
        return view('auth.subir-identificacion');
    }

    public function elegirRol()
    {
        return view('auth.elegir-rol');
    }

    public function asignarRol()
    {

    }
}
