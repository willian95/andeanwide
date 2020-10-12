<?php

namespace App\Traits\Strategies;

use App\Symbol;
use App\Traits\Strategies\ApiInterface;
use GuzzleHttp\Client;

class MoreScrapping implements ApiInterface
{
    protected $api_uri;

    public function __construct() {}

    public function performRequest(Symbol $symbol)
    {
        try {
            $rate = $symbol->more_rate;
    
            if($symbol->offset_by == 'point') {
                $bid = $rate + $symbol->offset * $symbol->min_pip_value;
            } else {
                $bid = $rate * ( 1 + $symbol->offset/100 );
            }
            
            return (object)[
                'api_rate'  => $rate,
                'bid'       => $bid,
            ];
        } catch (\Throwable $th) {
            return [
                'error' => 'No results'
            ];
        }
    }
}
