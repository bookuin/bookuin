<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
class CartController extends Controller
{
    public function index(){ return view('user.cart.index', ['items'=>$this->items()]); }
    public function add(Request $request, Book $book)
    {
        $data = $request->validate(['quantity'=>'required|integer|min:1']);
        if ($book->stock < $data['quantity']) return back()->withErrors(['quantity'=>'Stok tidak cukup.']);
        $cart = session('cart', []);
        $current = $cart[$book->id]['quantity'] ?? 0;
        $cart[$book->id] = ['book_id'=>$book->id, 'quantity'=>$current + $data['quantity']];
        session(['cart'=>$cart]);
        return redirect()->route('user.cart.index')->with('success','Buku masuk keranjang.');
    }
    public function update(Request $request, Book $book)
    {
        $data = $request->validate(['quantity'=>'required|integer|min:1']);
        $cart = session('cart', []);
        if (isset($cart[$book->id])) $cart[$book->id]['quantity'] = min($data['quantity'], $book->stock);
        session(['cart'=>$cart]);
        return back()->with('success','Keranjang diperbarui.');
    }
    public function remove(Book $book)
    {
        $cart = session('cart', []); unset($cart[$book->id]); session(['cart'=>$cart]);
        return back()->with('success','Item dihapus.');
    }
    private function items(): array
    {
        $cart = session('cart', []); $items = [];
        foreach ($cart as $row) {
            $book = Book::find($row['book_id']);
            if ($book) $items[] = ['book'=>$book,'quantity'=>$row['quantity'],'total'=>$book->price * $row['quantity']];
        }
        return $items;
    }
}
