# Study Case: Aplikasi Inventory Management (Full App)

Dokumentasi dan study case untuk mempelajari bagaimana backend, controller, request, seeder, frontend, routes, dan API bekerja pada aplikasi ini.

> File ini menjelaskan alur request dari front-end ke backend dan bagaimana Orion serta Spatie Permission bekerja di dalam aplikasi.

---

## Ringkasan Singkat
Aplikasi ini adalah sistem inventory sederhana dibangun menggunakan Laravel 11, Spatie Permission, dan Orion (untuk API resource). Frontend dibangun dengan Blade + Bootstrap (assets ada di `public/assets`) dan interaksi via form untuk CRUD.

Komponen utama:
- Models: `Barang`, `Kategori`, `Peminjaman`, `User`
- Controllers (web): `BarangController`, `KategoriController`, `PeminjamanController`, `UserController`
- Controllers (API): `Api\BarangController` (Orion), `Api\UserController` (Orion)
- Requests: `Store*Request`, `Update*Request` untuk setiap resource
- Seeders: `PermissionSeeder`, `RoleSeeder`, `DefaultUserSeeder`
- Routes: `routes/web.php` (web UI) and `routes/api.php` (Orion REST API)

---

## Backend Flow (High Level)
1. User hits a route (ex: `GET /barangs`)
2. Laravel routes the request to a corresponding controller (ex: `BarangController@index`).
3. Controller loads model data (ex: `Barang::orderByDesc('id')->paginate(10)`) and returns a Blade view.
4. If the action modifies data, the controller uses a `FormRequest` (ex: `StoreBarangRequest`) which validates input automatically.
5. After validation, the controller persists data and redirects back with success flash message.
6. Roles & permissions check occur via middleware `auth` and `permission` (Spatie).

---

## Models & Relationships
- `App\Models\Barang`
  - `$fillable = [ 'nama', 'kategori_id', 'jumlah', 'kondisi', 'lokasi' ]`
  - relations: `belongsTo(Kategori)`, `hasMany(Peminjaman)`

- `App\Models\Kategori`
  - `$fillable = [ 'nama' ]`
  - relations: `hasMany(Barang)`

- `App\Models\Peminjaman`
  - `$fillable = [ 'barang_id', 'user_id', 'tanggal_pinjam', 'tanggal_kembali', 'status' ]`
  - `belongsTo(Barang)`, `belongsTo(User)`

- `App\Models\User` extends `Authenticatable`
  - Has `HasRoles` trait (Spatie) and `$fillable` for `name`, `email`, `password`
  - `peminjamans()` relationship `hasMany(Peminjaman)`

---

## Controllers (Web)
Paths: `app/Http/Controllers/*`

- `BarangController`
  - Adds `middleware('auth')` and `middleware('permission:...')` for per-action controls.
  - `index()` paginates and returns `resources/views/barang/index.blade.php`.
  - `create()`, `store()` use `StoreBarangRequest` to validate before creating.
  - `edit()`, `update()` use `UpdateBarangRequest`. `destroy()` deletes and redirects back.

- `KategoriController`, `PeminjamanController`, `UserController` follow similar patterns with their own `FormRequest` classes and permission checks.

Note: `UserController` includes logic to prevent deleting or editing a Super Admin by other admins.

---

## Requests & Validation
Location: `app/Http/Requests`

- `StoreBarangRequest`: Validates `nama`, `kategori_id` (exists in kategoris), `jumlah`, `kondisi`, `lokasi`.
- `UpdateBarangRequest`: Same checks but allows the same `nama` using unique rule with exception (`unique:barangs,nama,{$this->barang->id}`).
- `StoreKategoriRequest` & `UpdateKategoriRequest` validate `nama` uniqueness
- `StorePeminjamanRequest` & `UpdatePeminjamanRequest` validate `tanggal_pinjam`, `tanggal_kembali`, and `status`.
  - Note: Current `status` rules use `strtolower('in:...')` erroneously — should be simply `in:dipinjam,dikembalikan,hilang,rusak`.
- `StoreUserRequest` & `UpdateUserRequest` validate `name`, `email`, `password` and `roles`.

Using `FormRequest` keeps controllers concise and ensures validation is centralized.

---

## Seeders
Location: `database/seeders`

