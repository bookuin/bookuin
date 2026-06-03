<?php
namespace App\Exports;
use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class BooksExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(){ return Book::with('category')->get(); }
    public function headings(): array { return ['ID','Judul','Kategori','Penulis','Penerbit','Tahun','Harga','Stok']; }
    public function map($book): array { return [$book->id,$book->title,$book->category?->name,$book->author,$book->publisher,$book->year,$book->price,$book->stock]; }
}
