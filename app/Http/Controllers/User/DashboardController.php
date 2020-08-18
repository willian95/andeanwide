<?php

namespace App\Http\Controllers\User;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // completed orders count
        $ordersQty = Order::where([
            ['user_id', $user->id],
            ['completed_at', '<>' , null]
        ])->count();

        // pending orders
        $pendingOrders = Order::where([
            ['user_id', $user->id],
            ['filled_at', '<>', null],
            ['verified_at', null],
            ['expired_at', null],
            ['rejected_at', null],
            ['completed_at', null]
        ])->get();

        // orders with pending payment count
        $pendingPaymentOrderQty = $pendingOrders->filter(function($order) {
            return is_null($order->payment);
        })->count();

        $processingOrdersQty = $pendingOrders->filter(function($order) {
            return isset($order->payment);
        })->count();
        
        $orders = Order::where([
            ['user_id', $user->id],
        ])
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get(); 
        
        return view('panel.user.dashboard.index', [
            'user'                      => $user,
            'ordersQty'                 => $ordersQty,
            'pendingPaymentOrderQty'    => $pendingPaymentOrderQty,
            'processingOrderQty'        => $processingOrdersQty,
            // 'pendingOrdersQty'          => $pendingOrdersQty,
            'orders'                    => $orders,
        ]);
    }
}
