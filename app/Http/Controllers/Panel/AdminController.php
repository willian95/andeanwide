<?php

namespace App\Http\Controllers\Panel;

use App\Tasa;
use App\User;
use App\Agent;
use App\Order;
use App\Account;
use App\Address;
use App\Country;
use App\Payment;
use App\Currency;
use App\Identity;
use App\Recipient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('panel.index');
    }

    public function ordenes()
    {
        return view('panel.ordenes');
    }

    public function historialordenes()
    {
        return view('panel.historialordenes');
    }

    public function ordendeposito()
    {
        return view('panel.ordendeposito');
    }
    public function sendremesa()
    {
        return view('panel.sendremesa');
    }

    public function sendPayment(Request $request)
    {

        $request->validate([
            'order_id'              => 'required|exists:orders,id',
            'account_id'            => 'required|exists:accounts,id',
            'transaction_number'    => 'required|max:255',
            'transaction_date'      => 'required|date',
            'payment_amount'        => 'required|numeric',
            'image'                 => 'required|image'
        ]);

        $payment = new Payment();
        $payment->order_id = $request->input('order_id');
        $payment->account_id = $request->input('account_id');
        $payment->transaction_number = $request->input('transaction_number');
        $payment->transaction_date = new Carbon($request->input('transaction_date'));
        $payment->payment_amount = $request->input('payment_amount');
        $payment->image_url = $this->saveImage($request->file('image'), "images/payment/" .$request->input('account_id'));
        $payment->save();

        return redirect()->route('panel.historialremesas');
    }

    public function completeRemesa(Request $request)
    {
        $request->validate([
            'order_id'    => 'required|exists:orders,id',
        ]);

        $order = Order::findOrFail($request->input('order_id'));
        $order->completed_at = now();
        $order->save();

        $user = Auth::user();
        $currencies = Currency::all();
        $recipients = Recipient::where('user_id', $user->id)->get();
        $accounts = Account::where('currency_id', $order->currency_sended_id)->get();

        return view('panel.crearemesa', [
            'accounts'      => $accounts,
            'curriencies'   => $currencies,
            'recipients'    => $recipients,
            'order'         => $order,
        ]);
    }

    public function createRemesa(Request $request)
    {
        $request->validate([
            'currency_sended_id'    => 'required|exists:currencies,id',
            'currency_received_id'  => 'required|exists:currencies,id',
            'sended_amount'         => 'required|numeric',
            'received_amount'       => 'required|numeric',
            'priority'              => 'required|in:normal,high',
            'transaction_cost'      => 'required|numeric',
            'priority_cost'         => 'required|numeric',
            'total_cost'            => 'required|numeric',
            'total_payment'         => 'required|numeric',
            'exchange_rate'         => 'required|numeric',
        ]);
        
        $user = Auth::user();
        $order = new Order();
        
        $order->user_id = $user->id;
        $order->currency_sended_id = $request->input('currency_sended_id');
        $order->currency_received_id = $request->input('currency_received_id');
        $order->sended_amount = $request->input('sended_amount');
        $order->received_amount = $request->input('received_amount');
        $order->priority = $request->input('priority');
        $order->transaction_cost = $request->input('transaction_cost');
        $order->priority_cost = $request->input('priority_cost');
        $order->total_cost = $request->input('total_cost');
        $order->total_payment = $request->input('total_payment');
        $order->exchange_rate = $request->input('exchange_rate');
        $order->expired_at = (new Carbon())->addHours(24);
        $order->save();

        $currencies = Currency::all();
        $recipients = Recipient::where('user_id', $user->id)->get();

        return view('panel.crearemesa', [
            'curriencies'   => $currencies,
            'recipients'    => $recipients,
            'order'         => $order,
        ]);
    }

    public function addRecipientRemesa(Request $request)
    {
        $request->validate([
            'order_id'          => 'required|exists:orders,id',
            'recipient_id'      => 'required|exists:recipients,id',
            'reason'            => 'required|max:255'
        ]);

        $user = Auth::user();
        $order = Order::findOrFail($request->input('order_id'));
        $recipient = Order::findOrFail($request->input('recipient_id'));

        $order->recipient_id = $recipient->id;
        $order->reason = $request->input('reason');
        $order->save();

        $currencies = Currency::all();
        $recipients = Recipient::where('user_id', $user->id)->get();

        return view('panel.crearemesa', [
            'curriencies'   => $currencies,
            'recipients'    => $recipients,
            'order'         => $order,
        ]);
    }

    public function createRecipient(Request $request)
    {
        $request->validate([
            'country_id'            => 'required|exists:countries,id',
            'name'                  => 'required|max:255',
            'lastname'              => 'required|max:255',
            'dni'                   => 'required|max:255',
            'phone'                 => 'required|max:255',
            'email'                 => 'required|email|max:255',
            'bank_name'             => 'required|max:255',
            'bank_account'          => 'required|max:255',
            'address'               => 'required|max:255',
        ]);

        $user = Auth::user();

        $recipient = new Recipient();
        $recipient->user_id = $user->id;
        $recipient->country_id = $request->input('country_id');
        $recipient->name = $request->input('name');
        $recipient->lastname = $request->input('lastname');
        $recipient->dni = $request->input('dni');
        $recipient->phone = $request->input('phone');
        $recipient->email = $request->input('email');
        $recipient->bank_name = $request->input('bank_name');
        $recipient->bank_account = $request->input('bank_account');
        $recipient->address = $request->input('address');
        $recipient->save();

        if($request->has('order_id'))
        {
            $currencies = Currency::all();
            $recipients = Recipient::where('user_id', $user->id)->get();
            $order = Order::find($request->input('order_id'));

            return view('panel.crearemesa', [
                'curriencies'   => $currencies,
                'recipients'    => $recipients,
                'order'         => $order,
            ]);
        }

    }

    public function crearemesa()
    {
        $user = Auth::user();

        $currencies = Currency::all();
        $recipients = Recipient::where('user_id', $user->id)->get();

        return view('panel.crearemesa', [
            'currencies'    => $currencies,
            'recipients'    => $recipients,
            'order'         => null,   
        ]);
    }

    public function historialremesas()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('panel.historialremesas', [
            'orders'    => $orders
        ]);
    }
    public function ordenesnuevas()
    {
        return view('panel.ordenesnuevas');
    }

    public function ordenenvio()
    {
        return view('panel.ordenenvio');
    }

    public function tasacambio()
    {
        $tasaCLPtoEUR = Tasa::where('origen', 'CLP')->where('destino', 'EUR')->first();
        $tasaCLPtoCOP = Tasa::where('origen', 'CLP')->where('destino', 'COP')->first();
        $tasaCLPtoVES = Tasa::where('origen', 'CLP')->where('destino', 'VES')->first();
        $tasaEURtoCLP = Tasa::where('origen', 'EUR')->where('destino', 'CLP')->first();
        $tasaEURtoCOP = Tasa::where('origen', 'EUR')->where('destino', 'COP')->first();
        $tasaEURtoVES = Tasa::where('origen', 'EUR')->where('destino', 'VES')->first();
        $tasaCOPtoCLP = Tasa::where('origen', 'COP')->where('destino', 'CLP')->first();
        $tasaCOPtoEUR = Tasa::where('origen', 'COP')->where('destino', 'EUR')->first();
        $tasaCOPtoVES = Tasa::where('origen', 'COP')->where('destino', 'VES')->first();

        $tasas = new \stdClass();
        $tasas->CLPtoEURdias2 = $tasaCLPtoEUR->dias2;
        $tasas->CLPtoEURdias1 = $tasaCLPtoEUR->dias1;
        $tasas->CLPtoCOPdias2 = $tasaCLPtoCOP->dias2;
        $tasas->CLPtoCOPdias1 = $tasaCLPtoCOP->dias1;
        $tasas->CLPtoVESdias2 = $tasaCLPtoVES->dias2;
        $tasas->CLPtoVESdias1 = $tasaCLPtoVES->dias1;
        $tasas->EURtoCLPdias2 = $tasaEURtoCLP->dias2;
        $tasas->EURtoCLPdias1 = $tasaEURtoCLP->dias1;
        $tasas->EURtoCOPdias2 = $tasaEURtoCOP->dias2;
        $tasas->EURtoCOPdias1 = $tasaEURtoCOP->dias1;
        $tasas->EURtoVESdias2 = $tasaEURtoVES->dias2;
        $tasas->EURtoVESdias1 = $tasaEURtoVES->dias1;
        $tasas->COPtoCLPdias2 = $tasaCOPtoCLP->dias2;
        $tasas->COPtoCLPdias1 = $tasaCOPtoCLP->dias1;
        $tasas->COPtoEURdias2 = $tasaCOPtoEUR->dias2;
        $tasas->COPtoEURdias1 = $tasaCOPtoEUR->dias1;
        $tasas->COPtoVESdias2 = $tasaCOPtoVES->dias2;
        $tasas->COPtoVESdias1 = $tasaCOPtoVES->dias1;

        return view('panel.tasacambio', compact('tasas'));
    }

    public function tasacambioPost(Request $req)
    {
        Tasa::truncate();

        Tasa::create(['origen' => 'CLP', 'destino' => 'EUR', 'dias2' => $req->CLPtoEURDay2, 'dias1' => $req->COPtoEURDay1]);
        Tasa::create(['origen' => 'EUR', 'destino' => 'CLP', 'dias2' => $req->EURtoCLPDay2, 'dias1' => $req->EURtoCLPDay1]);
        Tasa::create(['origen' => 'CLP', 'destino' => 'COP', 'dias2' => $req->CLPtoCOPDay2, 'dias1' => $req->CLPtoCOPDay1]);
        Tasa::create(['origen' => 'COP', 'destino' => 'CLP', 'dias2' => $req->COPtoCLPDay2, 'dias1' => $req->COPtoCLPDay1]);
        Tasa::create(['origen' => 'CLP', 'destino' => 'VES', 'dias2' => $req->CLPtoVESDay2, 'dias1' => $req->CLPtoVESDay1]);
        Tasa::create(['origen' => 'COP', 'destino' => 'EUR', 'dias2' => $req->COPtoEURDay2, 'dias1' => $req->COPtoEURDay1]);
        Tasa::create(['origen' => 'EUR', 'destino' => 'COP', 'dias2' => $req->EURtoCOPDay2, 'dias1' => $req->EURtoCOPDay1]);
        Tasa::create(['origen' => 'COP', 'destino' => 'VES', 'dias2' => $req->COPtoVESDay2, 'dias1' => $req->COPtoVESDay1]);
        Tasa::create(['origen' => 'EUR', 'destino' => 'VES', 'dias2' => $req->EURtoVESDay2, 'dias1' => $req->EURtoVESDay1]);


        return redirect()->route('panel.tasacambio')->with('info', 'Tasas actualizadas');
    }

    public function reportes()
    {
        return view('panel.reportes');
    }

    public function veragentes()
    {
        return view('panel.veragentes');
    }

    public function crearagente()
    {
        return view('panel.crearagente');
    }

    public function crearAgentePost(Request $req)
    {
        $agent = new Agent();
        $agent->r_legal_name = $req->r_legal_name;
        $agent->r_legal_lastname = $req->r_legal_lastname;
        $agent->r_nationality = $req->r_nationality;
        $agent->r_birthday = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $req->r_birthday)));
        $agent->r_pais_residencia = $req->r_pais_residencia;
        $agent->r_rut = $req->r_rut;
        $agent->r_serie = $req->r_serie;
        $agent->r_telefono = $req->r_telefono;
        $agent->e_name = $req->e_name;
        $agent->e_fantasy = $req->e_fantasy;
        $agent->e_rut = $req->e_rut;
        $agent->e_address = $req->e_address;
        $agent->e_city = $req->e_city;
        $agent->e_country = $req->e_country;
        $agent->e_zip = $req->e_zip;
        $agent->save();

        $user = new User();
        $user->name = $req->r_legal_name;
        $user->lastname = $req->r_legal_lastname;
        $user->phone = $req->r_telefono;
        $user->email = $req->email;
        $user->identification = $req->r_rut;
        $user->password = Hash::make($req->password);
        $user->agent_id = $agent->id;
        $user->save();

        $user->assignRole('agent');

        return redirect()->route('panel.veragentes', $user->id)->with('info', 'Agente creado con éxito');
    }


    public function editaragente()
    {
        return view('panel.editaragente');
    }
    public function usuarios()
    {
        return view('panel.usuarios');
    }

    public function ingresodinero()
    {
        return view('panel.ingresodinero');
    }

    public function facturas()
    {
        return view('panel.facturas');
    }

    public function historialclientefecha()
    {
        return view('panel.historialclientefecha');
    }
    public function historialcliente()
    {
        return view('panel.historialcliente');
    }

    public function editcatalogo()
    {
        return view('panel.editcatalogo');
    }

    public function editindex()
    {
        return view('panel.editindex');
    }
    public function usuario()
    {
        $users = User::role('user')->orderBy('id', 'DESC')->get();
        // $users->is_completed;
        return view('panel.usuario', compact('users'));
    }
    public function editarusuario($id)
    {   
        $user = User::findOrFail($id);
        $user->identity;
        $user->address;

        return view('panel.editarusuario', [
            'user'  => $user,
        ]);
    }
    public function preguntas()
    {
        return view('panel.preguntas');
    }
    public function terminos()
    {
        return view('panel.terminos');
    }
    public function politicas()
    {
        return view('panel.politicas');
    }
    public function comofunciona()
    {
        return view('panel.comofunciona');
    }
    public function verifica()
    {
        $user = Auth::user();
        $user->identity;
        $user->address;
        $countries = Country::select('id', 'name')->get();

        return view('panel.verifica', [
            'user'      => $user,
            'countries' => $countries
        ]);
    }

    public function createIdentity(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'country_id'    => 'required|numeric|exists:countries,id',
            'nationality'   => 'required|max:255',
            'first_name'    => 'required|max:255',
            'last_name'     => 'required|max:255',
            'dni_number'    => 'required|max:255',
            'expiration_date'   => 'required|date|after:today',
            'issue_date'    => 'required|date|before:today',
            'dob'           => 'required|date|before:-18 years',
            'document_type' => 'required|in:dni,passport,driver_license',
            'gender'        => 'required|in:Unknown,F,M',
            'front_image'   => 'required|image',
            'back_image'    => 'image'
        ]);
        
        $user = User::findOrFail($request->input('user_id'));
        $identity = new Identity;
        $identity->country_id = $request->input('country_id');
        $identity->nationality = $request->input('nationality');
        $identity->first_name = $request->input('first_name');
        $identity->middle_name = $request->input('middle_name');
        $identity->last_name = $request->input('last_name');
        $identity->second_surname = $request->input('second_surname');
        $identity->dni_number = $request->input('dni_number');
        $identity->validation_number = $request->input('validation_number');
        $identity->expiration_date = new Carbon($request->input('expiration_date'));
        $identity->issue_date = new Carbon($request->input('issue_date'));
        $identity->dob = new Carbon($request->input('dob'));
        $identity->document_type = $request->input('document_type');
        $identity->gender = $request->input('gender');
        $identity->front_image_url = $this->saveImage($request->file('front_image'));
        if($request->has('back_image'))
        {
            $identity->reverse_image_url = $this->saveImage($request->file('back_image'));
        }

        $user->identity()->save($identity);
        
        return redirect()->route('panel.verifica'); 
    }

    public function createAddress(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'address'       => 'required|max:150',
            'address_ext'   => 'nullable|max:150',
            'country_id'    => 'required|numeric|exists:countries,id',
            'state'         => 'required|max:150',
            'city'          => 'required|max:150',
            'cod'           => 'required|max:50',
            'image'         => 'required|image',
        ]);
        
        $user = User::findOrFail($request->input('user_id'));
        $address = new Address;
        $address->address = $request->input('address');
        $address->address_ext = $request->input('address_ext');
        $address->country_id = $request->input('country_id');
        $address->state = $request->input('state');
        $address->city = $request->input('city');
        $address->cod = $request->input('cod');
        $address->image_url = $this->saveImage($request->file('image'));

        $user->address()->save($address);
        
        return redirect()->route('panel.verifica');
    }

    public function validateIdentity(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
        ]);

        $user = User::find($request->input('user_id'));
        $user->identity->verified_at = now();
        $user->identity->save();

        if(
            !is_null($user->identity) &&
            !is_null($user->identity->verified_at) &&
            !is_null($user->address) &&
            !is_null($user->address->verified_at))
        {
            $user->account_verified_at = now();
            $user->save();
        }

        return redirect()->route('panel.editarusuario', ['id' => $user->id]);
    }

    public function unvalidateIdentity(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
        ]);
        
        $user = User::find($request->input('user_id'));
        $user->identity()->delete();
        return redirect()->route('panel.editarusuario', ['id' => $user->id]);
    }

    public function validateAddress(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
        ]);

        $user = User::find($request->input('user_id'));
        $user->address->verified_at = now();
        $user->address->save();

        if(
            !is_null($user->identity) &&
            !is_null($user->identity->verified_at) &&
            !is_null($user->address) &&
            !is_null($user->address->verified_at))
        {
            $user->account_verified_at = now();
            $user->save();
        }

        return redirect()->route('panel.editarusuario', ['id' => $user->id]);
    }

    public function unvalidateAddress(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
        ]);

        $user = User::find($request->input('user_id'));
        $user->address()->delete();
        return redirect()->route('panel.editarusuario', ['id' => $user->id]);
    }

    protected function saveImage($file, $path=null)
    {
        if(is_null($path))
        {
            $user = Auth::user();
            $path = "images/user/$user->id";
        }
        $name = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($path, $name, 'public');
        return asset('') . 'storage/' . $path;
    }
}
