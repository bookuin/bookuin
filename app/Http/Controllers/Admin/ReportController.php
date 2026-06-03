<?php
namespace App\Http\Controllers\Admin;
use App\Exports\{BooksExport,OrdersExport,UsersExport};
use App\Http\Controllers\Controller;
use App\Models\{Book,BookEntry,BookExit,Order,User};
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
class ReportController extends Controller
{
    public function index(){ return view('admin.reports.index'); }
    public function booksPdf(){ return Pdf::loadView('admin.pdf.books', ['books'=>Book::with('category')->get()])->download('laporan-buku.pdf'); }
    public function stockPdf(){ return Pdf::loadView('admin.pdf.stock', ['books'=>Book::with('category')->orderBy('stock')->get()])->download('laporan-stok.pdf'); }
    public function entriesPdf(){ return Pdf::loadView('admin.pdf.entries', ['entries'=>BookEntry::with('book','user')->latest()->get()])->download('laporan-buku-masuk.pdf'); }
    public function exitsPdf(){ return Pdf::loadView('admin.pdf.exits', ['exits'=>BookExit::with('book','user')->latest()->get()])->download('laporan-buku-keluar.pdf'); }
    public function ordersPdf(){ return Pdf::loadView('admin.pdf.orders', ['orders'=>Order::with('user')->latest()->get()])->download('laporan-transaksi.pdf'); }
    public function booksExcel(){ return Excel::download(new BooksExport, 'data-buku.xlsx'); }
    public function usersExcel(){ return Excel::download(new UsersExport, 'data-user.xlsx'); }
    public function ordersExcel(){ return Excel::download(new OrdersExport, 'data-transaksi.xlsx'); }
}
