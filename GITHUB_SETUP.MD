# GITHUB_SETUP.MD — Panduan Push ke GitHub

Panduan lengkap untuk menghubungkan proyek portfolio ke GitHub dan melakukan push otomatis.

---

## ⚡ Quick Start (3 Langkah)

### Langkah 1 — Buat Repo GitHub

1. Buka https://github.com/new
2. Isi:
   - **Repository name:** `portfolio`
   - **Description:** `Personal Portfolio — Game Developer, Frontend, Graphic Designer`
   - **Visibility:** Public (agar bisa dilihat recruiter) atau Private
   - ❌ **JANGAN** centang "Add a README file"
   - ❌ **JANGAN** centang ".gitignore"
3. Klik **"Create repository"**

---

### Langkah 2 — Setup di Komputer Lokal

```bash
# 1. Masuk ke folder proyek
cd /path/ke/folder/portfolio

# 2. Edit setup-github.sh, ganti USERNAME_GITHUB_ANDA dengan username GitHub kamu
nano setup-github.sh
# atau
code setup-github.sh

# 3. Jalankan setup (hanya sekali)
bash setup-github.sh

# 4. Push pertama kali
git push -u origin main
```

Jika diminta username/password, masukkan:
- Username: username GitHub kamu
- Password: **Personal Access Token** (bukan password biasa — lihat bagian bawah)

---

### Langkah 3 — Push Setiap Ada Update

```bash
# Cara 1: Dengan pesan otomatis (timestamp)
bash push.sh

# Cara 2: Dengan pesan custom
bash push.sh "feat: tambah halaman projects"
bash push.sh "fix: perbaiki animasi intro"
bash push.sh "style: update warna navbar"
```

---

## 🔑 Membuat Personal Access Token (PAT)

GitHub sudah tidak mendukung password biasa. Gunakan token:

1. Buka https://github.com/settings/tokens
2. Klik **"Generate new token (classic)"**
3. Isi:
   - **Note:** `portfolio-push`
   - **Expiration:** No expiration (atau 1 year)
   - **Scopes:** centang ✅ `repo` (full control)
4. Klik **"Generate token"**
5. **Salin token** (hanya muncul sekali!)

### Simpan Token agar Tidak Perlu Input Terus

**Cara A — HTTPS dengan credential store:**
```bash
git config --global credential.helper store
# Lalu push sekali, masukkan token sebagai password
# Setelah itu otomatis tersimpan
```

**Cara B — SSH Key (Lebih Aman, Direkomendasikan):**
```bash
# 1. Generate SSH key
ssh-keygen -t ed25519 -C "rifqiariqf@gmail.com"
# Tekan Enter terus untuk default

# 2. Salin public key
cat ~/.ssh/id_ed25519.pub
# Salin outputnya

# 3. Tambahkan ke GitHub
# Buka: https://github.com/settings/ssh/new
# Title: "Laptop Saya"
# Key: paste public key tadi

# 4. Test koneksi
ssh -T git@github.com
# Output: "Hi Therixxx23! You've successfully authenticated"

# 5. Ubah remote URL ke SSH
git remote set-url origin git@github.com:Therixxx23/portfolio.git
```

---

## 🤖 Auto-Push Setiap Save (Opsional)

Jika ingin **setiap kali save file otomatis push ke GitHub**, gunakan salah satu cara berikut:

### Cara A — Watch Script (Terminal)

```bash
# Install fswatch (macOS)
brew install fswatch

# Install inotify-tools (Linux/Ubuntu)
sudo apt-get install inotify-tools

# Jalankan watch (macOS)
fswatch -o ./src | xargs -n1 -I{} bash push.sh "auto: save $(date '+%H:%M')"

# Jalankan watch (Linux)
while inotifywait -r -e modify,create,delete ./src; do
  bash push.sh "auto: save $(date '+%H:%M:%S')"
done
```

### Cara B — Git Hooks (Setiap Commit)

