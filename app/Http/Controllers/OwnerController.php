<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    function report()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->paginate(8);
        return view('owner.report', compact('transactions'));
    }


    function log()
    {
        $logs = Log::orderBy('created_at' ,'desc')->paginate(10);
        return view('owner.log', compact('logs'));
    }

    function clearLog()
    {
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

    public function income(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $transactions = Transaction::query();

        if ($startDate && $endDate) {
            // Jika kedua tanggal disediakan, filter berdasarkan rentang tanggal
            $transactions->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Siapkan data untuk chart
        $labels = [];
        $incomeData = [];

        

        // Mengambil transaksi setelah filtering
        $filteredTransactions = $transactions->orderBy('created_at', 'asc')->get();
        $dataTransactions=  $transactions->orderBy('created_at', 'desc')->paginate(10);
        $incomeByDate = $filteredTransactions->groupBy(function ($transaction) {
            return Carbon::parse($transaction->created_at)->format('d-M-Y');
        });
        foreach ($incomeByDate as $date => $transactions) {
            $labels[] = $date;
            $totalIncomeChart = $transactions->sum(function($transaction){
                return $transaction->order->product->price;
            });
            $incomeData[] = $totalIncomeChart;
        }
      

        $totalCash = $filteredTransactions->sum('cash');
        $totalChange = $filteredTransactions->sum('change');
        $totalIncome = $totalCash - $totalChange;   

        return view('owner.income', compact('filteredTransactions', 'dataTransactions' , 'totalIncome', 'startDate', 'endDate', 'incomeData', 'labels'));
    }
}
