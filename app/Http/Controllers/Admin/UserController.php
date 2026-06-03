<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index(){ return view('admin.users.index', ['users'=>User::latest()->paginate(10)]); }
    public function create(){ return view('admin.users.form', ['user'=>new User()]); }
    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['password'] = Hash::make($data['password']);
        $data['status'] = $request->boolean('status');
        User::create($data);
        return redirect()->route('admin.users.index')->with('success','User dibuat.');
    }
    public function edit(User $user){ return view('admin.users.form', compact('user')); }
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255','email'=>'required|email|unique:users,email,'.$user->id,'password'=>'nullable|min:6','role'=>'required|in:admin,user','phone'=>'nullable|string|max:30','address'=>'nullable|string','status'=>'nullable|boolean'
        ]);
        if (!empty($data['password'])) $data['password'] = Hash::make($data['password']); else unset($data['password']);
        $data['status'] = $request->boolean('status');
        $user->update($data);
        return redirect()->route('admin.users.index')->with('success','User diperbarui.');
    }
    public function destroy(User $user){ abort_if($user->id === auth()->id(), 422, 'Tidak bisa menghapus akun sendiri.'); $user->delete(); return back()->with('success','User dihapus.'); }
    private function validated(Request $request): array
    {
        return $request->validate(['name'=>'required|string|max:255','email'=>'required|email|unique:users,email','password'=>'required|min:6','role'=>'required|in:admin,user','phone'=>'nullable|string|max:30','address'=>'nullable|string','status'=>'nullable|boolean']);
    }
}
