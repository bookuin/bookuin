<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Book,Category};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::with('category')->when($request->q, fn($q,$s)=>$q->where('title','like',"%$s%"))->latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }
    public function create(){ return view('admin.books.form', ['book'=>new Book(), 'categories'=>Category::orderBy('name')->get()]); }
    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile('cover')) $data['cover'] = $request->file('cover')->store('covers', 'public');
        Book::create($data);
        return redirect()->route('admin.books.index')->with('success','Buku dibuat.');
    }
    public function edit(Book $book){ return view('admin.books.form', ['book'=>$book, 'categories'=>Category::orderBy('name')->get()]); }
    public function update(Request $request, Book $book)
    {
        $data = $this->validated($request);
        if ($request->hasFile('cover')) {
            if ($book->cover) Storage::disk('public')->delete($book->cover);
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }
        $book->update($data);
        return redirect()->route('admin.books.index')->with('success','Buku diperbarui.');
    }
    public function destroy(Book $book)
    {
        if ($book->cover) Storage::disk('public')->delete($book->cover);
        $book->delete();
        return back()->with('success','Buku dihapus.');
    }
    private function validated(Request $request): array
    {
        return $request->validate([
            'category_id'=>'nullable|exists:categories,id','title'=>'required|string|max:255','author'=>'nullable|string|max:255','publisher'=>'nullable|string|max:255','year'=>'nullable|digits:4','price'=>'required|numeric|min:0','stock'=>'required|integer|min:0','cover'=>'nullable|image|max:2048','description'=>'nullable|string'
        ]);
    }
}
