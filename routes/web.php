<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// guest
Route::get('/', [CustomerController::class, 'index'])->name('home');
// guest
Route::middleware('guest')->group(function () {
    Route::get('/package/{product}', [CustomerController::class, 'orderForm'])->name('orderForm');
    Route::post('/package/{product}', [CustomerController::class, 'order'])->name('order');
    Route::get('/order-success', [CustomerController::class, 'orderSuccess'])->name('orderSuccess');
    Route::get('/login-page', [AuthController::class, 'loginPage'])->name('loginPage');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // cashier
    Route::middleware('cashier')->group(function () {
        Route::get('/cashier-dashboard', [TransactionController::class, 'cashierDashboard'])->name('cashierDashboard');
        Route::get('/delete/{order}', [TransactionController::class, 'deleteOrder'])->name('deleteOrder');
        Route::get('/payment/{order}', [TransactionController::class, 'paymentPage'])->name('paymentPage');
        Route::post('/payment/{order}', [TransactionController::class, 'payment'])->name('payment');
        Route::get('/payment-success/{transaction}', [TransactionController::class, 'paymentSuccess'])->name('paymentSuccess');
        Route::get('/payment-history', [TransactionController::class, 'paymentHistory'])->name('paymentHistory');
        Route::get('/history-transactions-search', [TransactionController::class, 'search'])->name('transactions.search.cashier');
    });
    // admin
    Route::middleware('admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::get('/addPage', [AdminController::class, 'addPage'])->name('addPage');
        Route::post('/add', [AdminController::class, 'add'])->name('add');
        Route::get('/manage-cashier', [AdminController::class, 'manageCashier'])->name('manageCashier');
        Route::get('/add-cashier', [AdminController::class, 'addCashierPage'])->name('addCashierPage');
        Route::post('/add-cashier', [AdminController::class, 'addCashier'])->name('addCashier');
        Route::get('/edit-cashier/{cashier}', [AdminController::class, 'editCashier'])->name('editCashier');
        Route::post('/update-cashier{cashier}', [AdminController::class, 'updateCashier'])->name('updateCashier');
        Route::post('/delete-cashier/{user}', [AdminController::class, 'deleteCashier'])->name('deleteCashier');
        Route::get('/editPage/{product}', [AdminController::class, 'editPage'])->name('editPage');
        Route::post('/update{product}', [AdminController::class, 'update'])->name('update');
        Route::post('/delete/{product}', [AdminController::class, 'delete'])->name('delete');
    });

    // owner
    Route::middleware('owner')->group(function () {
        Route::get('/report', [OwnerController::class, 'report'])->name('report');
        Route::get('/transactions/search', [OwnerController::class, 'search'])->name('transactions.search');
        Route::get('/income', [OwnerController::class, 'income'])->name('income');
        Route::get('/log', [OwnerController::class, 'log'])->name('log');
        Route::post('/clear-log', [OwnerController::class, 'clearLog'])->name('clearLog');
    });
});
