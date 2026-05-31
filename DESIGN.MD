# DESIGN.MD — Design System & Visual Guidelines

> Panduan lengkap sistem desain untuk portfolio ini. Semua keputusan visual, token, komponen, dan animasi didokumentasikan di sini.

---

## 🎨 Design Direction

### Konsep Utama: **"Liquid Glass"**

Portfolio ini menggabungkan tiga elemen visual utama:

- **Liquid** — Bentuk organik yang bergerak perlahan, blob SVG animasi, morfing shapes
- **Glass** — Efek glassmorphism: transparan, blur, border cahaya tipis
- **Void** — Background gelap dalam (bukan hitam murni), memberikan kesan ruang yang dalam

Hasil akhir: seperti melihat elemen-elemen mengambang di dalam cairan gelap yang bercahaya.

---

## 🎨 Color System

### Palet Utama

```css
:root {
  /* Background — Dark Void */
  --bg-void:       #080C14;   /* Background paling dalam */
  --bg-deep:       #0D1220;   /* Panel, section backgrounds */
  --bg-surface:    #141926;   /* Card, komponen */
  --bg-elevated:   #1C2436;   /* Hover states, elevated cards */

  /* Accent — Liquid Teal/Cyan */
  --accent-primary:   #00D4FF;   /* CTA utama, highlight */
  --accent-secondary: #0099CC;   /* Hover accent */
  --accent-glow:      #00D4FF26; /* Glow effect (15% opacity) */
  --accent-subtle:    #00D4FF0D; /* Very subtle tint (5% opacity) */

  /* Liquid Blob Colors */
  --blob-1: #00D4FF;   /* Teal */
  --blob-2: #0066FF;   /* Blue */
  --blob-3: #00FFB3;   /* Mint */

  /* Text */
  --text-primary:   #F0F4FF;   /* Heading utama */
  --text-secondary: #8B9CBD;   /* Body text */
  --text-muted:     #4A5568;   /* Placeholder, disabled */
  --text-accent:    #00D4FF;   /* Highlighted text */

  /* Glass Effect */
  --glass-bg:      rgba(255, 255, 255, 0.04);
  --glass-border:  rgba(255, 255, 255, 0.08);
  --glass-hover:   rgba(255, 255, 255, 0.07);
  --glass-blur:    16px;

  /* Status */
  --success: #00FFB3;
  --warning: #FFB800;
  --error:   #FF4466;
}
```

### Gradient System

```css
/* Gradient untuk blob dan background effects */
--gradient-liquid: linear-gradient(135deg, var(--blob-1), var(--blob-2));
--gradient-glow:   radial-gradient(circle at center, var(--accent-glow) 0%, transparent 70%);
--gradient-hero:   radial-gradient(ellipse at 20% 50%, #00D4FF15 0%, transparent 60%),
                   radial-gradient(ellipse at 80% 20%, #0066FF10 0%, transparent 50%);
--gradient-text:   linear-gradient(135deg, #00D4FF, #0099FF, #00FFB3);
```

---

## 🔤 Typography

### Font Pairing

```css
/* Display Font — untuk heading besar, nama, tagline */
@import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&display=swap');
--font-display: 'Syne', sans-serif;

/* Body Font — untuk paragraf, label, body text */
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&display=swap');
--font-body: 'DM Sans', sans-serif;

/* Mono — untuk kode, tag teknologi */
@import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap');
--font-mono: 'JetBrains Mono', monospace;
```

### Type Scale

```css
--text-xs:   0.75rem;    /* 12px — label kecil */
--text-sm:   0.875rem;   /* 14px — caption, tag */
--text-base: 1rem;       /* 16px — body default */
--text-lg:   1.125rem;   /* 18px — lead text */
--text-xl:   1.25rem;    /* 20px — subheading */
--text-2xl:  1.5rem;     /* 24px — section title */
--text-3xl:  1.875rem;   /* 30px — page title */
--text-4xl:  2.25rem;    /* 36px — hero subtitle */
--text-5xl:  3rem;       /* 48px — hero title */
--text-6xl:  3.75rem;    /* 60px — display */
--text-7xl:  4.5rem;     /* 72px — mega display */
```

### Usage Rules

| Element | Font | Weight | Size |
|---|---|---|---|
| Nama (Hero) | Syne | 800 | 5xl–7xl |
| Tagline | DM Sans | 300 | xl–2xl |
| Section Title | Syne | 700 | 3xl–4xl |
| Card Title | Syne | 600 | xl–2xl |
| Body Text | DM Sans | 400 | base–lg |
| Tech Tag | JetBrains Mono | 400 | xs–sm |
| Navigation | DM Sans | 500 | sm |

---

## 📐 Spacing & Layout

### Spacing Scale (Tailwind compatible)

