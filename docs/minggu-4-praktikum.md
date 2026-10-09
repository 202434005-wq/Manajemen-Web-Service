\# Praktikum Minggu 4 — Read-only Laravel API



\## Resource

Book



\## Endpoint

\- GET /api/books

\- GET /api/books/{book}



\## Verification

\- 200 list: berhasil

\- 200 detail: berhasil

\- 404 not found: berhasil



\## Contract Comparison

Actual response yang dihasilkan oleh server Laravel sudah sesuai dengan API contract Minggu 3:

1\. Root response dibungkus dalam properti `data`.

2\. Struktur data buku konsisten memuat atribut `id`, `title`, `isbn`, `available`, dan `created\_at`.

3\. Tipe data sesuai: `id` bertipe integer dan `available` bertipe boolean.

4\. Resource yang tidak ditemukan mengembalikan status `404 Not Found` dengan body `{"message": "Book not found", "errors": null}`.



\## Evidence

\- GET /api/books -> Status 200 OK (menampilkan list data buku).

\- GET /api/books/1 -> Status 200 OK (menampilkan detail buku ID 1).

\- GET /api/books/999999 -> Status 404 Not Found (menampilkan pesan error sesuai kontrak).

\-

