<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Payment extends Model
{
    protected $fillable = ['order_id','payment_type','transaction_status','transaction_id','fraud_status','raw_response','paid_at'];
    protected function casts(): array { return ['raw_response'=>'array','paid_at'=>'datetime']; }
    public function order(){ return $this->belongsTo(Order::class); }
}
