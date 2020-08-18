<?php

namespace App\Http\Controllers\Api\V1;

use App\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyResource;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::paginate(15);
        return CurrencyResource::collection($currencies);
    }

    public function show(Currency $currency)
    {
        return new CurrencyResource($currency);
    }
}
