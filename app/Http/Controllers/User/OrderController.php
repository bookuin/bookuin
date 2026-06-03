<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\{Book,BookExit,Order,OrderItem,Payment,ShippingCost};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;
class OrderController extends Controller
{
    public function index(){ return view('user.orders.index', ['orders'=>Order::with('items.book')->where('user_id',auth()->id())->latest()->paginate(10)]); }
    public function show(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);
        return view('user.orders.show', ['order'=>$order->load('items.book','payments','shipping')]);
    }
    public function checkout()
    {
        $items = $this->cartItems();
        if (count($items) === 0) return redirect()->route('user.books.index')->withErrors(['cart'=>'Keranjang kosong.']);
        return view('user.cart.checkout', ['items'=>$items,'shippingCosts'=>ShippingCost::orderBy('city')->get()]);
    }
    public function store(Request $request)
    {
        $data = $request->validate(['shipping_cost_id'=>'required|exists:shipping_costs,id']);
        $items = $this->cartItems();
        if (count($items) === 0) return redirect()->route('user.cart.index')->withErrors(['cart'=>'Keranjang kosong.']);
        $order = DB::transaction(function () use ($items, $data) {
            $shipping = ShippingCost::findOrFail($data['shipping_cost_id']);
            $subtotal = array_sum(array_column($items, 'total'));
            $order = Order::create([
                'user_id'=>auth()->id(), 'shipping_cost_id'=>$shipping->id,
                'order_code'=>'BK'.now()->format('YmdHis').auth()->id(),
                'subtotal'=>$subtotal, 'shipping_cost'=>$shipping->cost, 'total'=>$subtotal + $shipping->cost,
                'payment_status'=>'pending', 'order_status'=>'waiting_payment',
            ]);
            foreach ($items as $item) {
                $book = Book::lockForUpdate()->findOrFail($item['book']->id);
                if ($book->stock < $item['quantity']) abort(422, 'Stok '.$book->title.' tidak cukup.');
                OrderItem::create(['order_id'=>$order->id,'book_id'=>$book->id,'quantity'=>$item['quantity'],'price'=>$book->price,'total'=>$item['total']]);
            }
            $token = $this->createSnapToken($order->load('items.book','user'));
            $order->update(['midtrans_order_id'=>$order->order_code, 'snap_token'=>$token]);
            session()->forget('cart');
            return $order;
        });
        return redirect()->route('user.orders.show', $order)->with('success','Order dibuat. Silakan lanjut pembayaran.');
    }
    public function notification(Request $request)
    {
        $this->midtransConfig();
        $notification = new Notification();
        $order = Order::where('order_code', $notification->order_id)->firstOrFail();
        $status = $notification->transaction_status;
        $fraud = $notification->fraud_status ?? null;
        $paymentStatus = match ($status) {
            'capture' => $fraud === 'challenge' ? 'pending' : 'paid',
            'settlement' => 'paid',
            'pending' => 'pending',
            'deny' => 'failed',
            'expire' => 'expired',
            'cancel' => 'cancelled',
            default => $order->payment_status,
        };
        DB::transaction(function () use ($order, $notification, $paymentStatus) {
            $alreadyPaid = $order->payment_status === 'paid';
            $order->update(['payment_status'=>$paymentStatus, 'order_status'=>$paymentStatus === 'paid' ? 'paid' : $order->order_status]);
            Payment::create([
                'order_id'=>$order->id,'payment_type'=>$notification->payment_type ?? null,'transaction_status'=>$notification->transaction_status ?? null,
                'transaction_id'=>$notification->transaction_id ?? null,'fraud_status'=>$notification->fraud_status ?? null,
                'raw_response'=>(array) $notification,'paid_at'=>$paymentStatus === 'paid' ? now() : null,
            ]);
            if ($paymentStatus === 'paid' && !$alreadyPaid) {
                foreach ($order->items as $item) {
                    $book = Book::lockForUpdate()->find($item->book_id);
                    if ($book && $book->stock >= $item->quantity) {
                        $book->decrement('stock', $item->quantity);
                        BookExit::create(['book_id'=>$book->id,'user_id'=>$order->user_id,'quantity'=>$item->quantity,'destination'=>'Order '.$order->order_code,'note'=>'Otomatis dari pembayaran Midtrans','exit_date'=>now()->toDateString()]);
                    }
                }
            }
        });
        return response()->json(['message'=>'Notification handled']);
    }
    private function createSnapToken(Order $order): string
    {
        $this->midtransConfig();
        $items = $order->items->map(fn($i)=>['id'=>(string)$i->book_id,'price'=>(int)$i->price,'quantity'=>$i->quantity,'name'=>substr($i->book->title,0,50)])->toArray();
        $items[] = ['id'=>'shipping','price'=>(int)$order->shipping_cost,'quantity'=>1,'name'=>'Biaya Kirim'];
        return Snap::getSnapToken([
            'transaction_details'=>['order_id'=>$order->order_code,'gross_amount'=>(int)$order->total],
            'item_details'=>$items,
            'customer_details'=>['first_name'=>$order->user->name,'email'=>$order->user->email,'phone'=>$order->user->phone],
        ]);
    }
    private function midtransConfig(): void
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = (bool) config('services.midtrans.is_production');
        Config::$isSanitized = (bool) config('services.midtrans.is_sanitized');
        Config::$is3ds = (bool) config('services.midtrans.is_3ds');
    }
    private function cartItems(): array
    {
        $cart = session('cart', []); $items = [];
        foreach ($cart as $row) {
            $book = Book::find($row['book_id']);
            if ($book) $items[] = ['book'=>$book,'quantity'=>$row['quantity'],'total'=>$book->price * $row['quantity']];
        }
        return $items;
    }
}
