<?php

namespace App\Http\Controllers\Api\V1;

use App\Account;
use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        if($request->query('country_id'))
        {
            $accounts = Account::where('country_id', $request->query('country_id'))->get();
            return AccountResource::collection($accounts);
        }
        $accounts = Account::where('is_active', 1)->paginate(15);
        return AccountResource::collection($accounts);
    }

    public function show(Account $account)
    {
        return new AccountResource($account);
    }
}
