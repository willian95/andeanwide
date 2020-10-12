<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::paginate(10);
        return view('panel.admin.currencies.index', [
            'currencies'    => $currencies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('panel.admin.currencies.create', [
            'countries' => $countries
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
            'name'                  => 'required|max:50',
            'symbol'                => 'required|max:3',
            'country_id'            => 'required|exists:countries,id',
            'more_country_id'       => 'nullable|numeric',
            'more_city_id'          => 'nullable|numeric',
        ]);

        $currency = new Currency();
        $currency->name = $request->input('name');
        $currency->symbol = strtoupper($request->input('symbol'));
        $currency->country_id = $request->input('country_id');
        $currency->can_send = $request->input('can_send', false);
        $currency->can_receive = $request->input('can_receive', false);
        $currency->more_country_id = $request->input('more_country_id');
        $currency->more_city_id = $request->input('more_city_id');
        $currency->save();

        return redirect()->route('panel.admin.currencies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        $countries = Country::all();
        return view('panel.admin.currencies.show', [
            'currency'  => $currency,
            'countries' => $countries
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return view('panel.admin.currencies.edit', [
            'currency'  => $currency
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        $request->validate([
            'name'                  => 'required|max:50',
            'symbol'                => 'required|max:3',
            'more_country_id'       => 'nullable|numeric',
            'more_city_id'          => 'nullable|numeric',
        ]);

        $currency->name = $request->input('name');
        $currency->symbol = strtoupper($request->input('symbol'));
        $currency->can_send = $request->input('can_send', false);
        $currency->can_receive = $request->input('can_receive', false);
        $currency->more_country_id = $request->input('more_country_id');
        $currency->more_city_id = $request->input('more_city_id');
        $currency->save();

        return redirect()->route('panel.admin.currencies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        //
    }
}
