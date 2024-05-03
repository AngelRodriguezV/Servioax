<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Conversacion;
use App\Models\Mensaje;
use App\Models\User;

class Messenger extends Component
{
    public $conversacion_actual;

    public $conversaciones;

    public $mensaje = '';

    public function mount(User $proveedor)
    {
        $query = Conversacion::join('conversacion_user', 'conversacion_user.conversacion_id', '=', 'conversaciones.id')
            ->where('user_id', auth()->user()->id)
            ->where('user_id', $proveedor->id)->first();
        if ($query) {
            $this->conversacion_actual = $query;
        } else {
            $this->conversacion_actual = Conversacion::create(['estatus' => 'ACTIVA']);
            $this->conversacion_actual->users()->attach(auth()->user()->id);
            $this->conversacion_actual->users()->attach($proveedor->id);
        }
        $this->conversaciones = auth()->user()->conversaciones;

    }

    public function hydrate()
    {
        $this->conversacion_actual = Conversacion::where('id', $this->conversacion_actual->id)->get()[0];
    }


    public function setConversacion(Conversacion $conversacion)
    {
        $this->conversacion_actual = $conversacion;
    }

    public function render()
    {
        return view('livewire.messenger');
    }

    public function save_mensaje()
    {
        Mensaje::create([
            'remitente_id' => auth()->user()->id,
            'conversacion_id' => $this->conversacion_actual->id,
            'mensaje' => $this->mensaje,
            'estatus' => 'enviado',
        ]);
        $this->mensaje = "";
    }
}
