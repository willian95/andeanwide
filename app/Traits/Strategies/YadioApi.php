<?php

namespace App\Traits\Strategies;

use App\Symbol;
use App\Traits\Strategies\ApiInterface;
use GuzzleHttp\Client;

class YadioApi implements ApiInterface
{
    protected $api_uri;

    public function __construct()
    {
        $this->api_uri = env('YADIO_API_URL');
    }

    public function performRequest(Symbol $symbol)
    {
        try {
            $client = new Client([
                'base_uri'  => $this->api_uri
            ]);
    
            $response = null;
    
            if($symbol->quote->symbol === 'VEF'){
                $response = $client->request('GET', $symbol->base->symbol);
            } else if($symbol->base->symbol === 'VEF'){
                $response = $client->request('GET', $symbol->quote->symbol);
            }
            else {
                return [
                    'error' => 'No results'
                ];
            }
    
            $response = $response->getBody()->getContents();
            $rates = json_decode($response, true);
    
            if(isset($rates['rate'])){
                $rate = $rates['rate'];
                if($symbol->base->symbol === 'VEF') $rate = 1/$rate;
    
                if($symbol->offset_by == 'point') {
                    $bid = $rate + $symbol->offset * $symbol->min_pip_value;
                } else {
                    $bid = $rate * ( 1 + $symbol->offset/100 );
                }
    
                return (object) [
                    'api_rate'  => $rate,
                    'bid'       => $bid,
                ];
            }
            return [
                'error' => 'No results'
            ];
        } catch (\Throwable $th) {
            return [
                'error' => 'No results'
            ];
        }
    }
}
