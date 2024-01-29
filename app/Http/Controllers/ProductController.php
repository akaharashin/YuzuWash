<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    function cashierDashboard() {
        $orders = Order::where('status', 'list')->get();
        return view('cashier.cashier-dashboard', compact('orders'));
    }

    function paymentPage($id) {
        $order = Order::find($id);
        return view('cashier.payment', compact('order'));
    }
}
