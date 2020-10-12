<?php

namespace App\Http\Controllers;

use App\Symbol;
use App\Currency;
use Illuminate\Http\Request;
use App\Traits\ExchangeRateGetter;

class ExchangeRateController extends Controller
{
    use ExchangeRateGetter;

    public function getRate($base, $quote)
    {
        $symbol = Symbol::where('name', "$base/$quote")->first();
        if($symbol){
            return json_encode($this->getExchangeRate($symbol));
        }
        return [
            'error' => 'No results'
        ];
    }

    public function testSymbol(Request $request, $base, $quote)
    {
        $request->validate([
            'offset'                => 'required|numeric',
            'offset_by'             => 'required',
            'min_pip_value'         => 'required|numeric',
            'api_class'             => 'required|max:255'
        ]);

        $base_cur = Currency::where('symbol', $base)->first();
        $quote_cur = Currency::where('symbol', $quote)->first();

        $symbol = Symbol::where('name', "$base/$quote")->first();
        if($symbol) {
            $symbol->offset = $request->input('offset');
            $symbol->offset_by = $request->input('offset_by');
            $symbol->min_pip_value = $request->input('min_pip_value');
            $symbol->api_class = $request->input('api_class');
            return json_encode($this->getExchangeRate($symbol));
        }

        if($base_cur && $quote_cur){
            $symbol = new Symbol();
            $symbol->name = $base . '/' . $quote;
            $symbol->base_cur_id = $base_cur->id;
            $symbol->quote_cur_id = $quote_cur->id;
            $symbol->offset = $request->input('offset');
            $symbol->offset_by = $request->input('offset_by');
            $symbol->min_pip_value = $request->input('min_pip_value');
            $symbol->api_class = $request->input('api_class');
            return json_encode($this->getExchangeRate($symbol));
        }

        return null;
    }

    public function test(){
        $symbol = new Symbol();
        $symbol->name = 'VEF/COP';
        $symbol->base_cur_id = 8;
        $symbol->quote_cur_id = 7;
        $symbol->spread_by = 'point';
        $symbol->spread_value = 2.0;
        $symbol->offset = -3.0;
        $symbol->min_pip_value = 0.1;
        $symbol->api_class = 'YadioApi';
        return json_encode($this->getExchangeRate(($symbol)));

    }
}
