<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {
        return redirect()->route('panel.admin.dashboard');
    }

    public function howItWork()
    {
        return view('panel.comofunciona');
    }
}
