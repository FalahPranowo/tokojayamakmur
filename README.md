# Sistem Manajemen Produk - Toko Jaya Makmur

Aplikasi berbasis web sederhana yang dirancang untuk mengelola data stok barang pada **Toko Jaya Makmur**. Proyek ini merupakan implementasi dari mata kuliah Informatika yang memfokuskan pada operasi CRUD (Create, Read, Update, Delete) dengan struktur kode yang terorganisir.

## 📂 Struktur Folder

Proyek ini menggunakan pemisahan antara logika bisnis dan tampilan antarmuka:

*   **`config/`**: Berisi konfigurasi utama koneksi ke database `tokojayamakmur`.
*   **`public/`**: Folder antarmuka pengguna (Frontend). Berisi halaman utama, formulir tambah, formulir edit, dan laman konfirmasi hapus.
*   **`process/`**: Folder logika sistem (Backend). Berisi file eksekusi query SQL untuk Insert, Update, dan Delete data.

## 🛠️ Teknologi yang Digunakan

*   **PHP 8.x**: Bahasa pemrograman utama untuk logika server.
*   **MySQL/MariaDB**: Sistem manajemen database (RDBMS) menggunakan Port **3307**.
*   **PDO (PHP Data Objects)**: Digunakan untuk koneksi database yang lebih aman guna mencegah serangan SQL Injection.
*   **HTML5 & CSS3**: Digunakan untuk membangun antarmuka yang responsif dan interaktif dengan desain kartu (card-based).

## 🚀 Fitur Utama

1.  **Dashboard Produk**: Menampilkan daftar barang secara real-time dari database.
2.  **Input Barang Baru**: Antarmuka bersih untuk menambahkan produk ke stok toko.
3.  **Pembaruan Data**: Fitur pengeditan data dengan validasi ID otomatis agar tidak terjadi kesalahan akses.
4.  **Penghapusan Aman**: Sistem konfirmasi hapus interaktif untuk memastikan data tidak terhapus secara tidak sengaja.

## 📝 Panduan Instalasi

1.  Clone atau pindahkan folder `project_php` ke dalam direktori `htdocs` pada XAMPP.
2.  Pastikan nama database di MySQL adalah `tokojayamakmur` (sesuaikan pada `config/database.php`).
3.  Jalankan server Apache dan MySQL melalui panel kontrol XAMPP.
4.  Buka browser dan akses melalui: `http://localhost/project_php/public/index.php`.

##  Tim Pengembang

1. **Marthin Alexander Hutajulu** [D1041241068]
2. **Falah Pranowo** [D1041241080]
