\# Tugas Minggu 5 — CRUD Resource Utama



\## 1. Tujuan

Menerapkan operasi CRUD penuh pada resource utama `Book` dalam proyek semester dengan validasi ketat via Form Request, standarisasi serialisasi respons menggunakan API Resource, serta penanganan respon sukses (`201`, `200`, `204`) dan respon error (`404`, `422`) yang konsisten dengan API contract.



\## 2. Perubahan

\- \*\*Model (`app/Models/Book.php`)\*\*: Menambahkan properti `$fillable` (`title`, `isbn`, `available`) untuk proteksi \*mass assignment\* dan menambahkan casting boolean pada kolom `available`.

\- \*\*Form Requests\*\*:

&#x20; - `StoreBookRequest`: Memvalidasi pembuatan buku baru (`title` required min 3 max 200, `isbn` required size 13 unique, `available` sometimes boolean).

&#x20; - `UpdateBookRequest`: Memvalidasi pembaruan parsial (PATCH) menggunakan rule `sometimes` dan pengecualian unique ISBN untuk record yang sedang diedit via `Rule::unique()->ignore()`.

\- \*\*API Resource (`app/Http/Resources/BookResource.php`)\*\*: Memastikan seluruh data yang dikembalikan terbungkus rapi dalam properti `data` dengan representasi ISO 8601 pada timestamp.

\- \*\*Controller (`app/Http/Controllers/BookController.php`)\*\*: Mengimplementasikan 5 method CRUD (`index`, `store`, `show`, `update`, `destroy`) dengan format error `404` terstandarisasi.

\- \*\*Routing (`routes/api.php`)\*\*: Menggantikan route manual GET dengan `Route::apiResource('books', BookController::class)`.



\## 3. Endpoint atau Contract

Sesuai rancangan API contract, endpoint yang disediakan adalah:



| Operasi | Method | URI | Success Status | Error Status |

| :--- | :--- | :--- | :--- | :--- |

| Create | POST | `/api/books` | `201 Created` | `422 Unprocessable Content` |

| Read All | GET | `/api/books` | `200 OK` | — |

| Read Detail | GET | `/api/books/{book}` | `200 OK` | `404 Not Found` |

| Update (Partial) | PATCH | `/api/books/{book}` | `200 OK` | `404 Not Found`, `422 Unprocessable Content` |

| Delete | DELETE | `/api/books/{book}` | `204 No Content` | `404 Not Found` |



\### Keputusan Utama Terkait API Contract:

1\. \*\*Pemisahan Validation\*\*: Menggunakan Form Request terpisah agar Controller tetap bersih (\*lean\*) dan memastikan payload yang tidak valid ditolak sebelum mencapai logika database.

2\. \*\*Penggunaan API Resource\*\*: Mengisolasi struktur internal database dari output JSON sehingga contract tetap stabil meski ada perubahan skema database internal.

3\. \*\*Status Code HTTP yang Presisi\*\*:

&#x20;  - `201` untuk resource baru yang berhasil dibuat.

&#x20;  - `204 No Content` tanpa body payload untuk penghapusan resource.

&#x20;  - `422` terstruktur untuk kesalahan input validasi.

&#x20;  - `404` dengan wrapper seragam `{"message": "Book not found", "errors": null}`.



\## 4. Bukti Pengujian (Success Response)



Pengujian dilakukan menggunakan Postman dengan headers:

\- `Accept: application/json`

\- `Content-Type: application/json`



\### A. POST /api/books (Create Success — 201 Created)

\*\*Request Body:\*\*

```json

{

&#x20; "title": "Refactoring",

&#x20; "isbn": "9780134757599",

&#x20; "available": true

}



Response Status: 201 Created



Response Body:



JSON

{

&#x20; "data": {

&#x20;   "id": 3,

&#x20;   "title": "Refactoring",

&#x20;   "isbn": "9780134757599",

&#x20;   "available": true,

&#x20;   "created\_at": "2026-10-11T04:30:00.000000Z"

&#x20; }

}

B. PATCH /api/books/3 (Update Success — 200 OK)

Request Body:



JSON

{

&#x20; "available": false

}

Response Status: 200 OK



Response Body:



JSON

{

&#x20; "data": {

&#x20;   "id": 3,

&#x20;   "title": "Refactoring",

&#x20;   "isbn": "9780134757599",

&#x20;   "available": false,

&#x20;   "created\_at": "2026-10-11T04:30:00.000000Z"

&#x20; }

}

C. DELETE /api/books/3 (Delete Success — 204 No Content)

Response Status: 204 No Content



Response Body: (Empty / No content)



5\. Error Case

A. POST /api/books (Validation Error — 422 Unprocessable Content)

Request Body:



JSON

{

&#x20; "title": "",

&#x20; "isbn": "123"

}

Response Status: 422 Unprocessable Content



Response Body:



JSON

{

&#x20; "message": "The title field is required. (and 1 more error)",

&#x20; "errors": {

&#x20;   "title": \[

&#x20;     "The title field is required."

&#x20;   ],

&#x20;   "isbn": \[

&#x20;     "The isbn must be 13 characters."

&#x20;   ]

&#x20; }

}

B. GET /api/books/999999 (Not Found — 404 Not Found)

Response Status: 404 Not Found



Response Body:



JSON

{

&#x20; "message": "Book not found",

&#x20; "errors": null

}

6\. Kesimpulan

Implementasi CRUD resource utama sudah berhasil diterapkan secara keseluruhan dan konsisten dengan API contract. Validasi Form Request bisa menangani proteksi input berbahaya, BookResource menjaga format serialisasi keluaran, dan juga kode respon HTTP yang dihasilkan sepenuhnya mematuhi standar REST API.



7\. Referensi

Dokumentasi Resmi Laravel — Validation \& Form Requests



Dokumentasi Resmi Laravel — Eloquent API Resources



Dokumentasi Resmi Laravel — Controllers \& Routing



API Contract Proyek Semester (docs/minggu-3.md)



8\. Deklarasi Penggunaan AI

Pengerjaan dibantu Gemini 

