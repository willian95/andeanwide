<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Invitation;

class AgentController extends Controller
{
    public function index()
    {
        // TODO: ordenar la vista
        // return view('panel.crearagente');
        $agents = User::role('agent')->orderBy('id', 'DESC')->get();
        return view('panel.admin.agents.index', [
            'agents'    => $agents,
        ]);
    }

    public function create()
    {
        return view('panel.admin.agents.create');
    }

}
