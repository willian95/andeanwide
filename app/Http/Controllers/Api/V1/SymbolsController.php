<?php

namespace App\Http\Controllers\Api\V1;

use App\Symbol;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SymbolResource;

class SymbolsController extends Controller
{
    public function index()
    {
        $symbols = Symbol::where('is_active', 1)->get();
        return SymbolResource::collection($symbols);
    }
}
