<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class BookEntry extends Model
{
    protected $fillable = ['book_id','user_id','quantity','supplier','note','entry_date'];
    protected function casts(): array { return ['entry_date' => 'date']; }
    public function book(){ return $this->belongsTo(Book::class); }
    public function user(){ return $this->belongsTo(User::class); }
}
