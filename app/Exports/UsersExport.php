<?php
namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(){ return User::query()->get(); }
    public function headings(): array { return ['ID','Nama','Email','Role','HP','Alamat','Status']; }
    public function map($u): array { return [$u->id,$u->name,$u->email,$u->role,$u->phone,$u->address,$u->status?'Aktif':'Nonaktif']; }
}
