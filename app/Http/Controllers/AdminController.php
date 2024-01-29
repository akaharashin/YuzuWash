<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

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
            'serv1' => 'required',
            'serv2' => 'required',
            'serv3' => 'required',
            'estimate' => 'required',
        ]);;
        Product::create($data);

        return redirect()->route('admin');
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
            'serv1' => 'nullable',
            'serv2' => 'nullable',
            'serv3' => 'nullable',
            'estimate' => 'nullable',
        ]);;
        
        $product->fill([
            'name' => $request->name,
            'price' => $request->price,
            'desc' => $request->desc,
            'serv1' => $request->serv1,
            'serv2' => $request->serv2,
            'serv3' => $request->serv3,
            'estimate' => $request->estimate,
        ]);
        
        $product->save();

        return redirect()->route('admin');
    }

    function delete(Product $product) {
        $product->delete();
        return redirect()->route('admin');
    }

    function manageCashier()
    {
        $cashiers = User::where('role', 'cashier')->get();
        return view('admin.manage-cashier', compact('cashiers'));
    }

    function deleteCashier(User $user) {
        $user->delete();
        return redirect()->route('manageCashier');
    }

    function addCashierPage()
    {
        return view('admin.add-cashier');
    }

    function addCashier(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'name' => 'required',
        ]);

        $data = User::create([
            'username' => $request->username,
            'password' => $request->password,
            'name' => $request->name,
            'role' => 'cashier',
        ]);

        return redirect()->route('manageCashier');
    }

    function editCashier($id)
    {
        $cashier = User::find($id);
        return view('admin.edit-cashier', compact('cashier'));
    }
    
    function updateCashier(Request $request, User $user)
    {
        $request->validate([
            'username' => 'nullable',
            'password' => 'nullable',
            'name' => 'nullable',
        ]);;
        
        $user->fill([
            'username' => $request->username,
            'password' => $request->password,
            'name' => $request->name,
        ]);
        
        $user->save();

        return redirect()->route('manageCashier');
    }
}
