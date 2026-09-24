\# Dokumentasi Tugas Minggu 2 — Eksplorasi HTTP



\## 1. Tujuan

\- Memahami implementasi protokol HTTP, arsitektur REST, dan format serialisasi data JSON pada Web Service.

\- Mengeksplorasi penggunaan query parameter dan custom request header menggunakan Postman.

\- Menguji serta memvalidasi HTTP status code standar (200, 400, 404, 429) menggunakan automated test scripts.

\- Mendokumentasikan dan menyinkronkan artefak Postman Collection ke dalam version control Git dan GitHub.



\---



\## 2. Perubahan

\- Menambahkan Postman Collection `Minggu 2-Eksplorasi HTTP` dengan dua folder: `01 Request Anatomy` dan `02 Status Codes`.

\- Mengonfigurasi collection variables `echo\_base\_url` (`https://postman-echo.com`) dan `status\_base\_url` (`https://httpbin.org`).

\- Mengimplementasikan skrip pengujian otomatis (`pm.test`) pada setiap request untuk validasi status code, format JSON, dan kelengkapan header.

\- Mengekspor file Postman Collection JSON ke dalam direktori repositori `postman/`.



\---



\## 3. Endpoint atau Contract



\### Variabel Lingkungan:

\- `echo\_base\_url`: `https://postman-echo.com`

\- `status\_base\_url`: `https://httpbin.org`



\### Daftar Endpoint:



| Folder | Nama Request | Method | URL / Path | Parameter \& Header |

| :--- | :--- | :--- | :--- | :--- |

| `01 Request Anatomy` | `GET Echo Query Parameters` | GET | `{{echo\_base\_url}}/get` | Query: `search=laravel api`, `page=2` |

| `01 Request Anatomy` | `GET Echo Custom Header` | GET | `{{echo\_base\_url}}/get` | Header: `Accept: application/json`, `X-Student-Client: postman-week-2` |

| `02 Status Codes` | `Success` | GET | `{{status\_base\_url}}/status/200` | Pengujian respon sukses (200 OK) |

| `02 Status Codes` | `Bad Request` | GET | `{{status\_base\_url}}/status/400` | Pengujian client error (400 Bad Request) |

| `02 Status Codes` | `Not Found` | GET | `{{status\_base\_url}}/status/404` | Pengujian resource tidak ditemukan (404 Not Found) |

| `02 Status Codes` | `Too Many Request` | GET | `{{status\_base\_url}}/status/429` | Pengujian rate limiting (429 Too Many Requests) |



\---



\## 4. Bukti Pengujian



\### A. Pengujian Custom Header \& JSON Response

\- \*\*Request:\*\* `GET Echo Custom Header`

\- \*\*Hasil Test Results:\*\*

&#x20; - `Status code is 200` -> \*\*PASSED\*\*

&#x20; - `Response is JSON` -> \*\*PASSED\*\*

&#x20; - `Custom header was received` -> \*\*PASSED\*\*

\- \*\*Response Headers Objek:\*\*

```json

{

&#x20; "args": {},

&#x20; "headers": {

&#x20;   "host": "postman-echo.com",

&#x20;   "x-student-client": "postman-week-2",

&#x20;   "accept": "application/json"

&#x20; },

&#x20; "url": "\[https://postman-echo.com/get](https://postman-echo.com/get)"

}

