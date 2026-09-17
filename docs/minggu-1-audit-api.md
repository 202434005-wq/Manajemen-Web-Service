\# Tugas 1 — Audit API dan Ide Proyek Semester



\*\*Nama:\*\* Devina  

\*\*Mata Kuliah:\*\* Manajemen Web Service  

\*\*Berkas:\*\* `docs/minggu-1-audit-api.md`  



\---



\## 1. Identitas API

\* \*\*Nama Layanan:\*\* GitHub REST API

\* \*\*Penyedia:\*\* GitHub, Inc.

\* \*\*Tautan Dokumentasi Resmi:\*\* https://docs.github.com/en/rest/users/users#get-a-user

\* \*\*Target Pengguna API:\*\* Pengembang perangkat lunak, platform CI/CD, dan aplikasi pihak ketiga yang memerlukan integrasi data profil serta repositori GitHub.



\---



\## 2. Masalah atau Kebutuhan Pengguna

\* \*\*Kebutuhan:\*\* Aplikasi pihak ketiga membutuhkan cara terstandar untuk mengambil informasi profil publik pengembang tanpa perlu melakukan scraping antarmuka web.

\* \*\*Solusi API:\*\* GitHub menyediakan endpoint publik berbasis RESTful yang mengembalikan data pengguna dalam format JSON yang terstruktur, cepat, dan konsisten.



\---



\## 3. Hasil Pengujian Endpoint



\### Spesifikasi Request

\* \*\*Nama Request:\*\* `GitHub - Get User`

\* \*\*Method:\*\* `GET`

\* \*\*URL:\*\* `https://api.github.com/users/octocat`

\* \*\*Header:\*\*

&#x20; \* `Accept`: `application/vnd.github+json`

&#x20; \* `X-GitHub-Api-Version`: `2022-11-28`



\### Spesifikasi Response

\* \*\*Status Code:\*\* `200 OK`

\* \*\*Content-Type:\*\* `application/json; charset=utf-8`

\* \*\*Bagian Penting Response (Payload Cuplikan):\*\*

```json

{

&#x20; "login": "octocat",

&#x20; "id": 583234,

&#x20; "node\_id": "MDQ6VXNlcjU4MzIzNA==",

&#x20; "avatar\_url": "\[https://avatars.githubusercontent.com/u/583234?v=4](https://avatars.githubusercontent.com/u/583234?v=4)",

&#x20; "name": "The Octocat",

&#x20; "company": "@github",

&#x20; "blog": "\[https://github.blog](https://github.blog)",

&#x20; "location": "San Francisco",

&#x20; "public\_repos": 8,

&#x20; "followers": 20822,

&#x20; "created\_at": "2011-01-25T18:44:36Z"

}



4\. Peta Sistem

flowchart LR

&#x20;   Client\["Client (Postman / Web App)"] -->|"1. HTTP GET /users/{username}"| Gateway\["GitHub API Gateway / REST Layer"]

&#x20;   Gateway -->|"2. Validasi format \& rate limit"| UserService\["User Service (Internal Logic)"]

&#x20;   UserService -->|"3. Kueri data akun"| Database\[("Database GitHub (User Store)")]

&#x20;   Database -->|"4. Record profil"| UserService

&#x20;   UserService -->|"5. Serialize ke JSON"| Gateway

&#x20;   Gateway -->|"6. Response: 200 OK + JSON Body"| Client

* Penjelasan Alur: Client mengirim HTTP request ke API Gateway GitHub. Gateway memvalidasi header dan aturan batas request (rate limit), lalu meneruskan permintaan ke User Service internal. Service mengambil record dari basis data penyimpanan akun, menyusunnya menjadi format JSON, dan mengembalikannya ke client melalui response HTTP.



5\. Kondisi Berhasil dan Gagal

​Kondisi Berhasil (200 OK)

​Pemicu: Client meminta data user yang terdaftar valid di sistem (contoh: /users/octocat).

​HTTP Status Code: 200 OK

​Response Body: Objek JSON berisi atribut profil lengkap (login, id, avatar\_url, public\_repos).

​Kondisi Gagal (404 Not Found)

​Pemicu: Client meminta username yang tidak terdaftar di database (contoh: /users/user-tidak-ada-987654321).

​HTTP Status Code: 404 Not Found

​Response Body yang Seharusnya Diterima Client:

{

&#x20; "message": "Not Found",

&#x20; "documentation\_url": "\[https://docs.github.com/rest/users/users#get-a-user](https://docs.github.com/rest/users/users#get-a-user)",

&#x20; "status": "404"

}

Cara Client Menangani: Client memeriksa status code 404 dan menampilkan pesan informatif bahwa akun tidak ditemukan tanpa merusak antarmuka pengguna.



​6. Ide Proyek Semester (REST API Berbasis Laravel)

​Nama Proyek: Perfume Catalog \& Review Service API (Sistem Katalog dan Ulasan Parfum)

​Latar Belakang \& Masalah: Penggemar wewangian sering kesulitan menemukan rincian aroma (fragrance notes) dan ulasan terstruktur dalam satu layanan terpadu.

​Target Pengguna: Pengguna umum penikmat parfum dan pengembang aplikasi katalog wewangian.

​Resource Utama yang Dikelola (REST Resources):

​/api/v1/perfumes — Mengelola katalog produk (nama merek, top notes, middle notes, base notes).

​/api/v1/brands — Mengelola data produsen atau rumah parfum.

​/api/v1/reviews — Mengelola penilaian skor dan ulasan performa ketahanan wewangian oleh pengguna.

​Batasan Proyek (Scope):

​REST API berformat JSON berbasis Laravel.

​Fitur mencakup operasi CRUD dasar, relasi antar tabel (database MySQL), filter aroma via query parameters, dan autentikasi token (Laravel Sanctum).



Cara Client Menangani: Client memeriksa status code 404 dan menampilkan pesan informatif bahwa akun tidak ditemukan tanpa merusak antarmuka pengguna.

​6. Ide Proyek Semester (REST API Berbasis Laravel)

​Nama Proyek: Perfume Catalog \& Review Service API (Sistem Katalog dan Ulasan Parfum)

​Latar Belakang \& Masalah: Penggemar wewangian sering kesulitan menemukan rincian aroma (fragrance notes) dan ulasan terstruktur dalam satu layanan terpadu.

​Target Pengguna: Pengguna umum penikmat parfum dan pengembang aplikasi katalog wewangian.

​Resource Utama yang Dikelola (REST Resources):

​/api/v1/perfumes — Mengelola katalog produk (nama merek, top notes, middle notes, base notes).

​/api/v1/brands — Mengelola data produsen atau rumah parfum.

​/api/v1/reviews — Mengelola penilaian skor dan ulasan performa ketahanan wewangian oleh pengguna.

​Batasan Proyek (Scope):

​REST API berformat JSON berbasis Laravel.

​Fitur mencakup operasi CRUD dasar, relasi antar tabel (database MySQL), filter aroma via query parameters, dan autentikasi token (Laravel Sanctum).

