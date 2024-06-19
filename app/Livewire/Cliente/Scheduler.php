<?php

namespace App\Livewire\Cliente;

use App\Models\DiasTrabajo;
use App\Models\Horario;
use App\Models\Servicio;
use App\Models\Solicitud;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Scheduler extends Component
{
    public $semanas = [
        '1' => 'Lunes',
        '2' => 'Martes',
        '3' => 'Miércoles',
        '4' => 'Jueves',
        '5' => 'Viernes',
        '6' => 'Sábado',
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
    public $horasOcupadas;

    public $currentDateTime;
    public $inicioCalendario;
    public $finCalendario;

    public $date_times = '';
    public $value = ['','',''];
    public $modal = false;

    public $selectedMonth;
    public $nextMonths;

    public function mount(User $proveedor)
    {
        $this->currentDateTime = now();
        $this->inicioCalendario = $this->currentDateTime->copy();
        $this->finCalendario = $this->inicioCalendario->copy()->addDays(6);
        $this->diasDisponibles = collect(DiasTrabajo::select('N')->where('proveedor_id', $proveedor->id)->get())->pluck('N');
        $this->horasDisponibles = Horario::whereIn('dia_trabajo_id', DiasTrabajo::select('id')->where('proveedor_id', $proveedor->id)->get())
            ->get();
        $this->horasOcupadas = Solicitud::whereIn('servicio_id', Servicio::select('id')->where('proveedor_id', $proveedor->id)->get())
            ->where('estatus', '!=', 'RECHAZADA')
            ->Where('estatus', '!=', 'CANCELADA')
            ->get();

        $this->nextMonths = collect();
        for ($i = 0; $i < 12; $i++) {
            $monthDate = Carbon::now()->addMonthsNoOverflow($i);
            $this->nextMonths->push([
                'value' => $monthDate->format('Y-m'),
                'name' => $this->meses[$monthDate->format('n')] . ' ' . $monthDate->format('Y')
            ]);
        }
    }

    public function updatedSelectedMonth($value)
    {
        $selectedDate = Carbon::createFromFormat('Y-m', $value);
        if ($selectedDate->greaterThanOrEqualTo(Carbon::now())) {
            $this->inicioCalendario = $selectedDate->copy()->startOfMonth();
            $this->finCalendario = $this->inicioCalendario->copy()->addDays(6);
        }
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
        if ($this->finCalendario < $this->currentDateTime) {
            $this->inicioCalendario = $this->currentDateTime->copy();
            $this->finCalendario = $this->inicioCalendario->copy()->addDays(6);
        }
    }

    public function select($value)
    {
        $this->date_times = $value;
        $this->value = explode('/', $value);
        $this->modal = true;
    }

    public function cancel()
    {
        $this->date_times = '';
        $this->modal = false;
    }

    public function save()
    {
        // Implementa la lógica para guardar la selección
        $this->modal = false;
    }

    public function render()
    {
        $this->inicioCalendario = $this->finCalendario->copy()->subDays(6);
        return view('livewire.cliente.scheduler');
    }
}
