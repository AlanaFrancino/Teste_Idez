<?php

namespace App\Http\Controllers;

use App\Exceptions\MunicipiosException;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class MunicipiosController extends Controller
{
    public function Index()
    {
        return view('formmunicipios');
    }

    public function municipiosPorUf($uf)
    {
        try {
            
            $cacheKey = 'municipios-' . $uf;

            $municipios = Cache::remember($cacheKey, 3600, function () use ($uf) {

                $apiUrl = env('API_PROVIDER') === 'BRASILAPI' ?
                    "https://brasilapi.com.br/api/ibge/municipios/v1/$uf" :
                    "https://servicodados.ibge.gov.br/api/v1/localidades/estados/$uf/municipios";

                $response = Http::get($apiUrl);

                if ($response->ok()) {
                    return $response->json();
                } else {
                    throw new MunicipiosException('Não foi possível obter os municípios');
                }
            });

            return $municipios;
        } catch (MunicipiosException $exception) {
            throw $exception;
        } catch (\Throwable $exception) {
            throw new MunicipiosException();
        }
    }

    public function listarMunicipiosPaginados(Request $request)
    {
        $uf = $request->input('uf');
        $municipios = $this->municipiosPorUf($uf);

        $municipiosPaginados = $this->paginate($municipios,$uf,10);
        //dd($municipiosPaginados);
        return view('formmunicipios', compact('municipiosPaginados'));
    }


    private function paginate($items,$uf, $perPage = 10, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page,['path' => url("/municipiosList?uf=$uf")]);
    }
}
