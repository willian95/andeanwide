<?php

namespace App\Traits\Strategies;

use App\Symbol;
use GuzzleHttp\Client;
use App\Traits\Strategies\ApiInterface;

class Clp_Usd_Cop implements ApiInterface
{
    protected $clp_usd_api_url;
    protected $usd_cop_api_url;

    public function __construct()
    {
        $this->clp_usd_api_url = 'https://mindicador.cl';
        $this->usd_cop_api_url = 'https://trm-colombia.makaw-dev.now.sh';
    }

    public function performRequest(Symbol $symbol)
    {
        if($symbol->base->symbol === 'CLP' && $symbol->quote->symbol === 'COP') {
            $client = new Client([
                'base_uri' => $this->clp_usd_api_url
            ]);
            $response = $client->request('GET', '/api');
            $response = $response->getBody()->getContents();

            $data = json_decode($response, true);
            $USD_CLP_rate = $data['dolar']['valor'];

            $client = new Client([
                'base_uri' => $this->usd_cop_api_url
            ]);
            $response = $client->request('GET', '/?date=' . now()->toDateString());
            $response = $response->getBody()->getContents();
            $data = json_decode($response, true);

            $USD_COP_rate = $data['data']['value'];

            $rate = $USD_COP_rate / $USD_CLP_rate;
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