```bash
# Buat hook post-commit
cat > .git/hooks/post-commit << 'EOF'
#!/bin/bash
git push origin main
echo "✅ Auto-pushed to GitHub"
EOF

chmod +x .git/hooks/post-commit
```

Setelah ini, setiap `git commit` otomatis langsung push.

### Cara C — VS Code Extension

Install **"Git Auto Push"** di VS Code Extensions (Ctrl+Shift+X):
- Search: `Git Auto Push`
- Konfigurasi interval push di settings.json

---

## 🔄 GitHub Actions — Auto Deploy ke Vercel

File `.github/workflows/deploy.yml` sudah disiapkan. Setup secrets di GitHub:

1. Buka repo GitHub → **Settings → Secrets and variables → Actions**
2. Tambahkan secrets berikut (klik "New repository secret"):

| Secret Name | Nilai | Cara Dapat |
|---|---|---|
| `VERCEL_TOKEN` | Token Vercel | https://vercel.com/account/tokens |
| `VERCEL_ORG_ID` | Org ID Vercel | `vercel link` di terminal, lihat `.vercel/project.json` |
| `VERCEL_PROJECT_ID` | Project ID | Same file di atas |
| `GH_TOKEN` | GitHub PAT | https://github.com/settings/tokens |
| `NEXTAUTH_SECRET` | Random string 32 char | `openssl rand -base64 32` |
| `NEXTAUTH_URL` | URL production | `https://portfolio-kamu.vercel.app` |
| `EMAILJS_SERVICE_ID` | Service ID EmailJS | https://dashboard.emailjs.com |
| `EMAILJS_TEMPLATE_ID` | Template ID | Same dashboard |
| `EMAILJS_PUBLIC_KEY` | Public Key | Same dashboard |

**Cara dapat Vercel IDs:**
```bash
# Install Vercel CLI
npm i -g vercel

# Login
vercel login

# Link ke project (jalankan di folder portfolio)
vercel link

# Lihat IDs
cat .vercel/project.json
```

---

## 📋 Konvensi Pesan Commit

Gunakan format ini agar rapi:

```
feat: tambah fitur baru
fix: perbaiki bug
style: perubahan tampilan/CSS
refactor: refactor kode tanpa ubah fungsi
content: update konten/data
docs: update dokumentasi
chore: update dependency, config
```

Contoh:
```bash
bash push.sh "feat: tambah halaman WebGL game"
bash push.sh "content: tambah project Unity Platformer"
bash push.sh "fix: perbaiki form contact tidak terkirim"
bash push.sh "style: update animasi intro splash"
```

---

## 🆘 Troubleshooting

### "Permission denied (publickey)"
```bash
# Cek SSH key
ssh-add -l

# Kalau kosong, tambahkan key
ssh-add ~/.ssh/id_ed25519
```

### "remote: Repository not found"
```bash
# Cek remote URL
git remote -v

# Perbaiki URL
git remote set-url origin https://github.com/Therixxx23/portfolio.git
# atau SSH:
git remote set-url origin git@github.com:Therixxx23/portfolio.git
```

### "Updates were rejected because the remote contains work"
```bash
# Pull dulu, baru push
git pull origin main --rebase
git push origin main
```

### Push berhasil tapi Vercel tidak deploy
- Pastikan semua secrets sudah ditambahkan di GitHub
- Cek tab **Actions** di GitHub untuk melihat log error
- Pastikan `NEXTAUTH_URL` sudah diisi URL Vercel yang benar

---

## ✅ Checklist Final

- [ ] Repo GitHub sudah dibuat
- [ ] `setup-github.sh` sudah dijalankan
- [ ] Push pertama berhasil (`git push -u origin main`)
- [ ] `.env.local` sudah diisi (dan tidak di-commit)
- [ ] Vercel token & secrets sudah dikonfigurasi
- [ ] GitHub Actions berjalan saat push ke `main`
- [ ] `bash push.sh` berjalan dengan benar
