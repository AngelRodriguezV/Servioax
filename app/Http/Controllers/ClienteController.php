<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Horario;
use App\Models\Servicio;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

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
        $data = explode('/',$request['date-times']);
        $request['fecha'] = $data[0];
        $request['hora_inicio'] = $data[1];
        $request['hora_termino'] = $data[2];
        $request['estatus'] = 'NUEVA';
        $request['cliente_id'] = Auth::user()->id;
        Solicitud::create($request->all());
        return redirect()->route('cliente.solicitudes');
    }

    public function mensajes(User $user2)
    {
        return view('cliente.mensajes', compact('user2'));
    }
}
