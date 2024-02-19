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
    // untuk menampilan product di transaksi kasir
    function cashierDashboard() {
        $orders = Order::where('status', 'list')->paginate(8);
        return view('cashier.cashier-dashboard', compact('orders'));
    }

    function paymentPage($id) {
        $order = Order::find($id);
        return view('cashier.payment', compact('order'));
    }
}
