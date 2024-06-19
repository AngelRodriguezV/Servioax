<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Direccion>
 */
class DireccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $apiKey = 'AIzaSyCPQPf8PLFzC3CdyHzuX8ooThc9krKYrAs';
        $location = '17.0732,-96.7266';
        $radius = 10000;  # Radio en metros
        $url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location={$location}&radius={$radius}&key={$apiKey}";
        $response = file_get_contents($url);
        $json = json_decode($response, true);
        $datos = collect($json['results']);

        $data = [];

        while (count($data) < 7) {

            $place_id = $datos->random()['place_id'];
            $details_url = "https://maps.googleapis.com/maps/api/place/details/json?place_id={$place_id}&key={$apiKey}";
            $response = file_get_contents($details_url);
            $json = json_decode($response, true);

            $data['latitud'] = $json['result']['geometry']['location']['lat'];
            $data['longitud'] = $json['result']['geometry']['location']['lng'];

            foreach ($json['result']['address_components'] as $result) {
                if (in_array('street_number', $result['types'])) {
                    $data['num_exterior'] = $result['long_name'];
                }
                if (in_array('route', $result['types'])) {
                    $data['calle'] =  $result['long_name'];
                }
                if (in_array('sublocality', $result['types'])) {
                    $data['colonia'] = $result['long_name'];
                }
                if (in_array('locality', $result['types'])) {
                    $data['municipio'] = $result['long_name'];
                }
                if (in_array('administrative_area_level_1', $result['types'])) {
                    $data['estado'] = $result['long_name'];
                }
                if (in_array('postal_code', $result['types'])) {
                    $data['codigo_postal'] = $result['long_name'];
                }
            }
        }
        $data['num_interior'] = 0;
        $data['referencias'] = fake()->text(30);
        $data['entre_calle1'] = '';
        $data['entre_calle2'] = '';
        return $data;
    }
}
