<?php

namespace Database\Seeders;

use App\Models\{Book,Category,ShippingCost,User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email'=>'admin@bookuin.test'], ['name'=>'Admin BookuIn','password'=>Hash::make('password'),'role'=>'admin','status'=>true]);
        User::updateOrCreate(['email'=>'user@bookuin.test'], ['name'=>'User Demo','password'=>Hash::make('password'),'role'=>'user','phone'=>'08123456789','address'=>'Jakarta','status'=>true]);

        $categories = ['Novel','Teknologi','Bisnis','Pendidikan'];
        foreach ($categories as $name) Category::firstOrCreate(['name'=>$name]);

        $catNovel = Category::where('name','Novel')->first();
        $catTech = Category::where('name','Teknologi')->first();
        $catBiz = Category::where('name','Bisnis')->first();
        $catEdu = Category::where('name','Pendidikan')->first();

        Book::updateOrCreate(['title'=>'Laravel Cepat untuk Pemula'], ['category_id'=>$catTech->id,'author'=>'BookuIn Team','publisher'=>'BookuIn Press','year'=>2026,'price'=>99000,'stock'=>25,'description'=>'Panduan praktis membuat aplikasi Laravel dari dasar.']);
        Book::updateOrCreate(['title'=>'Manajemen Toko Buku Modern'], ['category_id'=>$catBiz->id,'author'=>'N. Muhammad','publisher'=>'BookuIn Press','year'=>2026,'price'=>120000,'stock'=>15,'description'=>'Strategi mengelola stok, transaksi, dan laporan toko buku.']);
        Book::updateOrCreate(['title'=>'Cerita di Rak Ketiga'], ['category_id'=>$catNovel->id,'author'=>'Aulia R.','publisher'=>'Nusantara Books','year'=>2025,'price'=>75000,'stock'=>30,'description'=>'Novel ringan tentang perjalanan seorang penjaga perpustakaan.']);
        Book::updateOrCreate(['title'=>'Belajar Database MySQL'], ['category_id'=>$catEdu->id,'author'=>'Dimas K.','publisher'=>'Data Edu','year'=>2024,'price'=>85000,'stock'=>20,'description'=>'Dasar-dasar database, relasi, dan query MySQL.']);

        foreach ([['Jakarta','Reguler',15000,'1-2 hari'],['Bandung','Reguler',18000,'2-3 hari'],['Surabaya','Reguler',25000,'3-4 hari'],['Medan','Reguler',35000,'4-5 hari']] as $s) {
            ShippingCost::firstOrCreate(['city'=>$s[0],'courier'=>$s[1]], ['cost'=>$s[2],'estimated_days'=>$s[3]]);
        }
    }
}
