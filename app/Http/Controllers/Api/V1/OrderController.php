<?php

namespace App\Http\Controllers\Api\V1;

use App\Order;
use App\Param;
use App\Symbol;
use App\Priority;
use App\Recipient;
use Carbon\Carbon;
use App\Jobs\OrderExpiracy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Traits\ExchangeRateGetter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    use ExchangeRateGetter;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $where = [['user_id', Auth::id()]];
        // if($request->query())
        // {
        //     $query = $request->only([
        //         'priority',
        //         'priority_id',
        //         'filled_at',
        //         'verified_at',
        //         'rejected_at',
        //         'expired_at',
        //         'completed_at',
        //         'symbol_id',
        //         'currency_sended_id',
        //         'currency_received_id'
        //     ]);

        //     foreach ($query as $key => $value) {
        //         $where[] = [$key, $value];
        //     }
        // }

        if($request->query('completed')==true) {
            $orders = Order::where([
                        ['user_id', Auth::id()],
                        ['completed_at', '<>', null]
                    ])
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
        } elseif($request->query('rejected')==true) {
            $orders = Order::where([
                        ['user_id', Auth::id()],
                        ['rejected_at', '<>', null]
                    ])
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
        } elseif($request->query('expired')==true) {
            $orders = Order::where([
                        ['user_id', Auth::id()],
                        ['expired_at', '<>', null]
                    ])
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
        } elseif($request->query('filled')==true) {
            $orders = Order::where([
                        ['user_id', Auth::id()],
                        ['filled_at', '<>', null]
                    ])
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
        } else {
            $orders = Order::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);
        }

        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'symbol_id'             => ['required', 'exists:symbols,id'],
            'payment_amount'        => ['required', 'numeric', 'min:0'],
            'priority_id'           => ['required', 'exists:priorities,id'],
        ]);

        $user = Auth::user();
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

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if($order->user_id === Auth::id())
        {
            return new OrderResource($order);
        }
        return response()->json([
            'message' => 'Orden no encontrado.'
        ], 404);
    }

    public function attachRecipient(Request $request, Order $order)
    {
        $request->validate([
            'recipient_id'  => [
                'required',
                Rule::exists('recipients', 'id')->where(function($query) use ($request) {
                    $query->where('user_id', Auth::id());
                })
            ],
            'reason'    => ['required', 'max:255']
        ]);

        $order->recipient_id = $request->input('recipient_id');
        $order->reason = $request->input('reason');
        $order->save();
        return new OrderResource($order);
    }

    public function detachRecipient(Request $request, Order $order)
    {
        $order->recipient_id = null;
        $order->reason = null;
        $order->save();
        return new OrderResource($order);
    }

    public function fillOrder(Request $request, Order $order)
    {
        if($order->user_id === Auth::id())
        {
            if(isset($order->filled_at)){
                return response()->json([
                    'errors' => [
                        'order' => 'La orden ya ha sido enviada.'
                    ]
                ], 422);
            }
            if(isset($order->recipient) && isset($order->payment))
            {
                $order->filled_at = now();
                $order->save();
                return new OrderResource($order);
            }
            return response()->json([
                'errors' => [
                    'order' => 'Faltan elementos por cargar.'
                ]
            ], 422);
        }
        return response()->json([
            'message' => 'Orden no encontrado.'
        ], 404);
    }
}
