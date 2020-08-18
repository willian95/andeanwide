<?php

namespace App\Http\Controllers\Api\V1;

use App\Order;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\UserSubmitPaymentEvent;
use App\Http\Resources\PaymentResource;
use App\Traits\SaveImage;

class PaymentController extends Controller
{
    use SaveImage;

    public function index()
    {
        $user = Auth::user();
        $payments = Payment::where('user_id', $user->id)->paginate(15);
        return PaymentResource::collection($payments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id'              => 'required|exists:orders,id',
            'account_id'            => 'required|exists:accounts,id',
            'transaction_number'    => 'required|max:255',
            'transaction_date'      => 'required|date',
            'payment_amount'        => 'required|numeric',
            'image'                 => 'required|image'
        ]);

        $order = Order::findOrFail($request->input('order_id'));

        if($order->user_id !== Auth::id())
        {
            return response()->json([
                'message' => 'Orden no encontrada.'
            ], 404);
        }

        if(isset($order->expired_at) || isset($order->rejected_at))
        {
            return response()->json([
                'errors' => [
                    'order'  => 'La orden ya no esta activa.'
                ]
            ], 422);
        }

        if(isset($order->payment))
        {
            return response()->json([
                'errors' => [
                    'order'  => 'La orden tiene un pago cargado.'
                ]
            ], 422);
        }

        $payment = new Payment();
        $payment->user_id = Auth::id();
        $payment->order_id = $request->input('order_id');
        $payment->account_id = $request->input('account_id');
        $payment->transaction_number = $request->input('transaction_number');
        $payment->transaction_date = new Carbon($request->input('transaction_date'));
        $payment->payment_amount = $request->input('payment_amount');
        $payment->image_url = $this->saveImage($request->file('image'), "images/payment/" .$request->input('account_id'));
        $payment->save();

        event(new UserSubmitPaymentEvent(Auth::user(), Order::find($payment->order_id), $payment));

        return new PaymentResource($payment);
    }

    public function show(Payment $payment)
    {
        if($payment->user_id === Auth::id())
        {
            return new PaymentResource($payment);
        }
        return response()->json([
            'message' => 'Pago no encontrado.'
        ], 404);
    }
}
