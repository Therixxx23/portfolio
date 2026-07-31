# DOKKU_DEPLOY — Deploy Portfolio ke Dokku

Panduan manual deploy project **Rifqi Ariq Portfolio** (Laravel 12) ke server **Dokku** menggunakan **Dockerfile** (bukan buildpack/herokuish).

---

## Prasyarat

- Server Dokku sudah terpasang dan bisa diakses via SSH (`ssh root@<host>`).
- Git sudah terinstall lokal.
- Plugin **dokku-mysql** di server:

```bash
# di server Dokku
dokku plugin:install https://github.com/dokku/dokku-mysql.git mysql
```

- (Opsional) Domain untuk app, misal `portfolio.example.com`.

---

## 1. Buat App & Database

```bash
# di server Dokku
dokku apps:create portfolio
dokku mysql:create portfolio-db
dokku mysql:link portfolio-db portfolio
```

> `dokku mysql:link` otomatis meng-set `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` ke config app.

## 2. Set Environment Variables

Set semua env wajib (diambil dari `.env.example`):

```bash
dokku config:set portfolio \
  APP_NAME="Rifqi Ariq Portfolio" \
  APP_ENV=production \
  APP_DEBUG=false \
  APP_URL=https://portfolio.example.com \
  APP_KEY="<generate-di-bawah>" \
  RUN_MIGRATIONS=true \
  SESSION_DRIVER=file \
  CACHE_STORE=file \
  GITHUB_USERNAME=your_github_username \
  GITHUB_TOKEN=ghp_YOUR_TOKEN_HERE \
  VITE_EMAILJS_SERVICE_ID=service_xxxxx \
  VITE_EMAILJS_TEMPLATE_ID=template_xxxxx \
  VITE_EMAILJS_PUBLIC_KEY=xxxxxxxxxxxxx \
  ADMIN_USERNAME=admin \
  ADMIN_PASSWORD=your_secure_password \
  CONTACT_EMAIL=youremail@gmail.com
```

### Generate APP_KEY

`APP_KEY` wajib di-set (entrypoint TIDAK menimpa `APP_KEY` yang sudah di-set via env). Generate di lokal:

```bash
php -r "echo 'base64:'.base64_encode(random_bytes(32)).PHP_EOL;"
```

lalu masukkan hasilnya ke `APP_KEY=...` di atas. Alternatif (jika `vendor` ada): `php artisan key:generate --show`.

### Variabel wajib ringkas

| Variable | Keterangan |
|---|---|
| `APP_KEY` | Key enkripsi Laravel (base64, 32 bytes) |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_URL` | URL publik, contoh `https://portfolio.example.com` |
| `RUN_MIGRATIONS` | `true` agar `php artisan migrate --force` jalan saat container start |
| `SESSION_DRIVER`, `CACHE_STORE` | `file` (opsional; default Laravel 12 pakai `database` dan butuh tabel hasil migrasi) |
| `DB_*` | Otomatis di-set oleh `dokku mysql:link` |
| `GITHUB_USERNAME`, `GITHUB_TOKEN` | GitHub API (untuk halaman `/github`) |
| `VITE_EMAILJS_*` | EmailJS (dibaca runtime via `env()` di `connect.blade.php`) |
| `ADMIN_USERNAME`, `ADMIN_PASSWORD` | Login halaman `/admin` |
| `CONTACT_EMAIL` | Email tujuan form contact |

> EmailJS dibaca server-side via `env()` di Blade saat runtime, jadi cukup di-set sebagai env runtime — tidak perlu plugin build-env.

## 3. Deploy

```bash
# dari folder project lokal
git remote add dokku dokku@<host>:portfolio
git push dokku main
```

Dokku akan mendeteksi `Dockerfile`, build multi-stage, lalu jalankan CHECKS (health check `/up`) sebelum melakukan zero-downtime switch.

### Build catatan

- **Stage 1**: `npm ci && npm run build` (Vite) → hasilnya disalin ke `public/build`.
- **Stage 2**: `composer install --no-dev`, cache `config/route/view` di-build, permission `storage/` & `bootstrap/cache/` di-set ke `www-data`.
- Config cache yang di-bake saat build **dibersihkan saat container start** agar env runtime Dokku (DB_HOST, APP_URL, dll) tetap terbaca. Ini disengaja.

## 4. Domain & HTTPS

```bash
# domain custom
dokku domains:add portfolio portfolio.example.com

# HTTPS (let's encrypt)
dokku letsencrypt:enable portfolio
```

> Cek DNS `A` record domain mengarah ke IP server Dokku sebelum enable letsencrypt.

## 5. Persistent Storage (file upload)

Container bersifat ephemeral — upload thumbnail/gallery/admin akan hilang saat redeploy. Mount volume untuk `storage/app/public`:

```bash
# di server Dokku
mkdir -p /var/lib/dokku/data/storage
chown dokku:dokku /var/lib/dokku/data/storage
dokku storage:mount portfolio /var/lib/dokku/data/storage:/var/www/html/storage/app/public
```

Entrypoint otomatis menjalankan `php artisan storage:link --relative`, jadi file upload tetap tersaji lewat `/storage/...`.

## 6. Rebuild / Redeploy

```bash
# deploy ulang setelah ada perubahan kode
git push dokku main

# atau force rebuild image tanpa kode baru
dokku ps:rebuild portfolio

# restart saja
dokku ps:restart portfolio
```

## Troubleshooting

- **Health check gagal / deploy stuck**: cek log `dokku logs portfolio --tail` — biasanya koneksi DB belum siap atau env belum lengkap.
- **Halaman 500 setelah deploy**: pastikan `APP_KEY` sudah di-set, `RUN_MIGRATIONS=true`, dan `DB_*` sudah ter-link (cek `dokku config:show portfolio`).
- **Upload 404**: cek `dokku storage:mount` (langkah 5) dan pastikan `storage/app/public` tersedia.
- **Migrasi belum jalan**: jalankan manual `dokku run portfolio php artisan migrate --force`.
