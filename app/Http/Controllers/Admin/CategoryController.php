<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
class CategoryController extends Controller
{
    public function index(){ return view('admin.categories.index', ['categories' => Category::latest()->paginate(10)]); }
    public function create(){ return view('admin.categories.form', ['category' => new Category()]); }
    public function store(Request $request){ Category::create($request->validate(['name'=>'required|string|max:100|unique:categories,name'])); return redirect()->route('admin.categories.index')->with('success','Kategori dibuat.'); }
    public function edit(Category $category){ return view('admin.categories.form', compact('category')); }
    public function update(Request $request, Category $category){ $category->update($request->validate(['name'=>'required|string|max:100|unique:categories,name,'.$category->id])); return redirect()->route('admin.categories.index')->with('success','Kategori diperbarui.'); }
    public function destroy(Category $category){ $category->delete(); return back()->with('success','Kategori dihapus.'); }
}
