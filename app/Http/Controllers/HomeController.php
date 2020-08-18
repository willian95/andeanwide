<?php

namespace App\Http\Controllers;

use App\Tasa;
use App\Param;
use App\Symbol;
use App\Priority;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Swap\Laravel\Facades\Swap;
use App\Events\SendContactEmailEvent;
use GuzzleHttp\Exception\GuzzleException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $symbols = Symbol::all();
        $params = Param::first();
        $priorities = Priority::all();
        return view('index', [
            'symbols'   => $symbols,
            'params'    => $params,
            'priorities'=> $priorities,
        ]);
    }

    public function mailContact(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'max:50'],
            'email'     => ['required', 'email'],
            'subject'   => ['required', 'max:255'],
            'content'   => ['required'],
        ]);

        $data = $request->only(['name', 'email', 'subject', 'content']);
        $data['datetime'] = now();

        event(new SendContactEmailEvent($data));

        return $data;
    }

    public function nosotros()
    {
        return view('nosotros');
    }

    public function terminosycondiciones()
    {
        return view('terminosycondiciones');
    }

    public function contacto()
    {
        return view('contacto');
    }

    public function privacidad()
    {
        return view('privacidad');
    }
    public function faqs()
    {
        return view('faqs');
    }

    public function product()
    {
        return view('product');
    }

    public function blog()
    {
        return view('/blog/posts');
    }

    public function post()
    {
        return view('/blog/post');
    }

    public function cart()
    {
        return view('cart');
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function calculadoraAjax(Request $request)
    {
        $value = cache('rates');
        if ($value == null) {
            $content = file_get_contents("https://api.yadio.io/json");
            $data = json_decode($content);
            $dataUSD = $data->USD;
            $VES = $dataUSD->rate;
            $COP = $dataUSD->COP;
            $CLP = $dataUSD->CLP;
            $obj = ["VES" => $VES, "COP" => $COP, "CLP" => $CLP];
            cache(['rates' => $obj], 3600);
            $value = cache('rates');
        }
        return \Response::json($value);
    }

    public function getTasaDias2(Request $request)
    {
        $value = Tasa::where('origen', $request->origen)->where('destino', $request->destino)->first();
        return \Response::json($value->dias2);
    }
}
