###################
DosenKu - Platform Pembelajaran Online
###################

DosenKu adalah platform pembelajaran online yang dirancang khusus untuk memudahkan mahasiswa dalam mengakses materi perkuliahan kapanpun dan dimanapun. Aplikasi ini menyediakan akses ke berbagai materi kuliah dari berbagai jurusan yang terstruktur dengan baik.

*******************
Fitur Utama
*******************

- **Ruang Mata Kuliah**: Akses materi kuliah berdasarkan jurusan dan mata kuliah
- **Pencarian Materi**: Cari materi kuliah dengan mudah menggunakan fitur pencarian
- **Ruang Baca**: Akses artikel-artikel menarik seputar dunia pendidikan
- **Manajemen Konten**: Admin dapat mengelola jurusan, mata kuliah, materi, dan blog
- **Responsif**: Tampilan yang responsif untuk akses dari berbagai perangkat

**************************
Teknologi yang Digunakan
**************************

- PHP 7.x dengan framework CodeIgniter 3
- MySQL Database
- Bootstrap 5 untuk tampilan responsif
- Font Awesome untuk ikon
- jQuery dan JavaScript untuk interaktivitas
- AJAX untuk pengalaman pengguna yang lebih baik

*******************
Persyaratan Sistem
*******************

- PHP versi 7.3 atau lebih baru
- MySQL versi 5.7 atau lebih baru
- Web server (Apache/Nginx)
- Browser modern (Chrome, Firefox, Safari, Edge)

************
Instalasi
************

1. Clone repositori ini ke direktori web server Anda:
   ``git clone https://github.com/leaksopan/ProjectDosenku.git``

2. Buat database MySQL baru dan import file SQL yang disediakan di folder ``database``

3. Konfigurasi koneksi database di ``application/config/database.php``

4. Konfigurasi base URL di ``application/config/config.php``

5. Pastikan folder ``uploads`` memiliki izin tulis (777 atau rwxrwxrwx)

6. Akses aplikasi melalui browser: ``http://localhost/ProjectDosenku``

*******
Penggunaan
*******

1. **Login**
   - Admin: username ``admin``, password ``admin123``
   - Mahasiswa: Daftar akun baru atau gunakan akun demo ``mahasiswa``, password ``mahasiswa123``

2. **Menjelajahi Mata Kuliah**
   - Pilih jurusan dari dropdown menu
   - Pilih mata kuliah yang ingin dipelajari
   - Akses materi kuliah yang tersedia

3. **Mengelola Konten (Admin)**
   - Tambah/edit/hapus jurusan
   - Tambah/edit/hapus mata kuliah
   - Tambah/edit/hapus materi kuliah
   - Kelola artikel blog

*********
Struktur Proyek
*********

- ``application/`` - Kode aplikasi CodeIgniter
  - ``controllers/`` - Controller aplikasi
  - ``models/`` - Model database
  - ``views/`` - File tampilan
- ``assets/`` - File statis (CSS, JS, gambar)
- ``uploads/`` - Folder untuk file yang diunggah
- ``database/`` - File SQL untuk setup database

***************
Kontribusi
***************

Kontribusi untuk pengembangan DosenKu sangat diterima. Untuk berkontribusi:

1. Fork repositori
2. Buat branch fitur baru (``git checkout -b fitur-baru``)
3. Commit perubahan (``git commit -am 'Menambahkan fitur baru'``)
4. Push ke branch (``git push origin fitur-baru``)
5. Buat Pull Request

*******
Lisensi
*******

Proyek ini dilisensikan di bawah lisensi MIT - lihat file LICENSE untuk detail.

*********
Kontak
*********

Jika Anda memiliki pertanyaan atau saran, silakan hubungi:
- Email: [cipta5772@gmail.com]
- GitHub: [https://github.com/leaksopan]


