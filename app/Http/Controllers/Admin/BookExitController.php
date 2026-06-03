<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Book,BookExit};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BookExitController extends Controller
{
    public function index(){ return view('admin.exits.index', ['exits'=>BookExit::with('book','user')->latest()->paginate(10)]); }
    public function create(){ return view('admin.exits.form', ['exit'=>new BookExit(['exit_date'=>now()]), 'books'=>Book::orderBy('title')->get()]); }
    public function store(Request $request)
    {
        $data = $request->validate(['book_id'=>'required|exists:books,id','quantity'=>'required|integer|min:1','destination'=>'nullable|string|max:255','note'=>'nullable|string','exit_date'=>'required|date']);
        DB::transaction(function () use ($data) {
            $book = Book::lockForUpdate()->findOrFail($data['book_id']);
            if ($book->stock < $data['quantity']) abort(422, 'Stok tidak cukup.');
            $data['user_id'] = auth()->id();
            BookExit::create($data);
            $book->decrement('stock', $data['quantity']);
        });
        return redirect()->route('admin.exits.index')->with('success','Buku keluar disimpan dan stok berkurang.');
    }
    public function destroy(BookExit $exit)
    {
        DB::transaction(function () use ($exit) {
            $exit->book()->increment('stock', $exit->quantity);
            $exit->delete();
        });
        return back()->with('success','Data buku keluar dihapus.');
    }
}
