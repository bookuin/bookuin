<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::with('category')->where('stock','>',0)->when($request->q, fn($q,$s)=>$q->where('title','like',"%$s%"))->latest()->paginate(12);
        return view('user.books.index', compact('books'));
    }
    public function show(Book $book){ return view('user.books.show', compact('book')); }
}
