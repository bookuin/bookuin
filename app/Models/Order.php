<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    protected $fillable = ['user_id','shipping_cost_id','order_code','subtotal','shipping_cost','total','payment_status','order_status','midtrans_order_id','snap_token'];
    protected function casts(): array { return ['subtotal'=>'decimal:2','shipping_cost'=>'decimal:2','total'=>'decimal:2']; }
    public function user(){ return $this->belongsTo(User::class); }
    public function items(){ return $this->hasMany(OrderItem::class); }
    public function payments(){ return $this->hasMany(Payment::class); }
    public function shipping(){ return $this->belongsTo(ShippingCost::class, 'shipping_cost_id'); }
}
