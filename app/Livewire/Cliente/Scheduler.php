<?php

namespace App\Livewire\Cliente;

use App\Livewire\Proveedor\Horarios;
use App\Models\DiasTrabajo;
use App\Models\Horario;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Scheduler extends Component
{
    public $semanas = [
        '1' => 'Lunes',
        '2' => 'Martes',
        '3' => 'Miercoles',
        '4' => 'Jueves',
        '5' => 'Viernes',
        '6' => 'Sabado',
        '7' => 'Domingo'];
    public $meses = [
        '1' => 'Enero',
        '2' => 'Febrero',
        '3' => 'Marzo',
        '4' => 'Abril',
        '5' => 'Mayo',
        '6' => 'Junio',
        '7' => 'Julio',
        '8' => 'Agosto',
        '9' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre'];

    public $diasDisponibles;
    public $horasDisponibles;

    public $currentDateTime;
    public $inicioCalendario;
    public $finCalendario;
    public $fecha;

    public function mount()
    {
        $this->currentDateTime = now();
        $this->inicioCalendario = $this->currentDateTime->copy();
        $this->finCalendario = $this->inicioCalendario->copy()->addDays(6);
        $this->fecha = $this->currentDateTime->copy();
        $this->diasDisponibles = collect(DiasTrabajo::select('N')->where('proveedor_id', Auth::user()->id)->get())->pluck('N');
        $this->horasDisponibles = Horario::whereIn('dia_trabajo_id', DiasTrabajo::select('id')->where('proveedor_id', Auth::user()->id)->get())
            ->get();

    }

    public function incrementar()
    {
        $this->inicioCalendario = $this->finCalendario->copy()->addDays(1);
        $this->finCalendario = $this->inicioCalendario->copy()->addDays(6);
    }

    public function decrementar()
    {
        $this->finCalendario = $this->finCalendario->copy()->subDays(7);
        $this->inicioCalendario = $this->finCalendario->copy()->subDays(6);
        if ($this->finCalendario < $this->currentDateTime)
        {
            $this->inicioCalendario = $this->currentDateTime->copy();
            $this->finCalendario = $this->inicioCalendario->copy()->addDays(6);
        }
    }

    public function validarDia($valor)
    {
        $validacion = $this->diasDisponibles->contains(function ($elemento) use ($valor) {
            return $elemento['N'] == $valor;
        });
        return $validacion ? ' ' : 'disabled';
    }

    public function render()
    {
        return view('livewire.cliente.scheduler');
    }
}
