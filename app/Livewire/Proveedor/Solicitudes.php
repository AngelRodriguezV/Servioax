<?php

namespace App\Livewire\Proveedor;

use App\Models\Servicio;
use App\Models\Solicitud;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class Solicitudes extends Component
{
    public function render()
    {
        $servicios = Servicio::select('id')->where('proveedor_id', Auth::user()->id)
            ->whereIn('estatus', ['ACEPTADA', 'EN REVISION'])->get();

        $solicitudes = Solicitud::whereIn('servicio_id', $servicios)->where('fecha', '>=', now()->format('Y-m-d'))->get();

        return view('livewire.proveedor.solicitudes', compact('solicitudes'));
    }
}
