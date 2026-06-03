<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Book,BookEntry,BookExit,Order,User};
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'books' => Book::count(),
            'users' => User::where('role','user')->count(),
            'stock' => Book::sum('stock'),
            'paid' => Order::where('payment_status','paid')->count(),
            'revenue' => Order::where('payment_status','paid')->sum('total'),
            'entries_month' => BookEntry::whereMonth('entry_date', now()->month)->whereYear('entry_date', now()->year)->sum('quantity'),
            'exits_month' => BookExit::whereMonth('exit_date', now()->month)->whereYear('exit_date', now()->year)->sum('quantity'),
        ];
        $topBooks = Book::query()->orderBy('stock','asc')->limit(5)->get();
        $sales = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))
            ->where('payment_status','paid')->groupBy('date')->latest('date')->limit(7)->get()->reverse();
        return view('admin.dashboard.index', compact('stats','topBooks','sales'));
    }
}
