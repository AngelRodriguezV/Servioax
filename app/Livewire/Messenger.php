<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Conversacion;
use App\Models\Mensaje;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Messenger extends Component
{
    public $conversacion_actual;

    public $conversaciones;

    public $mensaje = '';

    public function mount(User $user2)
    {
        $this->conversaciones = Auth::user()->conversaciones;

        if (Auth::user()->id != $user2->id) {

            foreach ($this->conversaciones as $conversacion) {
                foreach ($conversacion->users as $user) {
                    if ($user->id == $user2->id) {
                        $this->conversacion_actual = $conversacion;
                        break;
                    }
                }
            }

            if ($this->conversacion_actual == null) {
                $this->conversacion_actual = Conversacion::create(['estatus' => 'ACTIVA']);
                $this->conversacion_actual->users()->attach(Auth::user()->id);
                $this->conversacion_actual->users()->attach($user2->id);
            }
        } else {
            $this->conversacion_actual = null;
        }
    }

    public function setConversacion(Conversacion $conversacion)
    {
        $this->conversacion_actual = $conversacion;
    }

    public function hydrate()
    {
        //$this->conversacion_actual = Conversacion::where('id', $this->conversacion_actual->id)->get()[0];
        $this->conversaciones = Auth::user()->conversaciones;
    }

    public function render()
    {
        $this->conversaciones = Auth::user()->conversaciones;
        return view('livewire.messenger');
    }

    public function save_mensaje()
    {
        Mensaje::create([
            'remitente_id' => Auth::user()->id,
            'conversacion_id' => $this->conversacion_actual->id,
            'mensaje' => $this->mensaje,
            'estatus' => 'enviado',
        ]);
        $this->mensaje = "";
    }
}
