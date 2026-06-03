<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ShippingCost;
use Illuminate\Http\Request;
class ShippingCostController extends Controller
{
    public function index(){ return view('admin.shipping.index', ['shippingCosts'=>ShippingCost::latest()->paginate(10)]); }
    public function create(){ return view('admin.shipping.form', ['shippingCost'=>new ShippingCost()]); }
    public function store(Request $request){ ShippingCost::create($this->validated($request)); return redirect()->route('admin.shipping.index')->with('success','Biaya kirim dibuat.'); }
    public function edit(ShippingCost $shipping){ return view('admin.shipping.form', ['shippingCost'=>$shipping]); }
    public function update(Request $request, ShippingCost $shipping){ $shipping->update($this->validated($request)); return redirect()->route('admin.shipping.index')->with('success','Biaya kirim diperbarui.'); }
    public function destroy(ShippingCost $shipping){ $shipping->delete(); return back()->with('success','Biaya kirim dihapus.'); }
    private function validated(Request $request): array { return $request->validate(['city'=>'required|string|max:150','courier'=>'required|string|max:80','cost'=>'required|numeric|min:0','estimated_days'=>'nullable|string|max:50']); }
}
