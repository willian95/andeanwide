<?php

namespace App\Http\Controllers\Admin;

use App\Symbol;
use App\Currency;
use Illuminate\Http\Request;
use App\Traits\ExchangeRateGetter;
use App\Http\Controllers\Controller;

class SymbolController extends Controller
{
    use ExchangeRateGetter;

    protected $apis;

    public function __construct()
    {
        $this->apis = [
            'ExchangeRateApi',
            'YadioApi',
            'CLP_USD_COP',
            'COP_USD_CLP',
            'USD_CLP',
            'CLP_USD',
            'EUR_CLP',
            'CLP_EUR'
            // Lista de api class
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $symbols = Symbol::paginate(15);
        foreach ($symbols as $symbol) {
            $symbol->show_route = route('panel.admin.symbols.show', ['symbol' => $symbol->id]);
        };
        return view('panel.admin.pairs.index', [
            'symbols'   => $symbols
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = Currency::all();
        return view('panel.admin.pairs.create', [
            'currencies'    => $currencies,
            'apis'          => $this->apis
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required|max:10',
            'base_currency'         => 'required|exists:currencies,symbol',
            'quote_currency'        => 'required|exists:currencies,symbol',
            'offset_by'             => 'required|in:point,percentage',
            'offset'                => 'required|numeric',
            'min_pip_value'         => 'required|numeric',
            'observation'           => 'max:255',
            'api_class'             => 'required|max:255',
            'max_tier_1'            => 'numeric|min:0',
            'max_tier_2'            => 'numeric|min:0',
        ]);

        $base = Currency::where('symbol', $request->input('base_currency'))->first();
        $quote = Currency::where('symbol', $request->input('quote_currency'))->first();

        $symbol = new Symbol();
        $symbol->is_active = $request->input('is_active', false);
        $symbol->name = $request->input('name');
        $symbol->base_cur_id = $base->id;
        $symbol->quote_cur_id = $quote->id;
        $symbol->offset = $request->input('offset');
        $symbol->offset_by = $request->input('offset_by');
        $symbol->min_pip_value = $request->input('min_pip_value');
        $symbol->observation = $request->input('observation');
        $symbol->api_class = $request->input('api_class');
        $symbol->show_inverse = $request->input('show_inverse', false);
        $symbol->max_tier_1 = $request->input('max_tier_1', 0);
        $symbol->max_tier_2 = $request->input('max_tier_2', 0);
        $symbol->decimals = $request->input('decimals', 0);
        $symbol->min_amount = (float)str_replace(",", "", $request->input('min_amount', 0));
        $symbol->save();

        if($symbol->id === 1) {
            $symbol->is_default = true;
            $symbol->save();
        }

        return redirect()->route('panel.admin.symbols.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Symbol $symbol)
    {
        $symbol->rates = $this->getExchangeRate($symbol);
        return view('panel.admin.pairs.show', [
            'symbol'    => $symbol,
            'apis'      => $this->apis
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Symbol $symbol)
    {
        $request->validate([
            'offset_by'             => 'required|in:point,percentage',
            'offset'                => 'required|numeric',
            'min_pip_value'         => 'required|numeric',
            'observation'           => 'max:255',
            'api_class'             => 'required|max:255',
            'default_amount'        => 'requiredIf:is_default,true',
            'max_tier_1'            => 'numeric|min:0',
            'max_tier_2'            => 'numeric|min:0',
        ]);

        $symbol->is_active = $request->input('is_active', false);
        $symbol->offset_by = $request->input('offset_by');
        $symbol->offset = $request->input('offset');
        $symbol->min_pip_value = $request->input('min_pip_value');
        $symbol->observation = $request->input('observation');
        $symbol->api_class = $request->input('api_class');
        $symbol->is_default = $request->input('is_default', false);
        $symbol->default_amount = $request->input('default_amount', 0);
        $symbol->min_amount = $request->input('min_amount', 0);
        $symbol->show_inverse = $request->input('show_inverse', false);
        $symbol->max_tier_1 = $request->input('max_tier_1', 0);
        $symbol->max_tier_2 = $request->input('max_tier_2', 0);
        $symbol->decimals = $request->input('decimals', 0);
        $symbol->save();

        $symbols = Symbol::all();
        if($symbols->count() === 1) {
            $symbol->is_default = true;
            $symbol->save();
        } else if($symbol->is_default) {
            foreach ($symbols as $item) {
                if($symbol->id !== $item->id) {
                    $item->is_default = false;
                    $item->save();
                }
            }
        }

        return response()->json([
            'symbol'    => $symbol
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Symbol $symbol)
    {
        //
    }
}
