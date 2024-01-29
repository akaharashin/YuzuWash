<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TransactionController extends Controller
{

    function payment(Request $request, $id)
    {
        $request->validate([
            'custName' => 'required',
            'contact' => 'required',
            'cash' => 'required',
        ]);

        $order = Order::find($id);
        $data = Transaction::create([
            'order_id' => $id,
            'custName' => $request->custName,
            'contact' => $request->contact,
            'uniqcode' => 'INV-' . Str::random(10),
            'cash' => $request->cash,
            'change' => $request->cash - $order->product->price,
        ]);

        $order->status = 'paid';
        $order->save();

        return redirect()->route('paymentSuccess', $id);
    }

    function paymentSuccess($id)
    {
        $transaction = Transaction::find($id);
        return view('cashier.payment-success', compact('transaction'));
    }

    function paymentHistory()
    {
        $transactions = Transaction::paginate(10);
        return view('cashier.payment-history', compact('transactions'));
    }
}
