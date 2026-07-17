# 🍣 SushiGo — Aplikasi Pemesanan Sushi Berbasis Web

> Aplikasi web pemesanan sushi modern yang dibangun menggunakan Laravel 12, dengan sistem manajemen menu, keranjang belanja, dan tracking status pesanan secara real-time.

---

## Deskripsi Project

**SushiGo** adalah project UAS mata kuliah **Pemrograman Web 2** yang mengimplementasikan sistem pemesanan restoran sushi secara online. Aplikasi ini memiliki dua peran pengguna — **User (Pelanggan)** dan **Admin (Pengelola)** — dengan fitur lengkap mulai dari melihat menu hingga memproses pesanan.

---

## Fitur Utama

### Fitur User (Pelanggan)
- ✅ Register & Login
- ✅ Melihat menu sushi dengan foto
- ✅ Pencarian menu berdasarkan nama
- ✅ Filter menu berdasarkan kategori
- ✅ Melihat detail produk
- ✅ Keranjang belanja (tambah, update, hapus item)
- ✅ Checkout & konfirmasi pesanan
- ✅ Riwayat pesanan
- ✅ Tracking status pesanan dengan progress bar
- ✅ Batalkan pesanan (status pending)
- ✅ Edit profil (nama, email, telepon, alamat, password)

### Fitur Admin
- ✅ Dashboard statistik (menu, kategori, pesanan, user)
- ✅ CRUD Kategori menu
- ✅ CRUD Menu sushi + upload foto
- ✅ Kelola semua pesanan
- ✅ Update status pesanan (Pending → Diproses → Selesai)
- ✅ Kelola data pengguna

---

## Teknologi yang Digunakan

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **Laravel** | 12.x | Backend Framework |
| **PHP** | 8.2+ | Bahasa Pemrograman |
| **Blade** | — | Template Engine |
| **Tailwind CSS** | 3.x | CSS Framework |
| **Alpine.js** | 3.x | JavaScript Interaktif |
| **MySQL** | 8.x | Database |
| **Laravel Breeze** | — | Autentikasi |
| **Vite** | — | Asset Bundler |
| **XAMPP** | — | Local Server |

---

## Cara Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL (XAMPP)
- Git

### Langkah Instalasi

**1. Clone repository**
```bash
git clone https://github.com/cndy56/sushigo.git
cd sushigo
```

**2. Install dependensi PHP**
```bash
composer install
```

**3. Install dependensi Node.js**
```bash
npm install
```

**4. Salin file environment**
```bash
cp .env.example .env
```

**5. Generate application key**
```bash
php artisan key:generate
```

**6. Konfigurasi database**

Buka file `.env` dan sesuaikan:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sushigo_db
DB_USERNAME=root
DB_PASSWORD=
```

**7. Buat database**

Buka **phpMyAdmin** → buat database baru bernama `sushigo_db`

**8. Jalankan migration & seeder**
```bash
php artisan migrate --seed
```

**9. Buat symlink storage**
```bash
php artisan storage:link
```

**10. Build aset Tailwind CSS**
```bash
npm run build
```

**11. Jalankan aplikasi**
```bash
php artisan serve
```

Buka browser → `http://127.0.0.1:8000`

---

## 👥 Akun Demo

| Role | Email | Password |
|------|-------|----------|
| 👑 **Admin** | admin@sushigo.com | password |
| 👤 **User** | user@sushigo.com | password |

---

## 📁 Struktur Folder

```
sushigo/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Controller admin
│   │   │   ├── HomeController.php
│   │   │   ├── MenuController.php
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   └── OrderController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/                 # User, Product, Cart, Order, dll
├── database/
│   ├── migrations/             # Schema tabel database
│   └── seeders/                # Data awal (admin, kategori, produk)
├── resources/
│   └── views/
│       ├── layouts/            # Layout admin & user
│       ├── admin/              # Halaman admin
│       ├── menu/               # Halaman menu
│       ├── cart/               # Halaman keranjang
│       ├── checkout/           # Halaman checkout
│       ├── orders/             # Halaman pesanan
│       └── home.blade.php      # Halaman utama
└── routes/
    └── web.php                 # Definisi route aplikasi
```

---

## Database

Aplikasi menggunakan **7 tabel utama**:

| Tabel | Fungsi |
|-------|--------|
| `users` | Data pengguna & role |
| `categories` | Kategori menu sushi |
| `products` | Data menu sushi |
| `carts` | Keranjang belanja user |
| `cart_items` | Item dalam keranjang |
| `orders` | Data pesanan |
| `order_details` | Detail item per pesanan |

---

## 👨‍💻 Developer

| | |
|---|---|
| **Nama** | [Cindy Aulia Rakhma] |
| **NIM** | [2410010108] |
| **Kelas** | [4A Teknik Informatika] |
| **Mata Kuliah** | Pemrograman Web 2 |
| **Institusi** | [UNISKA] |

---

## 📄 Lisensi

Project ini dibuat untuk keperluan akademik (UAS Pemrograman Web 2).

---

<p align="center">🍣 Dibuat dengan ❤️ menggunakan Laravel 12</p>
