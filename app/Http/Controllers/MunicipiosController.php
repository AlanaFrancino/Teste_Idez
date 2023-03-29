<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class MunicipiosController extends Controller
{
    public function municipiosPorUf($uf)
    {
        $cacheKey = 'municipios-' . $uf;

        $municipios = Cache::remember($cacheKey, 3600, function () use ($uf) {

            $apiUrl = env('API_PROVIDER') === 'BRASILAPI' ?
                "https://brasilapi.com.br/api/ibge/municipios/v1/$uf" :
                "https://servicodados.ibge.gov.br/api/v1/localidades/estados/$uf/municipios";

            $response = Http::get($apiUrl);
            $municipios = collect($response->json())->map(function ($municipio) {
                    return [
                        'name' => $municipio['nome'],
                        'ibge_code' => $municipio['ibge'] ?? null,
                    ];
            });

            return response()->json($municipios);
        });

        return response()->json($municipios);
    }

}