- `PermissionSeeder` — seeds a list of permissions (view/create/edit/delete) for barangs, kategoris, users, peminjamen, roles.
- `RoleSeeder` — creates roles: Super Admin, Admin, Petugas, User; assigns a set of permissions to Admin, Petugas, and User.
- `DefaultUserSeeder` — creates 4 example users (Super Admin, Admin, Petugas, User) and assigns them roles.

To seed:
```powershell
php artisan migrate --seed
```
This will run migrations and create roles & default users, which then match the permission middleware behavior.

---

## Routes
### Web routes (Blade UI): `routes/web.php`
- `/` -> `home` view
- `/login`, `/register` -> auth views
- Authentication via `Auth::routes()`
- `Route::resources([...])` sets up resourceful routes for `barangs`, `kategoris`, `peminjamans`, `user`, `roles`.

### API routes: `routes/api.php` (Orion)
- `Orion::resource('barangs', App\Http\Controllers\Api\BarangController::class);`
- `Orion::resource('users', App\Http\Controllers\Api\UserController::class);`

This exposes RESTful endpoints for `barangs` and `users` via Orion.

---

## API (Orion) Behavior & Security
- Orion provides automatic CRUD endpoints, filtering, sorting, relationships (`with=`), and pagination.
- Controllers in `app/Http/Controllers/Api` extend `Orion\Http\Controllers\Controller` and set `protected $model`.
- `DisableAuthorization` trait is used in the project to disable Orion's authorization in `Api\BarangController` and `Api\UserController`. In production, remove this trait and enable `auth:sanctum` and proper policies.
- Suggested `routes/api.php` to enforce Sanctum auth:
```php
Route::middleware(['auth:sanctum'])->group(function () {
    Orion::resource('barangs', BarangController::class);
    Orion::resource('users', UserController::class);
});
```

### Example API requests
- GET list: `GET /api/barangs?page=1&per_page=10&sort=-id` (returns a paginated JSON response.)
- POST create: `POST /api/barangs` with JSON body `{ "nama": "Laptop", "kategori_id": 1, "jumlah": 1, "kondisi": "Baik", "lokasi": "CEO" }`

---

## Frontend (Blade + Assets)
- Main layout at `resources/views/layouts/app.blade.php` (includes `header`, `footer`).
- Views for resources in `resources/views/*` (e.g., `resources/views/barang/*.blade.php`, `resources/views/peminjaman/*.blade.php`).
- Assets in `public/assets/*` (Bootstrap, JS plugins, icons). Vite + Tailwind used for dev if needed in `resources/css` and `resources/js`.
- Navigation and menu visibility obey role permissions (`@can`, `@canany` Blade directives using Spatie).

---

## Common Request Flow Example (Create Barang)
1. User visits `GET /barangs/create` -> View shows form
2. Form `POST /barangs` submits to `BarangController@store` -> request hits store method
3. `StoreBarangRequest` validates data (e.g., `kategori_id` exists, `nama` is unique)
4. Controller calls `Barang::create($request->validated())` which returns a new model
5. Controller redirects to index with success message. The frontend displays the new entry.

---

## Authorization & Roles
- Application uses `Spatie\Permission` for role-based permissions. Middleware rules in controllers guard actions.
- `App\Providers\AppServiceProvider::boot()` includes a Gate that grants `Super Admin` full access.
- The `DefaultUserSeeder` sets up sample users with roles and default passwords.
- Protect API endpoints by using `auth:sanctum` middleware and removing `DisableAuthorization` from Orion controllers.

---

## Tests & Postman
- Tests are under `tests/*` (Feature & Unit). You can run with `php artisan test`.
- Postman screenshots: `SS-GET.png` and `SS-POST.png` in repo root are placeholders to demonstrate GET and POST examples (replace them with real images or export a Postman collection).

---

## Potential Improvements & Recommendations
- Fix `StorePeminjamanRequest` & `UpdatePeminjamanRequest` validation for `status` (remove unnecessary `strtolower()` call) — the rule should be `in:dipinjam,dikembalikan,hilang,rusak`.
- Add tests covering API endpoints, especially for permission checks (e.g., ensure unauthorized users can't delete resources).
- Add a Postman Collection `.json` to make API testing reproducible.
- Set up a `docker-compose` for local dev with MySQL, Redis, queue worker, and queue scheduler worker.
- Consider adding API resources/transformers to keep API responses consistent across versions.

---