```css
--space-1:  0.25rem;   /* 4px */
--space-2:  0.5rem;    /* 8px */
--space-3:  0.75rem;   /* 12px */
--space-4:  1rem;      /* 16px */
--space-5:  1.25rem;   /* 20px */
--space-6:  1.5rem;    /* 24px */
--space-8:  2rem;      /* 32px */
--space-10: 2.5rem;    /* 40px */
--space-12: 3rem;      /* 48px */
--space-16: 4rem;      /* 64px */
--space-20: 5rem;      /* 80px */
--space-24: 6rem;      /* 96px */
--space-32: 8rem;      /* 128px */
```

### Container

```css
--container-max:    1200px;
--container-narrow: 800px;
--container-wide:   1400px;
--container-padding: clamp(1.5rem, 5vw, 4rem);
```

### Section Padding

```css
--section-padding-y: clamp(5rem, 10vw, 8rem);
```

---

## 🪟 Glassmorphism Components

### Base Glass Card

```css
.glass-card {
  background: var(--glass-bg);
  backdrop-filter: blur(var(--glass-blur));
  -webkit-backdrop-filter: blur(var(--glass-blur));
  border: 1px solid var(--glass-border);
  border-radius: 1rem;
  transition: background 0.3s ease, border-color 0.3s ease, transform 0.3s ease;
}

.glass-card:hover {
  background: var(--glass-hover);
  border-color: rgba(0, 212, 255, 0.2);
  transform: translateY(-2px);
}
```

### Variants

```css
/* Elevated — untuk highlight cards */
.glass-elevated {
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(0, 212, 255, 0.15);
}

/* Minimal — untuk list items */
.glass-minimal {
  background: rgba(255, 255, 255, 0.02);
  border-color: rgba(255, 255, 255, 0.05);
}

/* Accent — untuk CTA cards */
.glass-accent {
  background: rgba(0, 212, 255, 0.05);
  border-color: rgba(0, 212, 255, 0.25);
}
```

---

## 💧 Liquid Animations

### SVG Liquid Blob (CSS)

```css
/* Blob bergerak organik dengan morphing */
@keyframes liquidMorph {
  0%   { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
  25%  { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
  50%  { border-radius: 50% 60% 30% 60% / 30% 40% 70% 50%; }
  75%  { border-radius: 40% 70% 60% 30% / 60% 50% 40% 70%; }
  100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
}

.liquid-blob {
  animation: liquidMorph 8s ease-in-out infinite;
  background: var(--gradient-liquid);
  filter: blur(40px);
  opacity: 0.15;
  position: absolute;
  pointer-events: none;
}

.liquid-blob-1 {
  width: 400px;
  height: 400px;
  animation-duration: 10s;
  animation-delay: 0s;
}

.liquid-blob-2 {
  width: 300px;
  height: 300px;
  animation-duration: 14s;
  animation-delay: -3s;
}

.liquid-blob-3 {
  width: 250px;
  height: 250px;
  animation-duration: 12s;
  animation-delay: -6s;
}
```

### Intro Splash Animation

```
Timeline:
0ms     — Layar hitam kosong
100ms   — Liquid blob muncul dari tengah (scale 0 → 1, opacity 0 → 0.8)
600ms   — Nama/initial letter muncul fade + slide up
1200ms  — Blob expand mengisi layar
1800ms  — Layar transition ke halaman utama (clip-path: circle expand)
2400ms  — Hero section muncul dengan stagger animation
```

```css
/* Intro overlay */
.intro-overlay {
  position: fixed;
  inset: 0;
  z-index: 9999;
  background: var(--bg-void);
  display: flex;
  align-items: center;
  justify-content: center;
  clip-path: circle(150% at 50% 50%);
  transition: clip-path 0.8s cubic-bezier(0.76, 0, 0.24, 1);
}

.intro-overlay.exit {
  clip-path: circle(0% at 50% 50%);
}
```

---

## 🧩 Component Library

### Button

```css
/* Primary Button */
.btn-primary {
  background: var(--accent-primary);
  color: var(--bg-void);
  font-family: var(--font-body);
  font-weight: 500;
  font-size: var(--text-sm);
  padding: 0.75rem 1.75rem;
  border-radius: 0.5rem;
  border: none;
  letter-spacing: 0.02em;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition: all 0.3s ease;
}

.btn-primary::before {
  content: '';
  position: absolute;
  inset: 0;
  background: white;
  opacity: 0;
  transition: opacity 0.2s ease;
}

.btn-primary:hover::before { opacity: 0.1; }
.btn-primary:hover { transform: translateY(-1px); box-shadow: 0 8px 24px var(--accent-glow); }

/* Ghost Button */
.btn-ghost {
  background: transparent;
  color: var(--text-primary);
  border: 1px solid var(--glass-border);
  padding: 0.75rem 1.75rem;
  border-radius: 0.5rem;
  font-family: var(--font-body);
  font-weight: 400;
  transition: all 0.3s ease;
}

.btn-ghost:hover {
  border-color: var(--accent-primary);
  color: var(--accent-primary);
}

/* Download CV Button — dengan ikon download */
.btn-download {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: var(--glass-bg);
  color: var(--accent-primary);
  border: 1px solid var(--accent-primary);
  padding: 0.75rem 1.75rem;
  border-radius: 0.5rem;
  backdrop-filter: blur(8px);
}

.btn-download:hover {
  background: rgba(0, 212, 255, 0.1);
  box-shadow: 0 0 20px var(--accent-glow);
}
```

