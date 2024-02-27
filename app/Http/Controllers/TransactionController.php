<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TransactionController extends Controller
{

    // untuk menampilan product di transaksi kasir
    function cashierDashboard() {
        $orders = Order::orderBy('created_at', 'asc')->where('status', 'list')->paginate(8);
        return view('cashier.cashier-dashboard', compact('orders'));
    }

    function paymentPage($id) {
        $order = Order::find($id);
        return view('cashier.payment', compact('order'));
    }

    function payment(Request $request, $id)
    {
        $request->validate([
            'cash' => 'required',
        ]);

        $order = Order::find($id);
        $transaction = Transaction::create([
            'order_id' => $id,
            'user_id' => auth()->user()->id,
            'custName' => $request->custName,
            'contact' => $request->contact,
            'uniqcode' => 'INV-' . Str::random(10),
            'cash' => $request->cash,
            'change' => $request->cash - $order->product->price,
        ]);

        $uniqcode = $transaction->uniqcode;

        Log::create([
            'user_id' => auth()->user()->id,
            'activity' => ' telah melakukan pembayaran paket '. $order->product->name . ' dengan kode ' . $uniqcode
        ]);

        $order->status = 'paid';
        $order->save();

        return redirect()->route('paymentSuccess', $transaction->id);
    }

    function paymentSuccess($id)
    {
        $transaction = Transaction::with('order')->find($id);
        return view('cashier.payment-success', compact('transaction'));
    }

    function paymentHistory()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->paginate(8);
        return view('cashier.payment-history', compact('transactions'));
    }

    function deleteOrder($id) {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('cashierDashboard')->with('message', 'Pesanan berhasil dihapus');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $transactions = Transaction::where(function ($query) use ($search) {
            $query->whereHas('order', function ($subQuery) use ($search) {
                $subQuery->where('customer', 'LIKE', "%$search%")
                         ->orWhere('contact', 'LIKE', "%$search%");
            })
            ->orWhere('cash', 'LIKE', "%$search%")
            ->orWhere('change', 'LIKE', "%$search%")
            ->orWhere('uniqcode', 'LIKE', "%$search%");
        })->paginate(10);

        return view('cashier.payment-history', compact('transactions'));
    }
    
}
