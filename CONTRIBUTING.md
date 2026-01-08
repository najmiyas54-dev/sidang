# Panduan Kontribusi

## Workflow Git
1. **Clone repository**
   ```bash
   git clone [URL_REPO]
   cd sidang
   ```

2. **Buat branch baru untuk setiap fitur**
   ```bash
   git checkout -b feature/nama-fitur
   ```

3. **Commit dengan pesan yang jelas**
   ```bash
   git add .
   git commit -m "feat: tambah fitur login"
   ```

4. **Push dan buat Pull Request**
   ```bash
   git push origin feature/nama-fitur
   ```

## Aturan Commit
- `feat:` untuk fitur baru
- `fix:` untuk bug fix
- `docs:` untuk dokumentasi
- `style:` untuk formatting
- `refactor:` untuk refactoring code
- `test:` untuk testing

## Code Review
- Setiap PR harus di-review oleh partner
- Pastikan code berjalan tanpa error
- Tulis komentar yang konstruktif