### Navigation

```css
.navbar {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 100;
  padding: 1rem var(--container-padding);
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: rgba(8, 12, 20, 0.7);
  backdrop-filter: blur(20px);
  border-bottom: 1px solid var(--glass-border);
  transition: all 0.3s ease;
}

.nav-link {
  font-family: var(--font-body);
  font-weight: 500;
  font-size: var(--text-sm);
  color: var(--text-secondary);
  letter-spacing: 0.05em;
  text-transform: uppercase;
  transition: color 0.2s ease;
  position: relative;
}

.nav-link::after {
  content: '';
  position: absolute;
  bottom: -4px;
  left: 0;
  width: 0;
  height: 1px;
  background: var(--accent-primary);
  transition: width 0.3s ease;
}

.nav-link:hover { color: var(--text-primary); }
.nav-link:hover::after { width: 100%; }
.nav-link.active { color: var(--accent-primary); }
.nav-link.active::after { width: 100%; }
```

### Tech Icon Badge

```css
.tech-badge {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  padding: 1.25rem;
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: 0.75rem;
  transition: all 0.3s ease;
  cursor: default;
}

.tech-badge:hover {
  background: var(--glass-hover);
  border-color: rgba(0, 212, 255, 0.25);
  transform: translateY(-4px);
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3), 0 0 0 1px var(--glass-border);
}

.tech-badge img {
  width: 40px;
  height: 40px;
  object-fit: contain;
  filter: drop-shadow(0 0 8px rgba(255,255,255,0.1));
  transition: filter 0.3s ease;
}

.tech-badge:hover img {
  filter: drop-shadow(0 0 12px var(--accent-glow));
}

.tech-badge span {
  font-family: var(--font-mono);
  font-size: var(--text-xs);
  color: var(--text-secondary);
  letter-spacing: 0.05em;
}
```

### Project Card

```css
.project-card {
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  border-radius: 1rem;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
}

.project-card:hover {
  transform: translateY(-6px);
  border-color: rgba(0, 212, 255, 0.2);
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4),
              0 0 40px rgba(0, 212, 255, 0.05);
}

.project-card-image {
  width: 100%;
  aspect-ratio: 16/9;
  object-fit: cover;
  filter: brightness(0.8) saturate(0.9);
  transition: filter 0.4s ease;
}

.project-card:hover .project-card-image {
  filter: brightness(0.9) saturate(1.1);
}
```

### Contact Form

```css
.form-input {
  width: 100%;
  background: var(--bg-surface);
  border: 1px solid var(--glass-border);
  border-radius: 0.5rem;
  padding: 0.875rem 1rem;
  font-family: var(--font-body);
  font-size: var(--text-base);
  color: var(--text-primary);
  outline: none;
  transition: all 0.2s ease;
}

.form-input::placeholder { color: var(--text-muted); }

.form-input:focus {
  border-color: var(--accent-primary);
  box-shadow: 0 0 0 3px var(--accent-glow);
  background: var(--bg-elevated);
}
```

---

## ✨ Animation System

### Entrance Animations (Framer Motion)

```typescript
// Fade Up — standar untuk semua section entry
export const fadeUp = {
  initial: { opacity: 0, y: 30 },
  animate: { opacity: 1, y: 0 },
  transition: { duration: 0.6, ease: [0.23, 1, 0.32, 1] }
};

// Fade In — untuk elemen yang tidak perlu gerak
export const fadeIn = {
  initial: { opacity: 0 },
  animate: { opacity: 1 },
  transition: { duration: 0.5, ease: 'easeOut' }
};

// Scale Up — untuk cards, icons
export const scaleUp = {
  initial: { opacity: 0, scale: 0.9 },
  animate: { opacity: 1, scale: 1 },
  transition: { duration: 0.5, ease: [0.23, 1, 0.32, 1] }
};

// Stagger Container — untuk list items
export const staggerContainer = {
  animate: {
    transition: { staggerChildren: 0.08 }
  }
};

// Slide Right — untuk timeline experience
export const slideRight = {
  initial: { opacity: 0, x: -40 },
  animate: { opacity: 1, x: 0 },
  transition: { duration: 0.6, ease: [0.23, 1, 0.32, 1] }
};
```

