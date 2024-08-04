# E-Commerce Checkout System

## Deskripsi

E-Commerce Checkout System adalah aplikasi berbasis web yang memungkinkan pengguna untuk membeli produk secara online dengan proses checkout yang terintegrasi dengan Midtrans untuk pembayaran. Aplikasi ini mendukung fitur keranjang belanja, pemesanan produk, dan pembayaran menggunakan Virtual Account (VA) yang dihasilkan oleh Midtrans. Sistem ini juga mengelola peran pengguna sebagai pelanggan dan admin dengan akses kontrol yang sesuai.

## Cara Menjalankan Project

### Prerequisites

1. **PHP**: Versi 8.0 atau lebih baru
2. **Composer**: Manajer paket PHP
3. **Laravel**: Versi yang sesuai dengan `composer.json`
4. **MySQL/MariaDB**: Database server
5. **Node.js** dan **NPM**: Untuk manajemen paket frontend

### Langkah-langkah

1.  **Clone Repository**

    ```bash
    git clone https://github.com/username/project-repo.git
    cd project-repo
    ```

2.  **Instalasi Dependensi**

    Install dependensi PHP menggunakan Composer:

    ```bash
    composer install
    ```

    Install dependensi frontend menggunakan NPM:

    ```bash
    npm install
    ```

3.  **Konfigurasi .env**

    Salin file `.env.example` ke `.env` dan sesuaikan konfigurasi sesuai dengan lingkungan pengembangan Anda:

    ```bash
    cp .env.example .env
    ```

    Edit file `.env` untuk mengatur konfigurasi database, email, dan Midtrans:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database
    DB_USERNAME=username
    DB_PASSWORD=password

    MIDTRANS_MERCHANT_ID=your_merchant_id
    MIDTRANS_SERVER_KEY=your_server_key
    MIDTRANS_CLIENT_KEY=your_client_key
    ```

4.  **Generate Kunci Aplikasi**

    ```bash
    php artisan key:generate
    ```

5.  **Migrasi Database**

    Jalankan migrasi untuk membuat tabel yang diperlukan di database:

    ```bash
    php artisan migrate
    ```

6.  **Jalankan Seeder (Opsional)**

    Jika Anda ingin mengisi database dengan data contoh:

    ```bash
    php artisan db:seed
    ```

7.  **Jalankan Server**

    Jalankan server pengembangan Laravel:

    ```bash
    php artisan serve
    ```

    Buka browser dan akses aplikasi di `http://localhost:8000`.

## Penggunaan

1. **Registrasi dan Login**

    - Registrasi sebagai pengguna baru atau login dengan akun yang sudah ada.

2. **Menambahkan Produk ke Keranjang**

    - Telusuri produk, tambahkan produk ke keranjang belanja.

3. **Checkout**

    - Akses keranjang belanja, klik tombol checkout untuk memproses pesanan.
    - Di halaman checkout, Anda akan melihat ringkasan pesanan dan total harga.
    - Klik tombol "Bayar Sekarang" untuk melanjutkan ke halaman pembayaran Midtrans.

4. **Admin**

    - Admin dapat mengakses fitur tambahan seperti menambah atau memperbarui produk melalui dropdown yang tersedia setelah login.

## Teknologi yang Digunakan

-   **Laravel**: Framework PHP untuk pengembangan aplikasi web.
-   **PHP**: Bahasa pemrograman server-side.
-   **MySQL**: Sistem manajemen database relasional.
-   **Midtrans**: Layanan pembayaran untuk pemrosesan transaksi.
-   **Bootstrap**: Framework CSS untuk desain responsif.
-   **Node.js** dan **NPM**: Untuk manajemen dependensi frontend.

## Lisensi

Proyek ini dibuat oleh Asep Saepudin, S.Kom.
