<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConsultZipCodeController extends Controller
{
    public function consultZipCode($location) {
        $cep = $location;

        $response = Http::get("viacep.com.br/ws/$cep/json/")->json();
        return $response;
    }
}
