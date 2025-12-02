# Study Case: Laravel Orion in Aplikasi Inventory Management

Dokumentasi singkat mengenai bagaimana Laravel Orion digunakan di dalam projek ini, contoh endpoint, contoh payload Postman, serta saran perbaikan.

---

## Ringkasan
Aplikasi ini menggunakan package `tailflow/laravel-orion` untuk cepat membuat API resource CRUD yang mengikuti konvensi RESTful. Orion mengabstraksi banyak logika CRUD (filtering, sorting, pagination, includes) sehingga kita bisa menulis API lebih singkat.

Di repository ini, Orion digunakan pada resource API `barangs` (fully Orion) dan disiapkan rute untuk `users` juga (rute Orion), meskipun `UserController` saat ini tidak sepenuhnya extend kelas Controller dari Orion.

---

## File terkait
- `routes/api.php` — mendefinisikan resource API via `Orion::resource()`
- `app/Http/Controllers/Api/BarangController.php` — sebuah controller Orion, fully functional
- `app/Http/Controllers/Api/UserController.php` — saat ini controller ini menggunakan `App\Http\Controllers\Controller` bukan `Orion\Http\Controllers\Controller` (lihat catatan perbaikan di bawah)

---

## Contoh Rute (di `routes/api.php`)
```php
use Orion\Facades\Orion;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\UserController;

Orion::resource('barangs', BarangController::class);
Orion::resource('users', UserController::class);
```

Dengan definisi di atas, Orion otomatis menyediakan endpoint RESTful seperti di bawah:
- GET    /api/barangs
- POST   /api/barangs
- GET    /api/barangs/{id}
- PATCH  /api/barangs/{id}
- DELETE /api/barangs/{id}

Serta secukupnya: filter, sort, include, paginate, dll.

---

## Contoh Controller
`app/Http/Controllers/Api/BarangController.php`:
```php
<?php

namespace App\Http\Controllers\Api;

use Orion\Http\Controllers\Controller;
use App\Models\Barang;
use Orion\Concerns\DisableAuthorization;

class BarangController extends Controller
{
    use DisableAuthorization; // trait ini mematikan check authorization bawaan Orion

    protected $model = Barang::class;
}
```

Catatan: `DisableAuthorization` mematikan seluruh otorisasi bawaan dari Orion sehingga API dapat diakses tanpa token atau kebijakan. Di production, sebaiknya hilangkan trait ini dan gunakan auth/permissions (misalnya Laravel Sanctum + Spatie) agar API terlindungi.

`app/Http/Controllers/Api/UserController.php`:
```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; // NOTE: bukan Orion Controller
use App\Models\User;
use Orion\Concerns\DisableAuthorization;

class UserController extends Controller
{
    use DisableAuthorization;

    protected $model = User::class;
}
```

Rekomendasi: ubah `use App\Http\Controllers\Controller;` menjadi `use Orion\Http\Controllers\Controller;` agar Orion behavior aktif pada `UserController`.

---

## Contoh Request (Postman / cURL)
Berikut contoh payload request untuk membuat `Barang` dan contoh permintaan GET list:

### POST (Create barang)
Endpoint: `POST /api/barangs`
Headers:
- Accept: application/json
- Content-Type: application/json

Body (JSON):
```json
{
  "nama": "Monitor Dell 24\"",
  "kategori_id": 1,
  "jumlah": 5,
  "kondisi": "Baik",
  "lokasi": "Gudang A"
}
```

Contoh cURL:
```bash
curl -X POST "http://localhost:8000/api/barangs" \
  -H "Content-Type: application/json" \
  -d '{"nama":"Monitor Dell","kategori_id":1,"jumlah":5,"kondisi":"Baik","lokasi":"Gudang"}'
```

### GET (List barang dengan pagination, sort, filter)
Endpoint: `GET /api/barangs?page=1&per_page=10&sort=-id&search=Monitor`

Contoh cURL:
```bash
curl "http://localhost:8000/api/barangs?page=1&per_page=10&sort=-id"
```

> Jika request berhasil, response JSON akan menampilkan data, metadata pagination, dan link navigasi.

---

## Postman Proof (tangkapan layar)
Tambahkan SS-GET.png dan SS-POST.png di root repo agar dapat dilihat pada Markdown. Contoh: `![GET Request](SS-GET.png)`.

(SS-GET.png) menunjukkan list response `GET /api/barangs`.

(SS-POST.png) menunjukkan hasil response `POST /api/barangs`.

---

## Tips dan Saran Perbaikan
1. Pastikan `UserController` juga extend `Orion\Http\Controllers\Controller` untuk konsistensi: sehingga Orion behavior (filter/sort/etc.) berfungsi untuk resource user.

2. Jangan gunakan `DisableAuthorization` di controller pada production. Gunakan middleware `auth:sanctum` atau kebijakan (policy) Or via Orion's `authorize`/`authorizeResource` agar endpoint API aman.

   Contoh mengaktifkan authorisasi dengan Sanctum:
   - Pasang `sanctum` dan konfigurasi.
   - Tambahkan middleware pada `routes/api.php`:

```php
use Illuminate\Http\Request;

Route::middleware(['auth:sanctum'])->group(function () {
    Orion::resource('barangs', BarangController::class);
    Orion::resource('users', UserController::class);
});
```

3. Jika ingin memfilter atau meng-include relasi pada API, Orion mendukung query-string seperti `?with=kategori` atau klien bisa menggunakan `?search=` untuk pencarian.

4. Gunakan Resource DTO atau Transformer bila perlu untuk menyesuaikan struktur response JSON.

---