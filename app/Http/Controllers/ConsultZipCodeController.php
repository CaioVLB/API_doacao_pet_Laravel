<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConsultZipCodeController extends Controller
{
    public function consultZipCode($location) { //TODO: Agora eu preciso pensar em uma forma de colocar essa consulta tanto n método index, quanto show (para USER e INSTITUITION).
        $cep = $location;

        $response = Http::get("viacep.com.br/ws/$cep/json/")->json();
        dd($response);
    }
}
