<?php

namespace App\Livewire\Cliente;

use App\Models\Solicitud;
use App\Models\Valoracion;
use Livewire\Component;

class ValoracionForm extends Component
{

    public $solicitud;
    public $valoracion;
    public $comentario;
    public $rating = 0;
    public $mensaje = '';

    public function mount(Solicitud $solicitud)
    {
        $this->solicitud = $solicitud;
        $query = Valoracion::where('servicio_id', $this->solicitud->servicio->id)->where('user_id', auth()->user()->id)->first();
        if ($query){
            $this->valoracion = $query;
            $this->rating = $this->valoracion->valoracion;
            $this->comentario = $this->valoracion->comentario;
        }
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    public function save()
    {
        if ($this->valoracion) {
            $this->valoracion->update([
                'comentario' => $this->comentario,
                'valoracion' => $this->rating,
                'user_id' => auth()->user()->id,
                'servicio_id'=> $this->solicitud->servicio->id
            ]);
            $this->mensaje = "Se actualizo tu valoración";
        } else {
            $this->valoracion = Valoracion::create([
                'comentario' => $this->comentario,
                'valoracion' => $this->rating,
                'user_id' => auth()->user()->id,
                'servicio_id'=> $this->solicitud->servicio->id
            ]);
            $this->mensaje = "Se añadio tu valoración";
        }
    }

    public function render()
    {
        return view('livewire.cliente.valoracion-form');
    }
}
