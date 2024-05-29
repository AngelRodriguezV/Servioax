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
        $proveedor = Servicio::find($request['servicio_id'])->proveedor;
        $servicios = Servicio::select('id')->where('proveedor_id', $proveedor->id)->get();
        $old_times = Solicitud::whereIn('servicio_id', $servicios)->where('fecha', $request['fecha'])->get();
        $valido = true;
        foreach ($old_times as $time) {
            if (
                ($request['hora_inicio'] <= $time->hora_termino && $request['hora_inicio'] >= $time->hora_inicio)
                || ($request['hora_termino'] <= $time->hora_termino && $request['hora_termino'] >= $time->hora_inicio)
                || ($time->hora_inicio <= $request['hora_termino'] && $time->hora_inicio >= $request['hora_inicio'])
                || ($time->hora_termino <= $request['hora_termino'] && $time->hora_termino >= $request['hora_inicio'])
            ) {
                $valido = false;
                break;
            }
        }
        if (!$valido) {
            return redirect()->back()->withErrors("La hora que selecciono ya no esta disponible")->withInput();
        }
        $request['cliente_id'] = Auth::user()->id;
        $request['estatus'] = 'NUEVA';
        $request['direccion_id'] = $request['direccion'];
        Solicitud::create($request->all());
        return redirect()->route('cliente.solicitudes');
    }

    public function mensajes(User $user2)
    {
        return view('cliente.mensajes', compact('user2'));
    }
}
