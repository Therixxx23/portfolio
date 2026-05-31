# AGENTS.MD — Portfolio Project Blueprint

> Panduan lengkap untuk AI Agent, Developer, atau siapa pun yang ingin melanjutkan, memodifikasi, atau memahami proyek ini.

---

## 📌 Project Overview

**Nama Proyek:** Personal Portfolio Website  
**Pemilik:** Rifqi Ariq  
**Tujuan:** Menampilkan identitas profesional sebagai Game Developer, Frontend Developer, dan Graphic Designer secara interaktif dan modern.  
**Status:** Active Development  

---

## 🧱 Tech Stack

| Layer | Teknologi |
|---|---|
| Framework | **Next.js 14** (App Router) |
| Styling | **Tailwind CSS** + **CSS Custom Properties** |
| Animasi | **Framer Motion** |
| WebGL Embed | **Unity WebGL Build** (iframe / loader) |
| GitHub API | **GitHub REST API v3** |
| Form/Email | **EmailJS** atau **Resend** |
| Auth Admin | **NextAuth.js** (Credentials Provider) |
| Database | **Supabase** (PostgreSQL) atau **JSON file** (simple) |
| Deployment | **Vercel** |
| Version Control | **Git + GitHub** |

---

## 📁 Struktur Direktori

```
/portfolio
├── public/
│   ├── cv/                    # CV PDF untuk download
│   ├── games/                 # Unity WebGL builds
│   │   └── [game-name]/       # index.html, Build/, TemplateData/
│   ├── images/
│   │   ├── profile/           # Foto profil
│   │   ├── projects/          # Screenshot project
│   │   └── icons/             # Tech icons
│   └── favicon.ico
│
├── src/
│   ├── app/
│   │   ├── layout.tsx          # Root layout + font loading
│   │   ├── page.tsx            # Home (semua section scroll)
│   │   ├── projects/
│   │   │   └── page.tsx        # Halaman Projects
│   │   ├── skills/
│   │   │   └── page.tsx        # Halaman Skills
│   │   ├── play/
│   │   │   └── page.tsx        # Halaman WebGL Game
│   │   ├── github/
│   │   │   └── page.tsx        # Halaman GitHub Activity
│   │   ├── connect/
│   │   │   └── page.tsx        # Halaman Connect/Contact
│   │   └── admin/
│   │       ├── layout.tsx      # Admin layout + auth guard
│   │       ├── page.tsx        # Admin dashboard
│   │       ├── projects/
│   │       │   └── page.tsx    # Kelola projects
│   │       └── games/
│   │           └── page.tsx    # Kelola WebGL games
│   │
│   ├── components/
│   │   ├── layout/
│   │   │   ├── Navbar.tsx
│   │   │   ├── Footer.tsx
│   │   │   └── MobileMenu.tsx
│   │   ├── sections/
│   │   │   ├── Intro.tsx       # Animasi intro splash screen
│   │   │   ├── Hero.tsx        # Greeting + CTA
│   │   │   ├── About.tsx       # About + Experience + Education
│   │   │   └── ScrollProgress.tsx
│   │   ├── ui/
│   │   │   ├── Button.tsx
│   │   │   ├── Card.tsx
│   │   │   ├── TechIcon.tsx
│   │   │   ├── Modal.tsx
│   │   │   └── LiquidBlob.tsx  # SVG liquid animation component
│   │   ├── projects/
│   │   │   ├── ProjectCard.tsx
│   │   │   └── ProjectFilter.tsx
│   │   ├── github/
│   │   │   ├── ContributionGraph.tsx
│   │   │   └── RepoCard.tsx
│   │   ├── game/
│   │   │   ├── UnityLoader.tsx
│   │   │   └── GameCard.tsx
│   │   └── admin/
│   │       ├── ProjectForm.tsx
│   │       └── GameUploader.tsx
│   │
│   ├── lib/
│   │   ├── github.ts           # GitHub API helper
│   │   ├── email.ts            # EmailJS / Resend helper
│   │   ├── db.ts               # Supabase client
│   │   └── auth.ts             # NextAuth config
│   │
│   ├── data/
│   │   ├── experience.ts       # Data pengalaman kerja
│   │   ├── education.ts        # Data pendidikan
│   │   ├── skills.ts           # Data skills + icons
│   │   └── projects.ts         # Fallback static project data
│   │
│   ├── hooks/
│   │   ├── useScrollAnimation.ts
│   │   └── useGitHubData.ts
│   │
│   ├── types/
│   │   └── index.ts            # TypeScript interfaces
│   │
│   └── styles/
│       └── globals.css         # CSS variables, base styles
│
├── .env.local                  # Environment variables (JANGAN di-commit)
├── .env.example                # Template env vars
├── AGENTS.MD                   # File ini
├── DESIGN.MD                   # Panduan desain
├── next.config.js
├── tailwind.config.ts
├── tsconfig.json
└── package.json
```

