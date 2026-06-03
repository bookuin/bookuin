# Deploy BookuIn ke Railway

Error `ext-gd is missing` terjadi karena package `maatwebsite/excel` memakai `phpoffice/phpspreadsheet`, dan package tersebut membutuhkan ekstensi PHP GD. Dockerfile ini sudah meng-install ekstensi `gd`.

## Langkah deploy

1. Upload/update project ini ke GitHub.
2. Pastikan file `Dockerfile` ada di root project, sejajar dengan `composer.json`.
3. Deploy ulang project di Railway.
4. Tambahkan variable environment di Railway:

```env
APP_NAME=BookuIn
APP_ENV=production
APP_KEY=base64:ISI_DENGAN_KEY_LARAVEL
APP_DEBUG=false
APP_URL=https://domain-railway-kamu.up.railway.app

DB_CONNECTION=mysql
DB_HOST=ISI_HOST_DATABASE
DB_PORT=3306
DB_DATABASE=ISI_NAMA_DATABASE
DB_USERNAME=ISI_USERNAME_DATABASE
DB_PASSWORD=ISI_PASSWORD_DATABASE

MIDTRANS_SERVER_KEY=ISI_SERVER_KEY_SANDBOX
MIDTRANS_CLIENT_KEY=ISI_CLIENT_KEY_SANDBOX
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

Untuk membuat `APP_KEY`, jalankan di lokal:

```bash
php artisan key:generate --show
```

Lalu copy hasilnya ke variable `APP_KEY` di Railway.

## Midtrans webhook

Set notification URL di dashboard Midtrans:

```text
https://domain-railway-kamu.up.railway.app/api/midtrans/notification
```
