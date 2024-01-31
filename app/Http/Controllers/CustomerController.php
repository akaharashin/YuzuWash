<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    function index() {
        $products = Product::all();
        return view('index', compact('products'));
    }

    function orderForm($id) {
        $product = Product::find($id);
        return view('customer.order', compact('product'));
    }

    function order(Request $request, $id) {
        $request->validate([
            'custName' => 'required',
            'contact' => 'required',
        ]);

        $product = Product::find($id);
        Order::create([
            'product_id' => $id,
            'custName' => $request->custName,
            'contact' => $request->contact,
            'status' => 'list',
        ]);

        Log::create([
            'user_id'=> 4,
            'activity' =>  $request->custName .' telah melakukan pemesanan paket '. $product->name
        ]);

        return redirect()->route('orderSuccess');
    }

    function orderSuccess() {
        return view('customer.order-success');
    }

}
