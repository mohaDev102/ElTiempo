<?php

namespace App\Http\Controllers;

use App\Models\Municipios;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Inertia\Inertia;

class WeatherController extends Controller
{
    public function index()
    {
        $municipios = Municipios::selectRaw("id, CONCAT(CPRO, CMUN) as municipio, NOMBRE as nombre")
        ->get();
        return Inertia::render('Weather', [
            'municipios' => $municipios
        ]);
    }
    public function getWeather($municipio)
    {
        $client = new Client();
        $response = $client->request('GET', "https://opendata.aemet.es/opendata/api/prediccion/especifica/municipio/diaria/$municipio", [
            'headers' => [
                'Authorization' => 'api_key ' . env('API_KEY_AEMET'),
            ]
        ]);
        $body = $response->getBody();
        $content = $body->getContents();
        $data = json_decode($content, true);
        if (isset($data['datos'])) {
            $weatherResponse = $client->request('GET', $data['datos']);
            if ($weatherResponse->getStatusCode() === 200) {
                $weatherContent = $weatherResponse->getBody()->getContents();
                $weatherContentUtf8 = mb_convert_encoding($weatherContent, 'UTF-8', 'ISO-8859-15');
                $weatherData = json_decode($weatherContentUtf8, true);
                return Inertia::render('Weather', ['weatherData' => $weatherData]);
            } else {
                return response()->json(['error' => 'No se pudo obtener la información.'], 500);
            }
        } else {
            return response()->json(['error' => 'La respuesta no contiene URL con los datos.'], 500);
        }
    }
}
