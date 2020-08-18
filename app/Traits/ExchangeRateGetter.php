<?php

namespace App\Traits;

use App\Symbol;
use App\Traits\Strategies\Clp_Eur;
use App\Traits\Strategies\Clp_Usd;
use App\Traits\Strategies\Eur_Clp;
use App\Traits\Strategies\Usd_Clp;
use App\Traits\Strategies\YadioApi;
use App\Traits\Strategies\Clp_Usd_Cop;
use App\Traits\Strategies\Cop_Usd_Clp;
use App\Traits\Strategies\ExchangerateApi;

trait ExchangeRateGetter {

    protected $api;

    public function getExchangeRate(Symbol $symbol)
    {
        if($symbol->api_class === 'ExchangeRateApi'){
            $api = new ExchangerateApi();
        } elseif ($symbol->api_class === "YadioApi") {
            $api = new YadioApi();
        } elseif ($symbol->api_class === "CLP_USD_COP") {
            $api = new Clp_Usd_Cop();
        } elseif ($symbol->api_class === "COP_USD_CLP") {
            $api = new Cop_Usd_Clp();
        } elseif ($symbol->api_class === "CLP_USD") {
            $api = new Clp_Usd();
        } elseif ($symbol->api_class === "USD_CLP") {
            $api = new Usd_Clp();
        } elseif ($symbol->api_class === "EUR_CLP") {
            $api = new Eur_Clp();
        } elseif ($symbol->api_class === "CLP_EUR") {
            $api = new Clp_Eur();
        } else {
            return [
                'error' => 'No se ha seleccionado ningún API para este par.'
            ];
        }
        return $api->performRequest($symbol);
    }
}
