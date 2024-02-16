<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    function index()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }

    function orderForm($id)
    {
        $product = Product::find($id);
        return view('customer.order', compact('product'));
    }

    // function order(Request $request, $id) {
    //     $request->validate([
    //         'custName' => 'required',
    //         'contact' => 'required',
    //     ]);

    //     $product = Product::find($id);
    //     Order::create([
    //         'product_id' => $id,
    //         'custName' => $request->custName,
    //         'contact' => $request->contact,
    //         'status' => 'list',
    //     ]);

    //     Log::create([
    //         'user_id'=> 4,
    //         'activity' =>  $request->custName .' telah melakukan pemesanan paket '. $product->name
    //     ]);

    //     return redirect()->route('orderSuccess');
    // }


    function order(Request $request, $id)
    {
        $request->validate([
            'custName' => 'required',
            'contact' => 'required',
        ]);

        // // Periksa apakah ada waktu pemesanan terakhir dalam session
        // if (Session::has('last_order_time')) {
        //     $lastOrderTime = Session::get('last_order_time');
        //     $currentTime = now();

        //     // Periksa apakah telah berlalu 3 menit sejak pemesanan terakhir
        //     $differenceInMinutes = $currentTime->diffInMinutes($lastOrderTime);
        //     if ($differenceInMinutes < 3) {
        //         // Jika belum, kembalikan pesan kesalahan atau alihkan pengguna
        //         return redirect()->back()->with('error', 'Anda harus menunggu 3 menit sebelum melakukan pemesanan lagi.');
        //     }
        // }

        // Lanjutkan dengan pemesanan
        $product = Product::find($id);
        Order::create([
            'product_id' => $id,
            'custName' => $request->custName,
            'contact' => $request->contact,
            'status' => 'list',
        ]);

        Log::create([
            'user_id' => 4,
            'activity' =>  $request->custName . ' telah melakukan pemesanan paket ' . $product->name
        ]);

        // Simpan waktu pemesanan terakhir dalam session
        // Session::put('last_order_time', now());

        return redirect()->route('orderSuccess');
    }




    function orderSuccess()
    {
        return view('customer.order-success');
    }
}
