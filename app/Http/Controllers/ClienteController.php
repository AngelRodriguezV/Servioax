<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Servicio;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function solicitarServicio(Servicio $servicio)
    {
        $direcciones = auth()->user()->direcciones;
        return view('cliente.solicitar-servicio', compact('servicio', 'direcciones'));
    }

    public function dashboard()
    {
        return view('cliente.dashboard');
    }

    public function solicitudes()
    {
        return view('cliente.solicitudes');
    }

    public function direcciones()
    {
        return view('cliente.direcciones');
    }

    public function perfil()
    {
        return view('cliente.perfil');
    }

    public function soporte()
    {
        return view('cliente.soporte');
    }

    public function solicitud(Solicitud $solicitud)
    {
        return view('cliente.solicitud', compact('solicitud'));
    }

    public function saveSolicitud(Request $request)
    {
        return $request;
    }
}