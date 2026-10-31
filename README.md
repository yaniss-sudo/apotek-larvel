# Aplikasi Apotek Terintegrasi

Aplikasi manajemen data apotek berbasis web yang dibangun dengan **Laravel 12**. Aplikasi ini mengelola tiga data utama, yaitu **Pelanggan**, **Staf Apotek**, dan **Daftar Obat**, serta menyediakan **REST API** yang dapat diuji melalui **Postman**.

Proyek ini disusun untuk memenuhi Tugas Kelompok mata kuliah Sistem Terintegrasi.

---

## Informasi Proyek

| Keterangan | Isi |
|---|---|
| Mata Kuliah | Sistem Terintegrasi |
| Kelas | TRKJ 2C |
| Dosen Pengampu | Hari Toha Hidayat |
| Tahun | 2026 |
| Kelompok | KELOMPOK 5 |

## Anggota Kelompok

| No | Nama Lengkap | NIM |
|---|---|---|
| 1 | Yanissullah | 2025903430080
| 2 | Hidayatus Salikin | 2025903430089 |
| 3 | [ISI NAMA ANGGOTA 3] |
| 4 | [ISI NAMA ANGGOTA 4] | 

---

## Daftar Isi

1. [Deskripsi Aplikasi](#deskripsi-aplikasi)
2. [Fitur](#fitur)
3. [Teknologi yang Digunakan](#teknologi-yang-digunakan)
4. [Struktur Database](#struktur-database)
5. [Struktur Folder](#struktur-folder)
6. [Prasyarat](#prasyarat)
7. [Instalasi dan Menjalankan Aplikasi](#instalasi-dan-menjalankan-aplikasi)
8. [Penggunaan Aplikasi Web](#penggunaan-aplikasi-web)
9. [Dokumentasi API dan Pengujian Postman](#dokumentasi-api-dan-pengujian-postman)
10. [Seeder (Data Contoh)](#seeder-data-contoh)
11. [Pemecahan Masalah](#pemecahan-masalah)

---

## Deskripsi Aplikasi

Aplikasi ini menggantikan pencatatan manual di apotek dengan sistem terkomputerisasi. Data disimpan di database relasional (MariaDB/MySQL) dan dapat diakses dengan dua cara:

1. **Antarmuka web** (Blade + Bootstrap) untuk pengguna sehari-hari.
2. **REST API** (format JSON) untuk integrasi dengan sistem lain dan pengujian melalui Postman.

Kedua cara tersebut memakai controller, model, dan database yang sama, sehingga data yang diubah lewat web langsung terlihat di API dan sebaliknya. Inilah bentuk sederhana dari integrasi sistem pada proyek ini.

## Fitur

**Modul Pelanggan**
- Menyimpan data pelanggan (nama, alamat, nomor HP).
- Menampilkan dan menghapus data pelanggan.

**Modul Staf Apotek**
- Menyimpan data staf (nama, alamat, tanggal lahir, tempat lahir, nomor HP).
- Menampilkan dan menghapus data staf.

**Modul Daftar Obat**
- Menyimpan data obat (kode obat, nama obat, stok, tanggal kadaluarsa).
- Kode obat bersifat unik, sehingga tidak ada kode yang ganda.
- Obat yang sudah melewati tanggal kadaluarsa otomatis ditandai dengan warna merah pada tabel.

**Umum**
- Validasi input pada sisi server, dengan pesan kesalahan yang ditampilkan di web dan dikirim sebagai JSON pada API.
- API lengkap dengan operasi CRUD (Create, Read, Update, Delete) untuk ketiga modul.
- Seeder untuk mengisi data contoh secara otomatis.
- Koleksi Postman siap pakai pada folder `postman`.

## Teknologi yang Digunakan

| Komponen | Teknologi |
|---|---|
| Framework | Laravel 12 |
| Bahasa | PHP (kompatibel 8.2 sampai 8.5) |
| Database | MariaDB / MySQL |
| Antarmuka | Blade Template dan Bootstrap 5 (CDN) |
| Pengujian API | Postman |
| Manajemen versi | Git dan GitHub |
| Manajemen paket | Composer |

Proyek ini sengaja memakai Laravel 12 dan mengunci platform PHP ke versi 8.2 pada `composer.json`. Dengan begitu, aplikasi tetap dapat dijalankan di komputer yang memakai PHP 8.2, 8.3, 8.4, maupun 8.5. Laravel 13 membutuhkan PHP 8.3 ke atas, sehingga tidak dipilih agar kompatibel dengan semua anggota kelompok.

## Struktur Database

Nama database: `db_apotek`

### Tabel `pelanggan`

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint (PK, auto increment) | Id Pelanggan |
| nama | varchar(255) | Nama pelanggan |
| alamat | text | Alamat pelanggan |
| no_hp | varchar(20) | Nomor HP |
| created_at, updated_at | timestamp | Dikelola otomatis oleh Laravel |

### Tabel `staf`

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint (PK, auto increment) | Id Staff |
| nama | varchar(255) | Nama staf |
| alamat | text | Alamat staf |
| tanggal_lahir | date | Tanggal lahir |
| tempat_lahir | varchar(255) | Tempat lahir |
| no_hp | varchar(20) | Nomor HP |
| created_at, updated_at | timestamp | Dikelola otomatis oleh Laravel |

### Tabel `obat`

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint (PK, auto increment) | Id internal |
| kode_obat | varchar(255), unik | Kode obat |
| nama_obat | varchar(255) | Nama obat |
| stok | integer | Jumlah stok |
| tanggal_kadaluarsa | date | Tanggal kadaluarsa |
| created_at, updated_at | timestamp | Dikelola otomatis oleh Laravel |

## Struktur Folder

Bagian yang dikerjakan secara khusus pada proyek ini:

```
apotek-larvel/
├── app/
│   ├── Http/Controllers/
│   │   ├── PelangganController.php   # logika modul pelanggan (web dan API)
│   │   ├── StafController.php        # logika modul staf (web dan API)
│   │   └── ObatController.php        # logika modul obat (web dan API)
│   └── Models/
│       ├── Pelanggan.php
│       ├── Staf.php
│       └── Obat.php
├── database/
│   ├── migrations/                   # definisi struktur tabel
│   └── seeders/                      # data contoh (Pelanggan, Staf, Obat)
├── postman/                          # koleksi dan environment Postman
├── resources/views/
│   ├── layout.blade.php              # kerangka halaman dan navigasi
│   ├── pelanggan/index.blade.php
│   ├── staf/index.blade.php
│   └── obat/index.blade.php
├── routes/
│   ├── web.php                       # route antarmuka web
│   └── api.php                       # route REST API
├── .env.example                      # contoh konfigurasi lingkungan
└── README.md
```

---

## Prasyarat

Pastikan perangkat lunak berikut sudah terpasang sebelum menjalankan aplikasi.

| Perangkat lunak | Versi minimum | Keterangan |
|---|---|---|
| PHP | 8.2 | Ekstensi: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `fileinfo`, `curl` |
| Composer | 2.x | Pengelola paket PHP |
| MariaDB atau MySQL | 10.x atau 8.x | Dapat memakai XAMPP atau Laragon |
| Git | terbaru | Untuk clone repository |
| Postman | terbaru | Untuk menguji API |
| Koneksi internet | - | Tampilan memuat Bootstrap dari CDN |

Cek versi dengan perintah berikut:

```bash
php -v
composer -V
git --version
```

### Menyiapkan lingkungan

**Windows (XAMPP atau Laragon)**

1. Pasang XAMPP atau Laragon, lalu jalankan layanan **Apache** dan **MySQL/MariaDB**.
2. Pasang Composer dari getcomposer.org dan Git dari git-scm.com.
3. Pastikan `php` dapat dipanggil dari terminal. Jika belum, tambahkan folder PHP ke variabel lingkungan PATH.

**Arch Linux**

```bash
sudo pacman -S php composer mariadb git
sudo mariadb-install-db --user=mysql --basedir=/usr --datadir=/var/lib/mysql
sudo systemctl enable --now mariadb
```

Aktifkan ekstensi PHP yang diperlukan pada `/etc/php/php.ini` dengan menghapus tanda `;` di depan baris berikut:

```ini
extension=pdo_mysql
extension=mysqli
extension=curl
extension=fileinfo
```

---

## Instalasi dan Menjalankan Aplikasi

Ikuti langkah berikut secara berurutan. Semua perintah dijalankan di terminal.

### 1. Clone repository

```bash
git clone https://github.com/yaniss-sudo/apotek-larvel.git
cd apotek-larvel
```

### 2. Pasang dependensi

```bash
composer install
```

Perintah ini membaca `composer.lock` dan memasang semua paket yang dibutuhkan ke folder `vendor`.

### 3. Salin file konfigurasi

Linux atau macOS:

```bash
cp .env.example .env
```

Windows (Command Prompt):

```bash
copy .env.example .env
```

### 4. Buat application key

```bash
php artisan key:generate
```

### 5. Buat database

Buat database kosong bernama `db_apotek`.

**Melalui phpMyAdmin (XAMPP/Laragon):** buka `http://localhost/phpmyadmin`, pilih *New*, isi nama `db_apotek`, lalu klik *Create*.

**Melalui terminal:**

```bash
mysql -u root -e "CREATE DATABASE db_apotek;"
```

Pada Arch Linux, jika memakai pengguna khusus:

```sql
CREATE DATABASE db_apotek;
CREATE USER 'apotek'@'localhost' IDENTIFIED BY 'apotek123';
GRANT ALL PRIVILEGES ON db_apotek.* TO 'apotek'@'localhost';
FLUSH PRIVILEGES;
```

### 6. Sesuaikan konfigurasi database

Buka file `.env`, lalu atur bagian database sesuai komputer yang dipakai.

Untuk XAMPP atau Laragon (bawaan):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_apotek
DB_USERNAME=root
DB_PASSWORD=
```

Untuk Arch Linux dengan pengguna khusus:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_apotek
DB_USERNAME=apotek
DB_PASSWORD=apotek123
```

File `.env` bersifat pribadi per komputer dan tidak di-push ke GitHub.

### 7. Jalankan migrasi dan seeder

```bash
php artisan migrate --seed
```

Perintah ini membuat seluruh tabel sekaligus mengisinya dengan data contoh. Untuk membuat tabel saja tanpa data contoh, gunakan `php artisan migrate`.

### 8. Jalankan server

```bash
php artisan serve
```

Buka `http://127.0.0.1:8000` di browser. Biarkan terminal tetap terbuka selama aplikasi dipakai. Tekan `Ctrl + C` untuk menghentikan server.

Jika port 8000 sudah dipakai, gunakan port lain:

```bash
php artisan serve --port=8080
```

### Ringkasan perintah

```bash
git clone https://github.com/yaniss-sudo/apotek-larvel.git
cd apotek-larvel
composer install
cp .env.example .env          # Windows: copy .env.example .env
php artisan key:generate
# buat database db_apotek, lalu sesuaikan .env
php artisan migrate --seed
php artisan serve
```

---

## Penggunaan Aplikasi Web

| Halaman | Alamat | Fungsi |
|---|---|---|
| Pelanggan | `/pelanggan` | Menambah, melihat, dan menghapus data pelanggan |
| Staf Apotek | `/staf` | Menambah, melihat, dan menghapus data staf |
| Daftar Obat | `/obat` | Menambah, melihat, dan menghapus data obat |

**Menambah data:** isi formulir pada bagian atas halaman, lalu klik **Simpan**. Data baru langsung muncul pada tabel di bawah formulir. Jika ada isian yang salah, pesan kesalahan ditampilkan di bagian atas halaman.

**Menghapus data:** klik tombol **Hapus** pada baris yang diinginkan, lalu konfirmasi pada kotak dialog.

**Penanda kadaluarsa:** pada halaman Daftar Obat, baris obat yang tanggal kadaluarsanya sudah terlewat ditampilkan dengan latar merah.

---

## Dokumentasi API dan Pengujian Postman

### Informasi umum

- Base URL: `http://127.0.0.1:8000/api`
- Format data: JSON
- Pastikan server berjalan (`php artisan serve`) sebelum menguji.

### Daftar endpoint

Berlaku untuk tiga sumber daya: `pelanggan`, `staf`, dan `obat`.

| Operasi | Method | Endpoint | Keterangan |
|---|---|---|---|
| Lihat semua data | GET | `/api/{sumber}` | Mengembalikan seluruh data |
| Lihat satu data | GET | `/api/{sumber}/{id}` | Mengembalikan data berdasarkan id |
| Tambah data | POST | `/api/{sumber}` | Mengembalikan data baru, status 201 |
| Ubah data | PUT | `/api/{sumber}/{id}` | Mengembalikan data yang diperbarui |
| Hapus data | DELETE | `/api/{sumber}/{id}` | Mengembalikan pesan konfirmasi |

### Contoh isi Body (raw, JSON)

**POST `/api/pelanggan`**

```json
{
  "nama": "Budi Santoso",
  "alamat": "Jl. Merdeka No. 1, Medan",
  "no_hp": "081234567890"
}
```

**POST `/api/staf`**

```json
{
  "nama": "Dewi Lestari",
  "alamat": "Jl. Pemuda No. 12, Medan",
  "tanggal_lahir": "1999-03-14",
  "tempat_lahir": "Medan",
  "no_hp": "082111222333"
}
```

**POST `/api/obat`**

```json
{
  "kode_obat": "OBT010",
  "nama_obat": "Paracetamol 500 mg",
  "stok": 100,
  "tanggal_kadaluarsa": "2027-12-31"
}
```

### Aturan validasi

| Sumber | Field | Aturan |
|---|---|---|
| pelanggan | nama | wajib, teks, maksimal 255 karakter |
| pelanggan | alamat | wajib, teks |
| pelanggan | no_hp | wajib, teks, maksimal 20 karakter |
| staf | nama, tempat_lahir | wajib, teks, maksimal 255 karakter |
| staf | alamat | wajib, teks |
| staf | tanggal_lahir | wajib, format tanggal (YYYY-MM-DD) |
| staf | no_hp | wajib, teks, maksimal 20 karakter |
| obat | kode_obat | wajib, teks, maksimal 50 karakter, unik |
| obat | nama_obat | wajib, teks, maksimal 255 karakter |
| obat | stok | wajib, bilangan bulat, minimal 0 |
| obat | tanggal_kadaluarsa | wajib, format tanggal (YYYY-MM-DD) |

Jika validasi gagal, API mengembalikan status **422** beserta rincian kesalahan dalam format JSON.

### Menggunakan koleksi Postman

Folder `postman` berisi koleksi dan environment yang siap diimpor.

1. Buka Postman, klik **Import**.
2. Pilih file koleksi (`*.postman_collection.json`) dan file environment (`*.postman_environment.json`) dari folder `postman`.
3. Pada pojok kanan atas Postman, pilih environment **Apotek Local**.
4. Pastikan variabel `base_url` bernilai `http://127.0.0.1:8000/api`. Ubah port jika server dijalankan di port lain.
5. Jalankan `php artisan serve`, lalu kirim request dari koleksi.

Urutan pengujian yang disarankan: POST (tambah) lalu GET (lihat) lalu PUT (ubah) lalu DELETE (hapus), dan bandingkan hasilnya dengan tampilan di halaman web.

### Pengujian cepat melalui terminal

```bash
curl http://127.0.0.1:8000/api/obat
curl -X POST http://127.0.0.1:8000/api/pelanggan \
  -H "Content-Type: application/json" \
  -d '{"nama":"Budi","alamat":"Medan","no_hp":"0812345"}'
```

---

## Seeder (Data Contoh)

Seeder mengisi database dengan data awal agar halaman tidak kosong saat didemonstrasikan.

| Seeder | Isi |
|---|---|
| PelangganSeeder | 3 data pelanggan |
| StafSeeder | 2 data staf |
| ObatSeeder | 4 data obat (satu di antaranya sengaja sudah kadaluarsa untuk memperlihatkan penanda merah) |

Perintah yang berkaitan:

```bash
php artisan db:seed                  # mengisi data contoh (aman dijalankan berulang)
php artisan migrate:fresh --seed     # menghapus semua tabel, membuat ulang, lalu mengisi data
```

Seeder memakai `updateOrCreate`, sehingga menjalankannya berulang kali tidak menghasilkan data ganda.

## Pemecahan Masalah

| Masalah | Penyebab | Solusi |
|---|---|---|
| `composer install` gagal karena versi PHP | PHP di bawah 8.2 | Perbarui PHP ke 8.2 atau lebih baru |
| `could not find driver` | Ekstensi `pdo_mysql` belum aktif | Aktifkan `extension=pdo_mysql` pada `php.ini`, lalu jalankan ulang |
| `Access denied for user` | Username atau password di `.env` salah | Samakan `DB_USERNAME` dan `DB_PASSWORD` dengan pengaturan database di komputer |
| `Unknown database 'db_apotek'` | Database belum dibuat | Buat database `db_apotek` terlebih dahulu |
| `No application encryption key has been specified` | Belum menjalankan `key:generate` | Jalankan `php artisan key:generate` |
| `Table ... doesn't exist` | Migrasi belum dijalankan | Jalankan `php artisan migrate --seed` |
| `Class ... not found` setelah `git pull` | Dependensi berubah | Jalankan `composer install` |
| Port 8000 sudah dipakai | Ada aplikasi lain di port tersebut | Gunakan `php artisan serve --port=8080` |
| Perubahan tampilan tidak muncul | Cache view | Jalankan `php artisan view:clear` |
| Tampilan tanpa gaya (polos) | Tidak ada internet, Bootstrap CDN gagal dimuat | Hubungkan ke internet |
| Postman menampilkan halaman HTML, bukan JSON | Alamat tidak diawali `/api` | Gunakan base URL `http://127.0.0.1:8000/api` |

Untuk mengulang dari awal dengan database bersih:

```bash
php artisan migrate:fresh --seed
php artisan optimize:clear
```

---

## Catatan

- File `.env` dan folder `vendor` tidak disertakan di repository. Keduanya dibuat ulang melalui langkah instalasi di atas.
- Pastikan `composer.json` dan `composer.lock` ikut di-commit, karena keduanya menjaga agar versi paket sama di semua komputer.
