<?php

namespace App\Http\Controllers\User;

use App\Order;
use App\Param;
use App\Symbol;
use App\Account;
use App\Priority;
use App\Recipient;
use App\Traits\Parameters;
use App\Jobs\OrderExpiracy;
use Illuminate\Http\Request;
use App\Traits\ExchangeRateGetter;
use App\Events\UserSubmitOrderEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    use Parameters;
    use ExchangeRateGetter;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);

        return view('panel.user.order.index', [
            'orders'    => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();

        $recipients = null;
        $order = null;
        $accounts = null;
        
        if($request->query('order_id'))
        {
            $order = Order::find($request->query('order_id'));
            $recipients = Recipient::where([
                ['user_id', $user->id],
                ['country_id', $order->currencyReceived->country_id],
            ])->get();
            $accounts = Account::where('currency_id', $order->currency_sended_id)->get();
        }

        $symbols = Symbol::all();
        $params = Param::first();
        $priorities = Priority::all();

        return view('panel.user.order.create', [
            'params'        => $params,
            'priorities'    => $priorities,
            'symbols'       => $symbols,
            'recipients'    => $recipients,
            'order'         => $order,
            'accounts'      => $accounts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'symbol_id'         => ['required', 'exists:symbols,id'],
            'payment_amount'    => [
                'required', 
                'numeric', 
                'min:0',
                function($attribute, $value, $fail) use($user, $request) {
                    $symbol = Symbol::find($request->input('symbol_id'));
                    if($value > $symbol->max_tier_2 && $symbol->max_tier_2 != 0 && isset($symbol->max_tier_2)) {
                        $fail('Monto máximo a enviar para ' . $symbol->name . ' es de ' . number_format($symbol->max_tier_2, 2) . ' ' . $symbol->base->symbol .'.');
                    } else if($value > $symbol->max_tier_1 && $symbol->max_tier_1 != 0  && is_null($user->address)) {
                        $fail('Monto máximo superior al monto permitido para esta cuenta, si desea enviar esta cantidad debe validar su cuenta (Verificación Nivel 2). <a href="' . route('panel.user.verify') .'" class="ml-2 btn btn-dark btn-sm">Ir a Verificación de cuenta</a>');
                    }
                }
            ],
            'priority_id'       => ['required', 'exists:priorities,id'],
        ]);

        $symbol = Symbol::find($request->input('symbol_id'));
        $priority = Priority::find($request->input('priority_id'));
        $params = Param::first();
        $exchangeRate = $this->getExchangeRate($symbol);
        $paymentAmount = (float)$request->input('payment_amount');


        $order = new Order();

        $order->user_id = $user->id;
        $order->symbol_id = $request->input('symbol_id');
        $order->currency_sended_id = $symbol->base_cur_id;
        $order->currency_received_id = $symbol->quote_cur_id;
        $order->priority_id = $priority->id;
        $order->priority = $priority->name;
        $order->priority_label = $priority->label;
        $order->priority_sublabel = $priority->sublabel;
        $order->payment_amount = $paymentAmount;
        $order->transaction_cost = $paymentAmount * ($params->transactionCostPct/100);
        $order->priority_cost = $paymentAmount * ($priority->costPct/100);
        $order->tax = ($order->transaction_cost + $order->priority_cost)*($params->taxPct/100);
        $order->total_cost = $order->transaction_cost + $order->priority_cost + $order->tax;
        $order->sended_amount = $paymentAmount - $order->total_cost;
        $order->exchange_rate = $exchangeRate->bid;
        $order->received_amount = $order->sended_amount * $order->exchange_rate;
        $order->payment_code = strtoupper(Str::random(12));
        $order->save();

        OrderExpiracy::dispatch($order)->delay(now()->addHours(env('ORDER_EXPIRATION_HOURS', 24)));

        return redirect()->route('panel.user.order.create', ['order_id' => $order->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $message = null;
        $recipients= null;
        $accounts = Account::where('currency_id', $order->currency_sended_id)->get();
        $order->payment;
        if(is_null($order->recipient)) {
            $recipients = Recipient::where('user_id', Auth::id())->get();
        }

        if(isset($order->rejected_at)) {
            $message = [
                'message'   => $order->observation,
                'color'     => 'danger'
            ];
        } else if(isset($order->completed_at)) {
            $message = [
                'message'   => 'La orden número ' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . ' ha sido completada con éxito.',
                'color'     => 'success'
            ];
        } else if(isset($order->verified_at)) {
            $message = [
                'message'   => 'El pago de la orden número ' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . ' ha sido procesado.',
                'color'     => 'warning'
            ];
        } else if(isset($order->payment) && isset($order->filled_at)) {
            $message = [
                'message'   => 'Hemos recibido y estamos confirmando el pago de la orden número ' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
                'color'     => 'warning'
            ];
        } else if(isset($order->filled_at)) {
            $message = [
                'message'   => 'La orden número ' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . ' esta pendiente por pago.',
                'color'     => 'danger'
            ];
        } else if(is_null($order->recipient)){
            $message = [
                'message'   => 'La orden número ' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . ' no tiene beneficiaro asignado.',
                'color'     => 'danger'
            ];
        } else {
            $message = [
                'message'   => 'La orden número ' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . ' no ha sido completada.',
                'color'     => 'danger'
            ];
        }

        return view('panel.user.order.show', [
            'order'         => $order,
            'message'       => $message,
            'recipients'    => $recipients,
            'accounts'      => $accounts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Order $order)
    {
        $order->observation = 'Ordern eliminada por el usuario.';
        $order->rejected_at = now();
        $order->save();
        return redirect()->route('panel.user.order.show', ['order' => $order]);
    }

    /**
     * Agregar un beneficiario a la orden
     *
     * @param Order $order
     * @return view
     */
    public function addRecipient(Request $request, Order $order)
    {
        $request->validate([
            'recipient_id'      => 'required|exists:recipients,id',
            'reason'            => 'required|max:255'
        ]);

        $recipient = Recipient::findOrFail($request->input('recipient_id'));

        $order->recipient_id = $recipient->id;
        $order->reason = $request->input('reason');
        $order->save();
        return redirect()->route('panel.user.order.create', ['order_id' => $order->id]);
    }

    /**
     * Orden enviada para ser procesada
     *
     * @param Request $request
     * @param Order $order
     * @return void
     */
    public function fillOrder(Request $request, Order $order)
    {
        $order->filled_at = now();
        $order->save();
        event(new UserSubmitOrderEvent(Auth::user(), $order));
        return redirect()->route('panel.user.order.show', ['order' => $order->id]);
    }

    /**
     * Orden completada
     *
     * @param Request $request
     * @param Order $order
     * @return void
     */
    public function completeOrder(Request $request, Order $order)
    {
        $order->completed_at = now();
        $order->save();
        return redirect()->route('panel.user.order.index');
    }
}
