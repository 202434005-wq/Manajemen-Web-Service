\# API Contract — Library API



\## User Stories



\- Sebagai pengunjung, saya ingin melihat daftar buku agar dapat mengetahui koleksi dan ketersediaan buku di perpustakaan.

\- Sebagai pustakawan, saya ingin menambahkan data buku baru agar buku terbaru dapat terdata dan dipinjam oleh anggota.



\---



\## Resource Dictionary — Book



| Field | Type | Required saat create | Akses | Aturan | Contoh |

| :--- | :--- | :--- | :--- | :--- | :--- |

| `id` | integer | Tidak | Read-only | Dibuat otomatis oleh server | `15` |

| `title` | string | Ya | Read/write | Minimal 3 karakter, maksimal 200 karakter | `Clean Code` |

| `isbn` | string | Ya | Read/write | Unik, format 10 atau 13 digit angka | `9780132350884` |

| `author\_id` | integer | Ya | Write | ID author yang valid dan sudah terdaftar | `3` |

| `available` | boolean | Tidak | Read-only | Status ketersediaan (ditentukan oleh server) | `true` |

| `created\_at` | string | Tidak | Read-only | Format ISO 8601 UTC timestamp | `2026-09-25T09:30:00Z` |



\---



\## Endpoint Matrix



| Kebutuhan | Method | Endpoint | Success | Error |

| :--- | :--- | :--- | :--- | :--- |

| Daftar resource | GET | `/api/books` | 200 | — |

| Membuat resource | POST | `/api/books` | 201 | 422 |

| Detail resource | GET | `/api/books/{book}` | 200 | 404 |

| Mengubah resource | PATCH | `/api/books/{book}` | 200 | 404, 422 |

| Menghapus resource | DELETE | `/api/books/{book}` | 204 | 404 |



\---



\## Request dan Response Contract



\### Create Request

POST /api/books

Content-Type: application/json

Accept: application/json



```json

{

&#x20; "title": "Clean Code",

&#x20; "isbn": "9780132350884",

&#x20; "author\_id": 3

}



201Created

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



200OK

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



404 NotFound

{

&#x20; "message": "Book not found",

&#x20; "errors": null

}



422Unprocessable Content

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





