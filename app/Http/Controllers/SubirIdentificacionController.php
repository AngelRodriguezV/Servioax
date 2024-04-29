<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubirIdentificacionController extends Controller
{
    public function subirId()
    {
        return view('auth.subir-identificacion');
    }
}
