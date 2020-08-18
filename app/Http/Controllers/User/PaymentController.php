<?php

namespace App\Http\Controllers\User;

use App\Order;
use App\Account;
use App\Events\UserSubmitPaymentEvent;
use App\Payment;
use Carbon\Carbon;
use App\Traits\SaveImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    use SaveImage;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $payments = Payment::where('user_id', $user->id)->get();
        return view('panel.user.payment.index', [
            'payments'  => $payments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order)
    {
        $accounts = Account::where('currency_id', $order->currency_sended_id)->get();

        return view('panel.user.payment.create', [
            'order'     => $order,
            'accounts'  => $accounts
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
        $request->validate([
            'order_id'              => 'required|exists:orders,id',
            'account_id'            => 'required|exists:accounts,id',
            'transaction_number'    => 'required|max:255',
            'transaction_date'      => 'required|date',
            'payment_amount'        => 'required|numeric',
            'image'                 => 'required|image|max:5120'
        ]);

        $order = Order::find($request->input('order_id'));

        $payment = new Payment();
        $payment->user_id = Auth::id();
        $payment->order_id = $order->id;
        $payment->account_id = $request->input('account_id');
        $payment->transaction_number = $request->input('transaction_number');
        $payment->transaction_date = new Carbon($request->input('transaction_date'));
        $payment->payment_amount = $request->input('payment_amount');
        $payment->image_url = $this->saveImage($request->file('image'), "images/payment/" .$request->input('account_id'));
        $payment->payment_code = $order->payment_code;
        $payment->save();

        event(new UserSubmitPaymentEvent(Auth::user(), $order, $payment));

        return redirect()->route('panel.user.order.show', ['order' => $request->input('order_id')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }

    public function select()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        $orders = $orders->filter(function($order) {
            return is_null($order->payment) && is_null($order->rejected_at);
        });
        return view('panel.user.payment.select', [
            'orders'    => $orders
        ]);
    }
}
