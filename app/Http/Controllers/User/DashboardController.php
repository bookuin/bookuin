<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\{Book,Order};
class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard.index', [
            'books' => Book::with('category')->latest()->limit(8)->get(),
            'orders' => Order::where('user_id', auth()->id())->latest()->limit(5)->get(),
        ]);
    }
}
