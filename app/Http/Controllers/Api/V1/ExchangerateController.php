<?php

namespace App\Http\Controllers\Api\V1;

use App\Symbol;
use Illuminate\Http\Request;
use App\Traits\ExchangeRateGetter;
use App\Http\Controllers\Controller;

class ExchangerateController extends Controller
{
    use ExchangeRateGetter;

    public function show(Symbol $symbol)
    {
        $prices = $this->getExchangeRate($symbol);
        return response()->json(["prices" => $prices, "symbol" => $symbol]);
        return response()->json([
            'rate'      => $prices->bid,
            'symbol'    => [
                'id'        => $symbol->id,
                'name'      => $symbol->name,
                'base'      => [
                    'symbol'    => $symbol->base->symbol,
                    'name'      => $symbol->base->name
                ],
                'quote'     => [
                    'symbol'    => $symbol->quote->symbol,
                    'name'      => $symbol->quote->name
                ]
            ]
        ]);
    }
}
