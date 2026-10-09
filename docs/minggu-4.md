\# Tugas Minggu 4 — Endpoint Read-only Laravel



\## 1. Tujuan

Menerapkan fondasi API Laravel pada resource `Book` untuk menyediakan endpoint read-only yang konsisten dengan API contract Minggu 3, mencakup handling respon sukses (`200 OK`) dan error (`404 Not Found`).



\## 2. Perubahan

\- Mengaktifkan perutean API Laravel melalui perintah `php artisan install:api`.

\- Membuat skema tabel `books` via Migration dengan kolom: `id`, `title` (string 200), `isbn` (string 13 unique), `available` (boolean default true), dan timestamps.

\- Menyiapkan data awal development menggunakan `BookSeeder` untuk dua record buku dummy.

\- Membentuk `BookController` dengan method `index()` dan `show()` yang mereturn JSON berstruktur wrapper `data`.

\- Mendaftarkan endpoint pada `routes/api.php`.



\## 3. Endpoint dan Contract

Mengimplementasikan dua rute read-only:

\- `GET /api/books`: Mengambil daftar seluruh koleksi buku.

\- `GET /api/books/{book}`: Mengambil detail satu data buku berdasarkan parameter ID.



Bentuk response konsisten menggunakan wrapper `data`, penamaan field huruf kecil (`id`, `title`, `isbn`, `available`, `created\_at`), serta type data yang valid (`id` integer, `available` boolean).



\## 4. Bukti Pengujian

Pengujian dilakukan menggunakan Postman terhadap server lokal Laravel (`http://127.0.0.1:8000`):



1\. \*\*GET /api/books\*\*

&#x20;  - Header: `Accept: application/json`

&#x20;  - Status: `200 OK`

&#x20;  - Response:

&#x20;    ```json

&#x20;    {

&#x20;      "data": \[

&#x20;        {

&#x20;          "id": 1,

&#x20;          "title": "Clean Code",

&#x20;          "isbn": "9780132350884",

&#x20;          "available": true,

&#x20;          "created\_at": "2026-10-09T03:45:00.000000Z"

&#x20;        },

&#x20;        {

&#x20;          "id": 2,

&#x20;          "title": "The Pragmatic Programmer",

&#x20;          "isbn": "9780135957059",

&#x20;          "available": false,

&#x20;          "created\_at": "2026-10-09T03:45:00.000000Z"

&#x20;        }

&#x20;      ]

&#x20;    }

&#x20;    ```



2\. \*\*GET /api/books/1\*\*

&#x20;  - Header: `Accept: application/json`

&#x20;  - Status: `200 OK`

&#x20;  - Response:

&#x20;    ```json

&#x20;    {

&#x20;      "data": {

&#x20;        "id": 1,

&#x20;        "title": "Clean Code",

&#x20;        "isbn": "9780132350884",

&#x20;        "available": true,

&#x20;        "created\_at": "2026-10-09T03:45:00.000000Z"

&#x20;      }

&#x20;    }

&#x20;    ```



\## 5. Error Case

Pengujian kondisi ketika resource tidak ditemukan:



\- \*\*GET /api/books/999999\*\*

&#x20; - Header: `Accept: application/json`

&#x20; - Status: `404 Not Found`

&#x20; - Response:

&#x20;   ```json

&#x20;   {

&#x20;     "message": "Book not found",

&#x20;     "errors": null

&#x20;   }

&#x20;   ```



\## 6. Kesimpulan

Implementasi backend Laravel pada Minggu 4 telah berhasil memetakan API contract secara utuh. Pemformatan manual pada Controller memastikan format JSON, status code, dan penanganan kasus 404 identik dengan rancangan kontrak Minggu 3.



\## 7. Referensi

\- Dokumentasi Resmi Laravel 11/12/13 — Routing \& Controllers

\- Dokumentasi Resmi Laravel — Eloquent ORM \& Migrations

\- API Contract Project Minggu 3 (`docs/minggu-3.md`)



\## 8. Deklarasi Penggunaan AI

Pengerjaan tugas ini dibantu oleh Gemini untuk debugging terminal, pembuatan boilerplate seeder, serta asistensi penyusunan format dokumentasi. Seluruh kode, migrasi, dan pengujian API diverifikasi dan dijalankan langsung pada environment lokal.

