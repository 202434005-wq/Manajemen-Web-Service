\# Dokumentasi Tugas Minggu 3 — Draft API Contract



\## 1. Tujuan

\- Menerapkan prinsip API contract dan resource modelling pada entitas utama sistem Web Service sebelum tahap penulisan kode di Laravel.

\- Merancang Resource Dictionary, Endpoint Matrix, skema request, dan skema response yang konsisten.

\- Menyimulasikan contoh respons sukses (200, 201) dan skenario penanganan error (404, 422) menggunakan Postman Response Examples.

\- Menyiapkan kontrak API yang terstruktur dan siap diimplementasikan ke dalam komponen Laravel (Route, Controller, Migration, Form Request, API Resource) pada Minggu 4.



\---



\## 2. Perubahan

\- Menentukan resource domain utama sistem: `books`.

\- Menyusun dokumen `docs/api-contract.md` yang memuat User Stories, Resource Dictionary (6 atribut), Endpoint Matrix (5 rute RESTful), skema request/response, dan catatan keputusan desain.

\- Membangun Postman Collection `Minggu3-API Contract` dengan variabel lingkungan `base\_url = http://127.0.0.1:8000/api`.

\- Mengonfigurasi request `GET /api/books` dengan Response Example `200 OK`.

\- Mengonfigurasi request `POST /api/books` dengan Response Example `201 Created`, `404 Not Found`, dan `422 Validation Error`.

\- Mengekspor artefak Postman Collection v2.1 ke dalam repositori pada file `postman/week-03-api-contract.postman\_collection.json`.



\---



\## 3. Endpoint atau Contract



\### Variabel Base URL

`base\_url`: `http://127.0.0.1:8000/api`



\### Endpoint Matrix



| Kebutuhan | Method | Endpoint | Success Code | Error Code |

| :--- | :--- | :--- | :--- | :--- |

| Daftar seluruh buku | GET | `/api/books` | 200 OK | — |

| Menambahkan buku baru | POST | `/api/books` | 201 Created | 422 Unprocessable Content |

| Detail data satu buku | GET | `/api/books/{book}` | 200 OK | 404 Not Found |

| Mengubah data buku | PATCH | `/api/books/{book}` | 200 OK | 404 Not Found, 422 Unprocessable Content |

| Menghapus buku | DELETE | `/api/books/{book}` | 204 No Content | 404 Not Found |



\### Skema Request Create (`POST /api/books`)

\- \*\*Headers:\*\*

&#x20; - `Accept: application/json`

&#x20; - `Content-Type: application/json`

\- \*\*Request Body (JSON):\*\*

```json

{

&#x20; "title": "Clean Code",

&#x20; "isbn": "9780132350884",

&#x20; "author\_id": 3

}



{

&#x20; "data": {

&#x20;   "id": 15,

&#x20;   "title": "Clean Code",

&#x20;   "isbn": "9780132350884",

&#x20;   "author\_id": 3,

&#x20;   "available": true,

&#x20;   "created\_at": "2026-09-25T09:30:00Z"

&#x20; }

}



{

&#x20; "data": \[

&#x20;   {

&#x20;     "id": 15,

&#x20;     "title": "Clean Code",

&#x20;     "isbn": "9780132350884",

&#x20;     "available": true

&#x20;   }

&#x20; ]

}



{

&#x20; "message": "Book not found",

&#x20; "errors": null

}



{

&#x20; "message": "The given data was invalid.",

&#x20; "errors": {

&#x20;   "title": \[

&#x20;     "The title field is required."

&#x20;   ],

&#x20;   "isbn": \[

&#x20;     "The isbn has already been taken."

&#x20;   ]

&#x20; }

}





