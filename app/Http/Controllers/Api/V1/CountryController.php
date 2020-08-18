<?php

namespace App\Http\Controllers\Api\V1;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return CountryResource::collection($countries);
    }

    public function show(Country $country)
    {
        return new CountryResource($country);
    }
}
