# Aplikasi Daftar Mahasiswa (PHP native + Bootstrap)

Instruksi singkat menjalankan aplikasi di lingkungan development lokal (Linux / macOS / Windows dengan PHP):

1. Pastikan PHP terpasang (PHP 7.2+ direkomendasikan).
2. Buka terminal di folder proyek (direktori tempat `index.php` berada).
3. Jalankan built-in server PHP:

```bash
php -S 127.0.0.1:8000
```

4. Buka browser ke: http://127.0.0.1:8000

Fitur kecil:

-   Menampilkan daftar mahasiswa dari `data/students.php` (array PHP sederhana)
-   Pencarian sederhana (by nama atau NIM) via parameter `q`
-   Pagination sederhana (10 item per halaman)

Anda bisa mengganti atau menghubungkan `data/students.php` ke database jika diperlukan.
