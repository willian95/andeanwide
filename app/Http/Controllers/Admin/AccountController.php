<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Country;
use App\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::paginate(10);
        return view('panel.admin.accounts.index', [
            'accounts'  => $accounts
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
        $currencies = Currency::all();
        return view('panel.admin.accounts.create', [
            'countries'     => $countries,
            'currencies'    => $currencies,
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
            'country_id'            => 'required|exists:countries,id',
            'currency_id'           => 'required|exists:currencies,id',
            'bank_name'             => 'required|max:255',
            'bank_account'          => 'required|max:255',
            'account_name'          => 'required|max:255',
            'code'                  => 'required|max:255',
        ]);

        $account = new Account();
        // $account->is_active = true;
        $account->country_id = $request->input('country_id');
        $account->currency_id = $request->input('currency_id');
        $account->bank_name = $request->input('bank_name');
        $account->bank_account = $request->input('bank_account');
        $account->account_name = $request->input('account_name');
        $account->description = $request->input('description');
        $account->code = $request->input('code');
        $account->save();

        return redirect()->route('panel.admin.accounts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return view('panel.admin.accounts.show', [
            'account'   => $account
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view('panel.admin.accounts.edit', [
            'account'   => $account
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'bank_name'             => 'required|max:255',
            'bank_account'          => 'required|max:255',
            'account_name'          => 'required|max:255',
            'code'                  => 'required|max:255'
        ]);

        // $account->is_active = $request->input('is_active', false);
        $account->bank_name = $request->input('bank_name');
        $account->bank_account = $request->input('bank_account');
        $account->account_name = $request->input('account_name');
        $account->description = $request->input('description');
        $account->code = $request->input('code');
        $account->save();

        return redirect()->route('panel.admin.accounts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        return redirect()->route('panel.admin.accounts.index');
    }
}
