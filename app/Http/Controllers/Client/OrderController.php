<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('client.order.index', [
            'title' => __('Send Packages'),
        ]);
    }

    public function show(Order $order)
    {
        return view('client.order.single', [
            'title' => __('Order #') . $order->reference,
            'order' => $order,
        ]);
    }

    public function track(Order $order)
    {
        return view('client.order.track', [
            'title' => __('Order #') . $order->reference . __(' History'),
            'order' => $order,
        ]);
    }
}
