<?php

namespace App\Http\Controllers;

use App\Models\DiasTrabajo;
use App\Models\Direccion;
use App\Models\Horario;
use App\Models\Servicio;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Notifications\SolicitudNotification;
use App\Events\SolicitudEvent;

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
        #Validar la hora
        $data = explode(',', $request['date-times']);
        $data2 = explode('-', $data[0]);
        $fecha = now()->setDate($data2[0], $data2[1], $data2[2]);
        $proveedor = Servicio::find($request['servicio_id'])->proveedor;
        $dia_semana = DiasTrabajo::where('proveedor_id', $proveedor->id)->where('N', $fecha->format('N'))->first();
        $valido = false;
        if ($dia_semana) {
            $hora = Horario::where('dia_trabajo_id', $dia_semana->id)
                ->where('hora_apertura', $data[1])
                ->where('hora_cierre', $data[2])
                ->first();
            if ($hora) {
                $valido = true;
            }
        }

        $horaOcupada = Solicitud::whereIn('servicio_id', Servicio::select('id')->where('proveedor_id', $proveedor->id)->get())
            ->where('fecha', $data[0])
            ->where('hora_inicio', $data[1])
            ->where('hora_termino', $data[2])
            ->where('estatus', '!=', 'RECHAZADA')
            ->Where('estatus', '!=', 'CANCELADA')
            ->first();
        if ($horaOcupada) {
            $valido = true;
        }

        if (!$valido) {
            return redirect()->back()->withErrors("La hora que selecciono ya no esta disponible")->withInput();
        }

        $request['fecha'] = $data[0];
        $request['hora_inicio'] = $data[1];
        $request['hora_termino'] = $data[2];
        $request['estatus'] = 'NUEVA';
        $request['cliente_id'] = Auth::user()->id;
        $request['direccion_id'] = Auth::user()->documento->direccion_id;
        $solicitud = Solicitud::create($request->all());

        //Envio de la notificacion de solicitud de un servicio al proveedor
        //$proveedor->notify(new SolicitudNotification($solicitud));
        event(new SolicitudEvent($solicitud));
        return redirect()->route('cliente.solicitudes');
    }

    public function mensajes(User $user2)
    {
        return view('cliente.mensajes', compact('user2'));
    }
}
