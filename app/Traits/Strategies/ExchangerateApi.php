<?php

namespace App\Traits\Strategies;

use App\Symbol;
use GuzzleHttp\Client;
use App\Traits\Strategies\ApiInterface;

class ExchangerateApi implements ApiInterface
{
    protected $api_uri;
    protected $api_key;

    public function __construct()
    {
        $this->api_uri = env('EXCHANGERATE_API_URL');
        $this->api_key = env('EXCHANGERATE_API_KEY');
    }

    public function performRequest(Symbol $symbol)
    {
        try {
            $client = new Client([
                'base_uri' => $this->api_uri . "/" . $this->api_key . "/" . "latest" . "/"
            ]);
            $response = $client->request('GET', $symbol->base->symbol);
            $response = $response->getBody()->getContents();
    
            $rates = json_decode($response, true);
    
            if(isset($rates['conversion_rates']) && isset($rates['conversion_rates'][$symbol->quote->symbol])){
                $rate = $rates['conversion_rates'][$symbol->quote->symbol];
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
        } catch (\Throwable $th) {
            return [
                'error' => 'No results'
            ];
        }
    }
}
