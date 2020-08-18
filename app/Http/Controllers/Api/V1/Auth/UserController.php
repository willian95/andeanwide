<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\Controller;

class UserController extends Controller
{
    public function getUser()
    {
        $user = Auth::user();
        return response()->json([
            'user' => $user
        ]);
    }
}
