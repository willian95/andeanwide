<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

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

        $pendingIdentityUsers = User::role('user')->where('is_active_account', true)
            ->whereHas('identity', function(Builder $query){
                $query->where('verified_at', null);
            })->get();

        $pendingAddressUsers = User::role('user')->where('is_active_account', true)
            ->whereHas('address', function(Builder $query){
                $query->where('verified_at', null);
            })->whereHas('identity', function(Builder $query){
                $query->where('verified_at', '<>', null);
            })->get();

        return view('panel.admin.dashboard.index', [
            'agentsQty'             => $agentsQty,
            'usersQty'              => $usersQty,
            'completedOrders'       => $completedOrders,
            'pendingOrdersQty'              => $pendingProcessPaymentOrders->count(),
            'pendingOrders'                 => $pendingProcessPaymentOrders,
            'pendingClosePaymentOrdersQty'  => $pendingClosePaymentOrders->count(),
            'pendingClosePaymentOrders'     => $pendingClosePaymentOrders,
            'pendingIdentityUsers'          => $pendingIdentityUsers,
            'pendingAddressUsers'           => $pendingAddressUsers,
        ]);
    }

    public function reports()
    {
        // TODO: Ordenar esta vista
        return view('panel.reportes');
    }
}
