<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $agentsQty = $users->filter(function($user) {
            return $user->hasRole('agent');
        })->count();

        $usersQty = $users->filter(function($user) {
            return $user->hasRole('user');
        })->count();

        $completedOrders = Order::where('completed_at', '<>', null)->with('user')->get()->take(10);
        $pendingProcessPaymentOrders = Order::where([
            ['filled_at', '<>', null],
            ['verified_at', null],
            ['rejected_at', null],
            ['expired_at', null],
            ['completed_at', null]
        ])->orderBy('created_at', 'asc')->get();

        $pendingProcessPaymentOrders = $pendingProcessPaymentOrders->filter(function($order){
            return isset($order->payment);
        });

        $pendingClosePaymentOrders = ORder::where([
            ['filled_at', '<>', null],
            ['verified_at', '<>', null],
            ['rejected_at', null],
            ['expired_at', null],
            ['completed_at', null]
        ])->orderBy('created_at', 'asc')->get();

        return view('panel.admin.dashboard.index', [
            'agentsQty'             => $agentsQty,
            'usersQty'              => $usersQty,
            'completedOrders'       => $completedOrders,
            'pendingOrdersQty'              => $pendingProcessPaymentOrders->count(),
            'pendingOrders'                 => $pendingProcessPaymentOrders,
            'pendingClosePaymentOrdersQty'  => $pendingClosePaymentOrders->count(),
            'pendingClosePaymentOrders'     => $pendingClosePaymentOrders,
        ]);
    }

    public function reports()
    {
        // TODO: Ordenar esta vista
        return view('panel.reportes');
    }
}
