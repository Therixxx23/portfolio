#!/bin/bash
# ============================================
# AUTO PUSH KE GITHUB — Gunakan setiap ada update
# ============================================
# Usage:
#   bash push.sh                    → pakai pesan otomatis
#   bash push.sh "fix: navbar bug"  → pesan custom

BRANCH="main"
TIMESTAMP=$(date '+%Y-%m-%d %H:%M:%S')

# Pesan commit: pakai argumen jika ada, atau otomatis
if [ -n "$1" ]; then
  COMMIT_MSG="$1"
else
  # Deteksi jenis perubahan otomatis
  ADDED=$(git diff --cached --name-only --diff-filter=A 2>/dev/null | wc -l)
  MODIFIED=$(git diff --cached --name-only --diff-filter=M 2>/dev/null | wc -l)
  DELETED=$(git diff --cached --name-only --diff-filter=D 2>/dev/null | wc -l)
  COMMIT_MSG="update: $TIMESTAMP"
fi

# Cek ada perubahan?
if git diff --quiet && git diff --staged --quiet; then
  echo "ℹ️  Tidak ada perubahan untuk di-push."
  exit 0
fi

# Tambah semua perubahan
git add .

# Tampilkan yang akan di-commit
echo "📦 File yang akan di-push:"
git diff --cached --name-status
echo ""

# Commit
git commit -m "$COMMIT_MSG"

# Push
echo "🚀 Pushing ke GitHub ($BRANCH)..."
git push origin $BRANCH

if [ $? -eq 0 ]; then
  echo ""
  echo "✅ Berhasil push ke GitHub!"
  echo "   Branch : $BRANCH"
  echo "   Commit : $COMMIT_MSG"
  echo "   Waktu  : $TIMESTAMP"
else
  echo ""
  echo "❌ Push gagal. Cek koneksi atau autentikasi GitHub."
  echo "   Tips: Pastikan sudah setup SSH key atau HTTPS token"
  echo "   GitHub Token: https://github.com/settings/tokens"
fi
