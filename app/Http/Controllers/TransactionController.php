<?php

namespace App\Http\Controllers;

use App\Models\Log;
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

        $uniqcode = $data->uniqcode;

        Log::create([
            'user_id' => auth()->user()->id,
            'activity' => ' telah melakukan pembayaran paket '. $order->product->name . ' dengan kode ' . $uniqcode
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
        $transactions = Transaction::paginate(8);
        return view('cashier.payment-history', compact('transactions'));
    }

    function report()
    {
        $transactions = Transaction::paginate(8);
        return view('owner.report', compact('transactions'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $transactions = Transaction::where(function ($query) use ($search) {
            $query->whereHas('order', function ($subQuery) use ($search) {
                $subQuery->where('custName', 'LIKE', "%$search%")
                         ->orWhere('contact', 'LIKE', "%$search%");
            })
            ->orWhere('cash', 'LIKE', "%$search%")
            ->orWhere('change', 'LIKE', "%$search%")
            ->orWhere('uniqcode', 'LIKE', "%$search%");
        })->paginate(10);

        return view('owner.report', compact('transactions'));
    }

    function log() {
        $logs = Log::all();
        return view('log', compact('logs'));
    }

    function income(Request $request) {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $transactions = Transaction::query();
    
        if ($startDate && $endDate) {
            // Jika kedua tanggal disediakan, filter berdasarkan rentang tanggal
            $transactions->whereBetween('created_at', [$startDate, $endDate]);
        }
    
        $transactions = $transactions->get();
        $totalIncome = $transactions->sum('cash');
    
        return view('owner.income', compact('transactions', 'totalIncome'));
    }
    
}
