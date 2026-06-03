<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ShippingCost extends Model
{
    protected $fillable = ['city','courier','cost','estimated_days'];
    protected function casts(): array { return ['cost' => 'decimal:2']; }
    public function orders(){ return $this->hasMany(Order::class); }
}
