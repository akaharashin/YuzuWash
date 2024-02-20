<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    function report()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->paginate(8);
        return view('owner.report', compact('transactions'));
    }


    function log() {
        $logs = Log::all();
        return view('owner.log', compact('logs'));
    }

    function clearLog() {
        Log::truncate();
        return redirect()->route('log')->with('message', 'Log telah dibersihkan');
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

        return view('owner.report', compact('transactions'));
    }

    function income(Request $request) {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $transactions = Transaction::query();
    
        if ($startDate && $endDate) {
            // Jika kedua tanggal disediakan, filter berdasarkan rentang tanggal
            $transactions->whereBetween('created_at', [$startDate, $endDate]);
        }
    
        $transactions = $transactions->orderBy('created_at', 'asc')->get();
        $totalCash = $transactions->sum('cash');
        $totalChange = $transactions->sum('change');
        $totalIncome = $totalCash - $totalChange;
    
        return view('owner.income', compact('transactions', 'totalIncome'));
    }
    
}
