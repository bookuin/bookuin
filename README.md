# BookuIn

BookuIn adalah sistem manajemen stok dan penjualan buku berbasis Laravel, dengan fitur:

- Login admin dan user
- CRUD buku, kategori, dan user
- Buku masuk dan buku keluar dengan stok otomatis
- Biaya kirim manual
- Checkout dan payment gateway Midtrans Snap
- Webhook/notification Midtrans
- Dashboard statistik
- Laporan PDF
- Export Excel

## Teknologi

- PHP 8.2+
- Laravel 12
- MySQL
- Midtrans PHP SDK
- barryvdh/laravel-dompdf
- maatwebsite/excel

## Instalasi

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Buat database MySQL bernama `bookuin`, lalu atur `.env`:

```env
DB_DATABASE=bookuin
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migration dan seeder:

```bash
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Buka:

```text
http://127.0.0.1:8000
```

## Akun Demo

```text
Admin
Email: admin@bookuin.test
Password: password

User
Email: user@bookuin.test
Password: password
```

## Konfigurasi Midtrans

Isi credential di `.env`:

```env
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxx
MIDTRANS_IS_PRODUCTION=false
```

Webhook/Payment Notification URL di dashboard Midtrans arahkan ke:

```text
https://domain-kamu.com/midtrans/notification
```

Untuk lokal, gunakan tunnel seperti ngrok:

```bash
ngrok http 8000
```

Lalu gunakan URL ngrok:

```text
https://xxxx.ngrok-free.app/midtrans/notification
```

## Alur Sistem

1. User login.
2. User pilih buku dan masukkan ke keranjang.
3. User checkout dan pilih biaya kirim.
4. Sistem membuat order dan Snap token Midtrans.
5. User membayar via popup Snap.
6. Midtrans mengirim notification ke endpoint `/midtrans/notification`.
7. Jika status paid, sistem mengurangi stok dan mencatat buku keluar otomatis.
8. Admin dapat melihat transaksi, mengubah status pengiriman, mencetak PDF, dan export Excel.

## Catatan Produksi

- Jangan pernah taruh Server Key Midtrans di frontend.
- Gunakan HTTPS untuk webhook.
- Saat production, ubah `MIDTRANS_IS_PRODUCTION=true` dan gunakan key production.
- Jalankan queue worker jika nanti fitur email/notifikasi ditambahkan.
