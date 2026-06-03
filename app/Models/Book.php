<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Book extends Model
{
    protected $fillable = ['category_id','title','author','publisher','year','price','stock','cover','description'];
    protected function casts(): array { return ['price' => 'decimal:2']; }
    public function category(){ return $this->belongsTo(Category::class); }
    public function entries(){ return $this->hasMany(BookEntry::class); }
    public function exits(){ return $this->hasMany(BookExit::class); }
}
