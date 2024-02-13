
# Sistem Informasi Bank Sampah Desa Cau Blayu

Sistem Informasi Pengelolaan Data Bank Sampah Desa Cau Belayu adalah sebuah aplikasi web yang dirancang untuk membantu pengelolaan data bank sampah di desa tersebut. Sistem ini dibuat dengan menggunakan framework Laravel 10.x dan teknologi lainnya seperti Jetstream 4.x, Tailwind 3.x, Livewire 3.x.



## Features

- Multi Auth dengan menggunakan Roles/Permissions
- Kelola Data User
- Kelola Data Nasabah
- Kelola Data Transaksi
- Kelola Data Tabungan
- Kelola Data Sampah
- Kelola Data Barang
- Kelola Data Penukaran
- Cetak Laporan melalui PDF/XLSX/CSV



## Instalasi Project

Melakukan cloning project di terminal
```bash
git clone https://github.com/WM-WiseMinds/Web-Puja.git
```
Buka directory file
```bash
cd Web-Puja
```
Melakukan instalasi composer
```bash
composer install
```
Melakukan instalasi dan build npm
```bash
npm install
npm run build
```
Membuat database dan setelahnya melakukan migration
```bash
php artisan migration
```
Untuk melakukan pengujian atau testing dengan dummy data silahkan seeding data melalui `DatabaseSeeder.php`
```bash
php artisan db:seed
```
Silahkan coba melakukan login dengan menginputkan **Email** dan **Password** berikut
```bash
admin@example.com
Password
```


## Contributors

- [@wirabudhi](https://github.com/wirabudhi)
- [@Missuyaa](https://github.com/Missuyaa)


