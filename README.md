# 🎓 Web Pendaftaran ARMASO

Aplikasi pendaftaran lomba berbasis Laravel. Dirancang khusus untuk memudahkan proses pendaftaran, verifikasi, manajemen pembayaran, dan cetak kartu peserta dalam satu sistem yang terintegrasi dan fleksibel.

---

## 🚀 Fitur Unggulan

### ✅ Pendaftaran Peserta
- Registrasi akun & login peserta
- Pengisian data diri lengkap (Nama, NISN, TTL, Sekolah, dll)
- Memilih lebih dari satu mapel lomba (IPA, IPS, MTK)

### 🔢 Nomor Peserta Otomatis
- Nomor peserta dibuat otomatis saat data diisi
- Format dinamis, misal: `ARMASO250001`, `NAMAWEB250002` (mengikuti nama web global)

### 💸 Sistem Pembayaran & Tagihan
- Perhitungan tagihan otomatis berdasarkan jumlah mapel
- Khusus pendaftar **online** wajib upload bukti pembayaran
- Admin bisa memverifikasi pembayaran langsung dari dashboard

### 📄 Cetak Kartu & QR Code
- Kartu peserta dalam format PDF siap cetak
- Dilengkapi QR code yang hanya bisa di-scan melalui domain resmi
- QR mengarah ke halaman khusus data peserta **tanpa login**

### 🧠 Guest vs User Experience
- **User Login (Peserta)**: Lihat status data, status pembayaran, cetak kartu
- **Guest**: Hanya melihat informasi umum lomba

### 🛠️ Admin Panel Lengkap
- Verifikasi data peserta
- Kelola tagihan & bukti bayar
- **Aktifkan/Nonaktifkan pendaftaran** dari dashboard
- **Aktifkan mode maintenance** tanpa mengubah kode
- Kelola mapel lomba dan pengaturan global branding

### 📤📥 Export / Import Excel
- Export data peserta dengan filter:
  - Jenis pendaftaran (Online, Offline, Kolektif)
  - Status verifikasi
  - Mapel lomba
- Import data peserta secara massal dari file Excel

### 🌐 Konfigurasi Multi Web
- Web branding & pendaftaran bisa dipisah (domain/subdomain berbeda)
- Pengaturan nama web dan domain fleksibel dari satu tempat

---
