<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Book,BookEntry};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BookEntryController extends Controller
{
    public function index(){ return view('admin.entries.index', ['entries'=>BookEntry::with('book','user')->latest()->paginate(10)]); }
    public function create(){ return view('admin.entries.form', ['entry'=>new BookEntry(['entry_date'=>now()]), 'books'=>Book::orderBy('title')->get()]); }
    public function store(Request $request)
    {
        $data = $request->validate(['book_id'=>'required|exists:books,id','quantity'=>'required|integer|min:1','supplier'=>'nullable|string|max:255','note'=>'nullable|string','entry_date'=>'required|date']);
        DB::transaction(function () use ($data) {
            $data['user_id'] = auth()->id();
            BookEntry::create($data);
            Book::whereKey($data['book_id'])->increment('stock', $data['quantity']);
        });
        return redirect()->route('admin.entries.index')->with('success','Buku masuk disimpan dan stok bertambah.');
    }
    public function destroy(BookEntry $entry)
    {
        DB::transaction(function () use ($entry) {
            $entry->book()->decrement('stock', $entry->quantity);
            $entry->delete();
        });
        return back()->with('success','Data buku masuk dihapus.');
    }
}
