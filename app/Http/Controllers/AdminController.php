<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index()
    {
        $products = Product::all();
        return view('admin.admin', compact('products'));
    }

    function addPage()
    {
        return view('admin.add');
    }

    function add(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'desc' => 'required',
            'services' => 'required',
            'estimate' => 'required',
        ]);

        if(auth()->user()->role == 'admin') {
            $data['user_id'] = auth()->user()->id;
            Product::create($data);
        }else{
            return back()->with('message', 'ada kesalahan');
        }

        $package = $request->name;

        Log::create([
            'user_id' => auth()->user()->id,
            'activity' => ' telah menambahkan paket ' . $package
        ]);

        return redirect()->route('admin')->with('message', 'Paket berhasil ditambahkan');
    }

    function editPage($id)
    {
        $product = Product::find($id);
        return view('admin.edit', compact('product'));
    }

    function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'nullable',
            'price' => 'nullable',
            'desc' => 'nullable',
            'services' => 'nullable',
            'estimate' => 'nullable',
        ]);

        $product->fill([
            'name' => $request->name,
            'price' => $request->price,
            'desc' => $request->desc,
            'services' => $request->services,
            'estimate' => $request->estimate,
        ]);

        $product->save();

        $package = $product->name;

        Log::create([
            'user_id' => auth()->user()->id,
            'activity' => ' telah memperbarui paket ' . $package
        ]);

        return redirect()->route('admin')->with('message', 'Paket berhasil diperbaharui');
    }

    function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        Log::create([
            'user_id' => auth()->user()->id,
            'activity' => ' telah menghapus paket ' . $product->name
        ]);
        return redirect()->route('admin')->with('message', 'Paket berhasil dihapus');;
    }

    function manageCashier()
    {
        $cashiers = User::where('role', 'cashier')->get();
        return view('admin.manage-cashier', compact('cashiers'));
    }

    function deleteCashier($id)
    {
        $user = User::findOrFail($id);
        Log::create([
            'user_id' => auth()->user()->id,
            'activity' => ' telah menghapus kasir ' . $user->name
        ]);
        if($user->id == 1){
            return back()->with('error', 'Anda tidak bisa menghapus kasir utama');
        }
        $user->delete();
        return redirect()->route('manageCashier')->with('message', 'Kasir berhasil dihapus');;
    }

    function addCashierPage()
    {
        return view('admin.add-cashier');
    }

    function addCashier(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'name' => 'required',
        ]);

        $data = User::create([
            'username' => $request->username,
            'password' => $request->password,
            'name' => $request->name,
            'role' => 'cashier',
        ]);

        Log::create([
            'user_id' => auth()->user()->id,
            'activity' => ' telah menambahkan kasir ' . $request->username
        ]);
        return redirect()->route('manageCashier')->with('message', 'Kasir telah ditambahkan');;
    }

    function editCashier($id)
    {
        $cashier = User::find($id);
        return view('admin.edit-cashier', compact('cashier'));
    }

    function updateCashier(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'username' => 'nullable',
            'password' => 'nullable',
            'name' => 'nullable',
        ]);;

        $user->fill([
            'username' => $request->username,
            'password' => $request->password,
            'name' => $request->name,
            'role' => 'cashier',
        ]);

        $user->save();

        Log::create([
            'user_id' => auth()->user()->id,
            'activity' => ' telah memperbarui kasir ' . $request->username
        ]);

        return redirect()->route('manageCashier')->with('message', 'kasir telah diperbaharui');;
    }
}
