<?php

namespace App\Livewire\Cliente;

use App\Models\Servicio;
use App\Models\User;
use Livewire\Component;
use PhpParser\Node\Expr\Match_;

class Scheduler2 extends Component
{
    public $constante = 0.017453292519943295;
    public $distancia = 5000;
    public $latitude;
    public $longitude;

    protected $listeners = ['setGeolocation'];

    public function setGeolocation($data)
    {
        $this->latitude = $data['latitude'] * $this->constante;
        $this->longitude = $data['longitude'] * $this->constante;

        $this->filterData();
    }

    public function filterData()
    {
        // Aquí puedes realizar la consulta a la base de datos utilizando los datos de geolocalización
        $latitud = 1 * $this->constante;
        $longitud = 1 * $this->constante;
        $distanciaLatitud = $this->latitude - $latitud;
        $distanciaLongitud = $this->longitude - $longitud;
        $distancia = sqrt(pow($distanciaLatitud, 2) + pow($distanciaLongitud, 2));

        // Puedes hacer algo con los datos obtenidos, como pasarlos a la vista
    }

    public function render()
    {
        #$apiKey = 'AIzaSyCPQPf8PLFzC3CdyHzuX8ooThc9krKYrAs';
        #$address = urlencode('Calle Durango, Oaxaca City, Oaxaca de Juárez, Oaxaca, 68030');
        #$url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$apiKey}";
        #$response = file_get_contents($url);
        #$json = json_decode($response, true);
        #$lad = $json['results'][0]['geometry']['location']['lat'];
        #$log = $json['results'][0]['geometry']['location']['lng'];
        $proveedores = User::select('id')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Proveedor');
            })
            ->whereHas('documento', function ($query) {
                $query->whereIn('estatus', ['ACEPTADA', 'EN REVISION']);
            })
            ->get();
        $servicios = Servicio::whereIn('proveedor_id', $proveedores)->where('estatus', 'ACEPTADA')->get();
        $servicios = $servicios->filter(function($servicio) {
            $latitud2 = $servicio->proveedor->documento->direccion->latitud * 0.017453292519943295;
            $longitud2 = $servicio->proveedor->documento->direccion->longitud * 0.017453292519943295;
            $distanciaLatitud = $latitud2 - $this->latitude;
            $distanciaLongitud = $longitud2 - $this->longitude;
            $distancia2 = sqrt(pow($distanciaLatitud, 2) + pow($distanciaLongitud, 2));
            return $distancia2 <= $this->distancia;
        });
        return view('livewire.cliente.scheduler2', compact('servicios'));
    }
}
