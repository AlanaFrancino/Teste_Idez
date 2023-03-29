<?php

namespace App\Exceptions;

use Exception;

class MunicipiosException extends Exception
{
    public function render($request)
    {
        return response()->json(['error' => 'Erro ao buscar municípios'], 500);
    }
}