---

## 🗂️ Halaman & Section

### 1. `/` — Home Page (Single Scroll)
Semua section di satu halaman dengan smooth scroll:

| Section | Komponen | Keterangan |
|---|---|---|
| Intro Splash | `<Intro />` | Animasi liquid masuk, auto-dismiss 3 detik |
| Hero | `<Hero />` | Greeting, nama, tagline, tombol Download CV |
| About | `<About />` | Foto, bio, pengalaman, pendidikan |

### 2. `/projects` — Projects
- Filter: All / Unity Game / Web
- Card: thumbnail, nama, deskripsi, tech stack, link demo/repo
- Data dari Supabase (bisa di-update via Admin)

### 3. `/skills` — Skills
- Grid icon teknologi dengan hover tooltip
- Kategori: Frontend, Game Dev, Design Tools
- Animasi stagger masuk saat scroll

### 4. `/play` — WebGL Game Room
- Daftar game card
- Click → load Unity WebGL di iframe fullscreen
- Loading indicator saat Unity init

### 5. `/github` — GitHub Activity
- Contribution heatmap (via GitHub API)
- Statistik: total commits, repos, streak
- Recent commits feed

### 6. `/connect` — Connect & Contact
- Social links: Instagram, GitHub, Email, LinkedIn
- Contact form → kirim langsung ke email via EmailJS
- Animasi liquid background

### 7. `/admin` — Admin Panel (Protected)
- Login dengan username + password (env variable)
- CRUD Projects: tambah/edit/hapus
- Upload WebGL Game: upload folder build
- Preview sebelum publish

---

## 🔑 Environment Variables

Buat file `.env.local` berdasarkan `.env.example`:

```env
# GitHub API
GITHUB_USERNAME=your_github_username
GITHUB_TOKEN=ghp_YOUR_TOKEN_HERE

# EmailJS
NEXT_PUBLIC_EMAILJS_SERVICE_ID=service_xxxxx
NEXT_PUBLIC_EMAILJS_TEMPLATE_ID=template_xxxxx
NEXT_PUBLIC_EMAILJS_PUBLIC_KEY=xxxxxxxxxxxxx

# Admin Auth
ADMIN_USERNAME=admin
ADMIN_PASSWORD=your_secure_password_here
NEXTAUTH_SECRET=your_nextauth_secret_32chars
NEXTAUTH_URL=http://localhost:3000

# Supabase (opsional)
NEXT_PUBLIC_SUPABASE_URL=https://xxxx.supabase.co
NEXT_PUBLIC_SUPABASE_ANON_KEY=eyJxxxxxxxx

# Email tujuan form contact
CONTACT_EMAIL=youremail@gmail.com
```

> ⚠️ **JANGAN** commit `.env.local` ke GitHub. Sudah ada di `.gitignore`.

---

## 📦 Data Statis

Jika tidak menggunakan Supabase, data project dan game disimpan di `src/data/`:

### `src/data/experience.ts`
```typescript
export const experiences = [
  {
    id: 1,
    company: "Game House Genply",
    role: "Game Developer",
    period: "2020 – 2021",
    description: "Pengembangan game menggunakan Unity, desain mekanik gameplay, dan optimasi performa.",
    type: "work"
  },
  {
    id: 2,
    company: "Bandeng Presto Cianjur",
    role: "Graphic Designer (Instagram)",
    period: "2021 – 2022",
    description: "Mengelola konten visual Instagram brand, membuat desain feed, stories, dan promosi menggunakan Canva.",
    type: "work"
  }
];
```

### `src/data/skills.ts`
```typescript
export const skills = {
  frontend: [
    { name: "Laravel", icon: "laravel", color: "#FF2D20" },
    { name: "HTML5",   icon: "html5",   color: "#E34F26" },
    { name: "CSS3",    icon: "css3",    color: "#1572B6" },
    { name: "JavaScript", icon: "javascript", color: "#F7DF1E" },
    { name: "PHP",     icon: "php",     color: "#777BB4" },
  ],
  gamedev: [
    { name: "Unity",   icon: "unity",   color: "#FFFFFF" },
    { name: "C#",      icon: "csharp",  color: "#239120" },
  ],
  design: [
    { name: "Canva",   icon: "canva",   color: "#00C4CC" },
    { name: "Figma",   icon: "figma",   color: "#F24E1E" },
  ]
};
```

