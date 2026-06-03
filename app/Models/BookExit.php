<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class BookExit extends Model
{
    protected $fillable = ['book_id','user_id','quantity','destination','note','exit_date'];
    protected function casts(): array { return ['exit_date' => 'date']; }
    public function book(){ return $this->belongsTo(Book::class); }
    public function user(){ return $this->belongsTo(User::class); }
}
