<?php

namespace App\Livewire;

use App\Models\Servicio;
use Livewire\Component;
use Illuminate\Support\Carbon;

class Calendario extends Component
{

    public $currentDateTime;

    public $servicio;

    public $inicioCalendario;
    public $finCalendario;
    public $fecha;
    public $etiquetaDias = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];
    public $meses = [
        1 => 'Enero',
        2 => 'Febrero',
        3 => 'Marzo',
        4 => 'Abril',
        5 => 'Mayo',
        6 => 'Junio',
        7 => 'Julio',
        8 => 'Agosto',
        9 => 'Septiembre',
        10 => 'Octubre',
        11 => 'Noviembre',
        12 => 'Diciembre',
    ];

    public function mount(Servicio $servicio)
    {
        $this->servicio = $servicio;
        $this->currentDateTime = now();

        $this->inicioCalendario = $this->currentDateTime->copy()->firstOfMonth()->startOfWeek(Carbon::SUNDAY);
        $this->finCalendario = $this->currentDateTime->copy()->lastOfMonth()->endOfWeek(Carbon::SATURDAY);
        $this->fecha = $this->currentDateTime->copy();
    }

    public function incrementar()
    {
        $aux = $this->currentDateTime->copy()
            ->addMonth();

        if ($aux->format('Y-m') >= $this->fecha->format('Y-m')) {
            $this->currentDateTime = $aux;
        }
        $this->inicioCalendario = $this->currentDateTime->copy()
            ->firstOfMonth()
            ->startOfWeek(Carbon::SUNDAY);
        $this->finCalendario = $this->currentDateTime->copy()
            ->lastOfMonth()
            ->endOfWeek(Carbon::SATURDAY);
    }

    public function decrementar()
    {
        $aux = $this->currentDateTime->copy()
            ->subMonth();

        if ($aux->format('Y-m') >= $this->fecha->format('Y-m')) {
            $this->currentDateTime = $aux;
        }
        $this->inicioCalendario = $this->currentDateTime->copy()
            ->firstOfMonth()
            ->startOfWeek(Carbon::SUNDAY);
        $this->finCalendario = $this->currentDateTime->copy()
            ->lastOfMonth()
            ->endOfWeek(Carbon::SATURDAY);
    }

    public function render()
    {
        return view('livewire.calendario');
    }
}