---

## 🎮 Unity WebGL Integration

### Cara Embed Game:
1. Export game dari Unity: **File → Build Settings → WebGL → Build**
2. Copy folder hasil build ke `public/games/[nama-game]/`
3. Pastikan ada `index.html` di root folder game
4. Di database/data, tambahkan entry:
   ```json
   {
     "id": "game-1",
     "title": "Nama Game",
     "description": "Deskripsi singkat",
     "thumbnail": "/images/projects/game-thumb.jpg",
     "path": "/games/nama-game/index.html",
     "category": "unity"
   }
   ```
5. Komponen `<UnityLoader path={game.path} />` akan load via iframe

### Catatan:
- Set Unity **Compression Format → Disabled** untuk kompatibilitas web
- Aktifkan **Allow 'unsafe-inline'** di `next.config.js` untuk Unity loader
- Game berjalan di iframe dengan `sandbox="allow-scripts allow-same-origin"`

---

## 🔐 Admin Panel

### Akses:
- URL: `/admin`
- Login: credentials dari `.env.local`
- Session: disimpan via NextAuth cookie (7 hari)

### Fitur Admin:
1. **Dashboard** — ringkasan jumlah project & game
2. **Kelola Project** — form tambah/edit/hapus project (nama, deskripsi, thumbnail URL, tech stack, link)
3. **Kelola Game** — form tambah/edit/hapus game WebGL (nama, deskripsi, path, thumbnail)
4. **Preview** — lihat tampilan sebelum publish

---

## 🚀 Setup & Instalasi

```bash
# Clone repo
git clone https://github.com/USERNAME/portfolio.git
cd portfolio

# Install dependencies
npm install

# Setup environment
cp .env.example .env.local
# Edit .env.local dengan nilai yang sesuai

# Jalankan development server
npm run dev

# Build untuk production
npm run build
npm run start
```

---

## 📤 Deploy ke Vercel

```bash
# Install Vercel CLI
npm i -g vercel

# Login
vercel login

# Deploy
vercel --prod
```

Tambahkan semua environment variable di **Vercel Dashboard → Settings → Environment Variables**.

---

## 🔄 Git Workflow

### Auto-push setiap perubahan:

```bash
# Buat script push otomatis: save-push.sh
#!/bin/bash
git add .
git commit -m "update: $(date '+%Y-%m-%d %H:%M:%S')"
git push origin main
```

```bash
chmod +x save-push.sh
./save-push.sh
```

### Atau gunakan alias di `~/.bashrc` / `~/.zshrc`:
```bash
alias portfolio-push='cd ~/portfolio && git add . && git commit -m "update: $(date +"%Y-%m-%d %H:%M")" && git push origin main'
```

### GitHub Actions (Auto Deploy on Push):
File `.github/workflows/deploy.yml` sudah dikonfigurasi untuk auto-deploy ke Vercel saat push ke `main`.

---

## 🤖 Instruksi untuk AI Agent

Jika kamu adalah AI Agent yang mengerjakan proyek ini, ikuti aturan berikut:

1. **Selalu baca DESIGN.MD** sebelum membuat komponen UI apapun
2. **Gunakan TypeScript** untuk semua file `.tsx` dan `.ts`
3. **Ikuti struktur folder** yang sudah ditetapkan di atas
4. **Jangan ubah** CSS variables di `globals.css` tanpa update `DESIGN.MD`
5. **Setiap komponen baru** harus: functional component, ada props interface, ada default export
6. **Animasi** menggunakan Framer Motion, bukan CSS keyframes kecuali untuk efek liquid/blob
7. **Data statis** di `/src/data/`, bukan hardcode di komponen
8. **Setelah selesai** satu fitur, jalankan: `git add . && git commit -m "feat: [nama fitur]" && git push`
9. **Admin routes** selalu cek autentikasi di layout, bukan di setiap page
10. **WebGL path** selalu relatif ke `/public/games/`

---

## 📋 Checklist Development

- [ ] Setup Next.js + Tailwind + Framer Motion
- [ ] Implementasi CSS variables (DESIGN.MD)
- [ ] Komponen `<LiquidBlob />` untuk efek liquid
- [ ] Halaman Home + Intro animation
- [ ] Section Hero + About + Experience
- [ ] Halaman Projects + filter
- [ ] Halaman Skills + tech icons grid
- [ ] Halaman Play (WebGL embed)
- [ ] Halaman GitHub Activity
- [ ] Halaman Connect + form email
- [ ] Admin panel + auth
- [ ] Responsive mobile
- [ ] Deploy ke Vercel
- [ ] Custom domain (opsional)