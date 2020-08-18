<?php

namespace App\Http\Controllers\Api\V1;

use App\Param;
use App\Priority;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParamsController extends Controller
{
    public function index ()
    {
        $params = Param::first();
        $priorities = Priority::all();
        return response()->json([
            'params'        => $params,
            'priorities'    => $priorities,
        ]);
    }
}
