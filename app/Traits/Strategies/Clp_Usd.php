<?php

namespace App\Traits\Strategies;

use App\Symbol;
use GuzzleHttp\Client;
use App\Traits\Strategies\ApiInterface;

class Clp_Usd implements ApiInterface
{
    protected $clp_usd_api_url;

    public function __construct()
    {
        $this->clp_usd_api_url = 'https://mindicador.cl';
    }

    public function performRequest(Symbol $symbol)
    {
        if($symbol->base->symbol === 'CLP' && $symbol->quote->symbol === 'USD') {
            try {
                $client = new Client([
                    'base_uri' => $this->clp_usd_api_url
                ]);
                $response = $client->request('GET', '/api');
                $response = $response->getBody()->getContents();
    
                $data = json_decode($response, true);
                $rate = 1 / $data['dolar']['valor'];
    
                if($symbol->offset_by == 'point') {
                    $bid = $rate + $symbol->offset * $symbol->min_pip_value;
                } else {
                    $bid = $rate * ( 1 + $symbol->offset/100 );
                }
    
                return (object)[
                    'api_rate'  => $rate,
                    'bid'     => $bid,
                ];
            } catch (\Throwable $th) {
                return [
                    'error' => 'No results'
                ];
            }
        }
        return [
            'error' => 'No results'
        ];
    }
}