### Hover Micro-interactions

```typescript
// Lift — untuk cards
export const liftHover = {
  whileHover: { y: -6, transition: { duration: 0.3 } },
  whileTap: { y: -2 }
};

// Glow Button — untuk CTA
export const glowHover = {
  whileHover: {
    boxShadow: '0 0 30px rgba(0, 212, 255, 0.4)',
    transition: { duration: 0.2 }
  }
};

// Tech Icon Bounce
export const iconBounce = {
  whileHover: {
    y: -8,
    rotate: [0, -5, 5, 0],
    transition: { duration: 0.4 }
  }
};
```

---

## 📱 Responsive Breakpoints

```css
/* Mobile First */
--bp-sm:  640px;    /* Small phones landscape */
--bp-md:  768px;    /* Tablets */
--bp-lg:  1024px;   /* Desktop */
--bp-xl:  1280px;   /* Large desktop */
--bp-2xl: 1536px;   /* Very large screens */
```

### Responsive Rules

| Element | Mobile | Tablet | Desktop |
|---|---|---|---|
| Hero font | 3xl | 5xl | 7xl |
| Grid skills | 3 cols | 4 cols | 6 cols |
| Grid projects | 1 col | 2 cols | 3 cols |
| Navbar | hamburger menu | hamburger | full links |
| Section padding | 4rem | 5rem | 8rem |

---

## 🎭 Page-Specific Design Notes

### Hero Section
- Nama tampil dengan gradient text (`--gradient-text`)
- Typing animation untuk subtitle/tagline
- Floating liquid blobs di background (position: absolute, z-index: 0)
- Konten di z-index: 1
- Scroll indicator di bagian bawah (animated arrow)

### About Section
- Layout 2-kolom: foto kiri, teks kanan (di mobile: stacked)
- Foto dengan border efek glow + liquid frame
- Timeline untuk Experience (vertikal line dengan dot nodes)
- Education card dengan glass style

### Skills Section
- Header section dengan label kategori: "Frontend", "Game Dev", "Design"
- Icon grid dengan stagger animation saat masuk viewport
- Gunakan devicons atau Simple Icons CDN untuk icon SVG
- Source icons: `https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/`

### GitHub Section
- Contribution graph: custom SVG grid atau library `react-activity-calendar`
- Stats cards: Total Commits, Public Repos, Current Streak
- Warna contribution: `#00D4FF` dengan opacity variasi (10%, 30%, 60%, 100%)

### Play (WebGL) Section
- Card game dengan hover: thumbnail zoom + overlay info muncul
- Click → modal/fullscreen iframe
- Loading state: animated liquid blob dengan text "Loading Game..."
- Tombol fullscreen di sudut kanan atas iframe

### Connect Section
- Social links sebagai ikon besar dengan hover glow effect masing-masing warna brand
  - Instagram: `#E1306C`
  - GitHub: `#FFFFFF`
  - LinkedIn: `#0077B5`
  - Email: `--accent-primary`
- Form: minimal, hanya Name, Email, Message + Submit
- Submit feedback: animasi success (checkmark liquid morph)

---

## 🔒 Admin Panel Design

### Konsep: Sama dengan portfolio tapi lebih functional
- Sidebar navigasi (Projects, Games, Settings)
- Tabel data dengan inline edit
- Form modal untuk tambah/edit
- Toast notifications untuk feedback aksi
- Dark theme konsisten dengan portfolio utama

---

## ♿ Accessibility Notes

- Minimum contrast ratio: 4.5:1 untuk text biasa, 3:1 untuk large text
- Semua interactive element punya `:focus-visible` style
- Animasi respek `prefers-reduced-motion`:
  ```css
  @media (prefers-reduced-motion: reduce) {
    .liquid-blob { animation: none; }
    * { transition-duration: 0.01ms !important; }
  }
  ```
- Semua gambar punya `alt` attribute
- Form fields punya `label` yang terhubung

---

## 📊 Performance Guidelines

- Gambar: gunakan Next.js `<Image />` dengan `priority` untuk hero image
- Fonts: gunakan `display: swap` dan preconnect ke Google Fonts
- Animasi blob: gunakan `will-change: transform` hanya saat diperlukan
- Unity WebGL: lazy load (hanya load saat user klik Play)
- Lazy load section yang tidak di-viewport menggunakan Framer Motion `whileInView`

---

## 🔄 Update Log

| Tanggal | Perubahan | Oleh |
|---|---|---|
| 2024-01-01 | Initial design system | Owner |
| — | — | — |

> Selalu update tabel ini setiap ada perubahan desain signifikan.
