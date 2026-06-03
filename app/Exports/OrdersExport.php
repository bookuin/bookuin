<?php
namespace App\Exports;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(){ return Order::with('user')->latest()->get(); }
    public function headings(): array { return ['Kode','User','Subtotal','Ongkir','Total','Payment','Order','Tanggal']; }
    public function map($o): array { return [$o->order_code,$o->user?->name,$o->subtotal,$o->shipping_cost,$o->total,$o->payment_status,$o->order_status,$o->created_at?->format('Y-m-d H:i')]; }
}
