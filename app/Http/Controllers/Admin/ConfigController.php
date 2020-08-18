<?php

namespace App\Http\Controllers\Admin;

use App\Param;
use App\Priority;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    public function index()
    {
        $params = Param::first();
        $priorities = Priority::all();
        return view('panel.admin.config.index', [
            'params'        => $params,
            'priorities'    => $priorities,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'transactionCostPct'    => ['required', 'numeric'],
            'taxPct'                => ['required', 'numeric'],
        ]);

        $params = Param::first();
        if($params) {
            $params->transactionCostPct = $request->input('transactionCostPct');
            $params->taxPct = $request->input('taxPct');
            $params->save();
        } else {
            Param::create([
                'name'                  => 'Parametros',
                'description'           => 'Parametros de Configuración',
                'transactionCostPct'    => $request->input('transactionCostPct'),
                'taxPct'                => $request->input('taxPct'),
            ]);
        }

        return redirect()->route('panel.admin.config.index');
    }

    public function storePriority(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'unique:priorities,id', 'max: 50'],
            'label'         => ['required', 'unique:priorities,id', 'max: 50'],
            'sublabel'      => ['nullable','max: 50'],
            'description'   => ['nullable','max: 255'],
            'costPct'       => ['required','numeric'],
        ]);

        $priority = New Priority();
        $priority->name = $request->input('name');
        $priority->label = $request->input('label');
        $priority->sublabel = $request->input('sublabel');
        $priority->description = $request->input('description');
        $priority->costPct = $request->input('costPct');
        $priority->save();

        return redirect()->route('panel.admin.config.index');
    }

    public function updatePriority(Priority $priority, Request $request)
    {
        $request->validate([
            'label'         => [
                'required',
                Rule::unique('priorities')->ignore($priority),
                'max: 50'
            ],
            'sublabel'      => ['nullable','max: 50'],
            'description'   => ['nullable','max: 255'],
            'costPct'       => ['required','numeric'],
        ]);

        $priority->label = $request->input('label');
        $priority->sublabel = $request->input('sublabel');
        $priority->description = $request->input('description');
        $priority->costPct = $request->input('costPct');
        $priority->save();

        return redirect()->route('panel.admin.config.index');
    }

    public function destroyPriority(Priority $priority)
    {
        $priority->delete();
        return redirect()->route('panel.admin.config.index');
    }
}
