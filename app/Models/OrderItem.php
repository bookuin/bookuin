<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OrderItem extends Model
{
    protected $fillable = ['order_id','book_id','quantity','price','total'];
    protected function casts(): array { return ['price'=>'decimal:2','total'=>'decimal:2']; }
    public function order(){ return $this->belongsTo(Order::class); }
    public function book(){ return $this->belongsTo(Book::class); }
}
