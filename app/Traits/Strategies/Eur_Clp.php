<?php

namespace App\Traits\Strategies;

use App\Symbol;
use GuzzleHttp\Client;
use App\Traits\Strategies\ApiInterface;

class Eur_Clp implements ApiInterface
{
    protected $clp_eur_api_url;

    public function __construct()
    {
        $this->clp_eur_api_url = 'https://mindicador.cl';
    }

    public function performRequest(Symbol $symbol)
    {
        if($symbol->base->symbol === 'EUR' && $symbol->quote->symbol === 'CLP') {
            $client = new Client([
                'base_uri' => $this->clp_eur_api_url
            ]);
            $response = $client->request('GET', '/api');
            $response = $response->getBody()->getContents();

            $data = json_decode($response, true);
            $rate = $data['euro']['valor'];


            if($symbol->offset_by == 'point') {
                $bid = $rate + $symbol->offset * $symbol->min_pip_value;
            } else {
                $bid = $rate * ( 1 + $symbol->offset/100 );
            }

            return (object)[
                'api_rate'  => $rate,
                'bid'     => $bid,
            ];
        }
        return [
            'error' => 'No results'
        ];
    }
}
