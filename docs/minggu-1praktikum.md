# Praktikum 1 — Audit API dengan Postman

**Nama:** Devina  
**Mata Kuliah:** Manajemen Web Service

---

## 1. Bukti Request dan Response

### A. Checkpoint 1 — Request Berhasil (200 OK)

- **Request Name:** `GitHub - Get User`
- **Method:** `GET`
- **URL:** `https://api.github.com/users/octocat`
- **Status Code:** `200 OK`

#### Tabel Elemen Request & Response (Bagian 2)

| Elemen           | Nilai yang Diamati                                            | Fungsi                                                              |
| :--------------- | :------------------------------------------------------------ | :------------------------------------------------------------------ |
| **Method**       | `GET`                                                         | Meminta representasi resource dari server.                          |
| **Endpoint**     | `/users/octocat`                                              | Menentukan resource spesifik yang diminta.                          |
| **Status code**  | `200 OK`                                                      | Menjelaskan bahwa request berhasil diproses dan resource ditemukan. |
| **Content-Type** | `application/json; charset=utf-8`                             | Menjelaskan format body response adalah JSON.                       |
| **Body**         | - `login`: "octocat"<br>- `id`: 583234<br>- `public_repos`: 8 | Membawa representasi data user yang diminta.                        |

---

### B. Checkpoint 2 — Request Gagal (404 Not Found)

- **Request Name:** `GitHub - User Not Found`
- **Method:** `GET`
- **URL:** `https://api.github.com/users/user-tidak-ada-987654321`
- **Status Code:** `404 Not Found`
- **Response Body:**

```json
{
  "message": "Not Found",
  "documentation_url": "[https://docs.github.com/rest/users/users#get-a-user](https://docs.github.com/rest/users/users#get-a-user)",
  "status": "404"
}
```
