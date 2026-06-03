<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\User;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('user.books.index'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::post('/midtrans/notification', [User\OrderController::class, 'notification'])->name('midtrans.notification');

Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', Admin\CategoryController::class)->except('show');
    Route::resource('books', Admin\BookController::class)->except('show');
    Route::resource('users', Admin\UserController::class)->except('show');
    Route::resource('entries', Admin\BookEntryController::class)->only(['index','create','store','destroy']);
    Route::resource('exits', Admin\BookExitController::class)->only(['index','create','store','destroy']);
    Route::resource('shipping', Admin\ShippingCostController::class)->parameters(['shipping'=>'shipping'])->except('show');
    Route::get('orders', [Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [Admin\OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [Admin\OrderController::class, 'updateStatus'])->name('orders.status');
    Route::get('reports', [Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/books/pdf', [Admin\ReportController::class, 'booksPdf'])->name('reports.books.pdf');
    Route::get('reports/stock/pdf', [Admin\ReportController::class, 'stockPdf'])->name('reports.stock.pdf');
    Route::get('reports/entries/pdf', [Admin\ReportController::class, 'entriesPdf'])->name('reports.entries.pdf');
    Route::get('reports/exits/pdf', [Admin\ReportController::class, 'exitsPdf'])->name('reports.exits.pdf');
    Route::get('reports/orders/pdf', [Admin\ReportController::class, 'ordersPdf'])->name('reports.orders.pdf');
    Route::get('reports/books/excel', [Admin\ReportController::class, 'booksExcel'])->name('reports.books.excel');
    Route::get('reports/users/excel', [Admin\ReportController::class, 'usersExcel'])->name('reports.users.excel');
    Route::get('reports/orders/excel', [Admin\ReportController::class, 'ordersExcel'])->name('reports.orders.excel');
});

Route::middleware(['auth','user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [User\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/books', [User\BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [User\BookController::class, 'show'])->name('books.show');
    Route::get('/cart', [User\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{book}', [User\CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{book}', [User\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{book}', [User\CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [User\OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [User\OrderController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [User\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [User\OrderController::class, 'show'])->name('orders.show');
});

Route::get('/books', [User\BookController::class, 'index'])->name('public.books.index');
