<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        //return redirect a perfil
    }

    public function balances()
    {
        return view('panel.usuario.balances');
    }

    public function historialremesas()
    {
        return view('panel.usuario.historialremesas');
    }

    public function historialdepositos()
    {
        return view('panel.usuario.historialdepositos');
    }

    public function perfil()
    {
        return view('panel.usuario.perfil');
    }

    public function ingresar()
    {
        return view('panel.usuario.ingresar');
    }

    public function destinatarios()
    {
        return view('panel.usuario.destinatarios');
    }

    public function enviardinero()
    {
        return view('panel.usuario.enviardinero');
    }

    public function faq()
    {
        return view('panel.usuario.faq');
    }
}
