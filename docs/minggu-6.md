\# Tugas Minggu 6 — Endpoint Collection yang Dapat Dicari



\## 1. Tujuan

Menerapkan endpoint collection yang terstandarisasi pada resource utama `Book` dengan kemampuan pagination, pencarian fleksibel pada minimal dua field (`title` dan `isbn`), pengurutan aman menggunakan allowlist, validasi query parameter sebelum eksekusi ke database, serta penyajian respons berstruktur `data`, `links`, dan `meta`.



\## 2. Endpoint dan Query Contract

Endpoint collection diakses melalui metode HTTP `GET /api/books` dengan header `Accept: application/json`.



| Query Parameter | Tipe Data | Deskripsi | Aturan Validasi | Default |

| :--- | :--- | :--- | :--- | :--- |

| `search` | String | Kata kunci pencarian | Nullable, string, max: 100 | `null` (tanpa filter) |

| `sort` | String | Kolom pengurutan | In: `id`, `title`, `isbn`, `created\_at` | `id` |

| `direction` | String | Arah pengurutan | In: `asc`, `desc` | `asc` |

| `page` | Integer | Halaman data | Integer, min: 1 | `1` |

| `per\_page` | Integer | Jumlah data per halaman | Integer, min: 1, max: 50 | `5` |



\## 3. Daftar Field Search dan Sort Allowlist

\- \*\*Field Search (2 Field)\*\*:

&#x20; - `title`: Pencarian substring judul buku menggunakan wildcard SQL (`%search%`).

&#x20; - `isbn`: Pencarian substring nomor ISBN menggunakan wildcard SQL (`%search%`).

\- \*\*Sort Allowlist\*\*:

&#x20; - Kolom yang diizinkan: `id`, `title`, `isbn`, dan `created\_at`.

&#x20; - Mencegah pengurutan berdasarkan kolom yang tidak semestinya diakses atau dieksploitasi client.



\## 4. Validation Rules

Validasi query parameter diatur sebelum query builder dieksekusi pada `BookController::index()`:

```php

$validated =$request->validate(\[

&#x20;   'search' => \['sometimes', 'nullable', 'string', 'max:100'],

&#x20;   'sort' => \['sometimes', Rule::in(\['id', 'title', 'isbn', 'created\_at'])],

&#x20;   'direction' => \['sometimes', Rule::in(\['asc', 'desc'])],

&#x20;   'page' => \['sometimes', 'integer', 'min:1'],

&#x20;   'per\_page' => \['sometimes', 'integer', 'min:1', 'max:50'],

]);

