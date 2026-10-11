\# Praktikum Minggu 5 — CRUD Laravel API



\## Endpoint

\- GET /api/books (Index - Menampilkan daftar buku)

\- POST /api/books (Store - Membuat buku baru)

\- GET /api/books/{book} (Show - Menampilkan detail buku)

\- PATCH /api/books/{book} (Update - Memperbarui data buku)

\- DELETE /api/books/{book} (Destroy - Menghapus buku)



\## Validation

\- \*\*StoreBookRequest\*\*:

&#x20; - `title`: required, string, min: 3, max: 200

&#x20; - `isbn`: required, string, size: 13, unique:books,isbn

&#x20; - `available`: sometimes, boolean

\- \*\*UpdateBookRequest\*\*:

&#x20; - `title`: sometimes, required, string, min: 3, max: 200

&#x20; - `isbn`: sometimes, required, string, size: 13, Rule::unique('books', 'isbn')->ignore(book\_id)

&#x20; - `available`: sometimes, required, boolean



\## Verification

\- 201 create: berhasil (data baru tersimpan dengan ID baru terbungkus wrapper `data`).

\- 422 validation: berhasil (validasi gagal menampilkan array errors per field).

\- 200 update: berhasil (field yang diperbarui terupdate dengan benar).

\- 404 not found: berhasil (mengembalikan status 404 dengan pesan "Book not found" dan errors null).

\- 204 delete: berhasil (data terhapus dengan status 204 No Content tanpa payload body).



\## Contract Comparison

Semua respon aktual telah cocok dengan spesifikasi API contract:

1\. Respon success dibungkus rapi dalam properti `data` melalui `BookResource`.

2\. Validasi otomatis mengembalikan status `422 Unprocessable Content` dengan struktur JSON error bawaan Laravel.

3\. Respon DELETE menghasilkan status `204` tanpa body.

4\. Respon error untuk resource yang tidak ditemukan seragam mengembalikan struktur objek error `404 Not Found`.



\## AI Usage

\- \*\*Tools\*\*: Gemini.

\- \*\*Tujuan\*\*: Membantu penyusunan Form Request, pembuatan BookResource, penyesuaian BookController, dan format dokumentasi praktikum.

\- \*\*Verifikasi\*\*: Semua kode diperiksa struktur dan keamanannya secara mandiri, rute diverifikasi via CLI (`php artisan route:list`), serta diuji langsung responsenya via Postman.

