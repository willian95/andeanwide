<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminOrderExcecutedEvent;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\AdminPaymentReceiveEvent;
use App\Events\AdminPaymentRecjectionEvent;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('panel.admin.order.index', [
            'orders'    => $orders,
        ]);
    }
    public function indexNew()
    {
        $pendingProcessPaymentOrders = Order::where([
            ['filled_at', '<>', null],
            ['verified_at', null],
            ['rejected_at', null],
            ['expired_at', null],
            ['completed_at', null]
        ])->orderBy('created_at', 'asc')->paginate(15);

        return view('panel.admin.order.index', [
            'orders'    => $pendingProcessPaymentOrders,
        ]);
    }

    public function indexUnconfirmed()
    {
        $pendingClosePaymentOrders = ORder::where([
            ['filled_at', '<>', null],
            ['verified_at', '<>', null],
            ['rejected_at', null],
            ['expired_at', null],
            ['completed_at', null]
        ])->orderBy('created_at', 'asc')->paginate(15);

        return view('panel.admin.order.index', [
            'orders'    => $pendingClosePaymentOrders,
        ]);
    }

    public function indexConfirmed()
    {
        $completedOrders = Order::where('completed_at', '<>', null)
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->paginate(15);

        return view('panel.admin.order.index', [
            'orders'    => $completedOrders,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order->user;
        return view('panel.admin.order.show', [
            'order' => $order
        ]);
    }

    public function verify(Request $request, Order $order)
    {
        $request->validate([
            'observation'   => 'nullable|max:255',
        ]);

        $order->verified_at = now();
        $order->observation = $request->input('observation');
        $order->save();

        $order->payment->verified_at = now();
        $order->payment->observation = $request->input('observation');
        $order->payment->save();

        event(new AdminPaymentReceiveEvent($order->user, $order));

        return redirect()->route('panel.admin.orders.show', [
            'order' => $order
        ]);
    }

    public function complete(Request $request, Order $order)
    {
        $request->validate([
            'observation'   => 'nullable|max:255',
        ]);

        $order->completed_at = now();
        $order->observation;
        $order->save();

        event(new AdminOrderExcecutedEvent($order->user, $order));

        return redirect()->route('panel.admin.orders.show', [
            'order' => $order
        ]);
    }

    public function reject(Request $request, Order $order)
    {
        $request->validate([
            'observation'   => 'required|max:255',
        ]);

        $order->rejected_at = now();
        $order->observation = $request->input('observation');
        $order->save();

        $order->payment->rejected_at = now();
        $order->payment->observation = $request->input('observation');
        $order->payment->save();

        event(new AdminPaymentRecjectionEvent($order->user, $order));

        return redirect()->route('panel.admin.orders.show', [
            'order' => $order
        ]);
    }
}
