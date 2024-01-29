<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

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

        $data = Order::create([
            'product_id' => $id,
            'custName' => $request->custName,
            'contact' => $request->contact,
            'status' => 'list',
        ]);


        return redirect()->route('orderSuccess');
    }

    function orderSuccess() {
        return view('customer.order-success');
    }

}
