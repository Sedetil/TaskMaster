# 📝 To-Do List App

Aplikasi **To-Do List** berbasis Laravel 11 untuk membantu pengguna mengelola tugas harian dengan mudah dan efisien.

---

## 🎯 Fitur Utama

✅ **Registrasi & Login**\
✅ **Menambahkan tugas baru**\
✅ **Mengedit nama tugas**\
✅ **Mengubah status tugas (Pending/Completed)**\
✅ **Menghapus tugas**\
✅ **Melihat riwayat semua tugas**\
✅ **Menampilkan tanggal & waktu tugas dalam format WIB**\
✅ **Landing page yang menarik**

---

## 🛠️ Teknologi yang Digunakan

- **Laravel 11** - Framework PHP modern dan cepat
- **Bootstrap 5** - Untuk tampilan yang responsif & elegan
- **Blade Template** - Layout yang rapi dan modular
- **MySQL** - Database untuk menyimpan daftar tugas
- **Carbon** - Mengelola format tanggal & waktu
- **SweetAlert (Opsional)** - Untuk notifikasi yang lebih interaktif

---

## 🔧 Cara Instalasi

1️⃣ **Clone Repository**

```sh
git clone https://github.com/Sedetil/TaskMaster.git
cd todolist
```

2️⃣ **Install Dependency**

```sh
composer install
```

3️⃣ **Buat file **``** dan atur konfigurasi database**

```sh
cp .env.example .env
```

Kemudian edit file `.env` dan sesuaikan database:

```
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

4️⃣ **Generate Key & Jalankan Migrasi Database**

```sh
php artisan key:generate
php artisan migrate
php artisan storage:link
```

5️⃣ **Jalankan Server Laravel**

```sh
php artisan serve
```

Akses aplikasi di `` 🎉

---

## 🎨 Tampilan Aplikasi

### **🔹 Landing Page**



### **🔹 Dashboard To-Do List**



### **🔹 Halaman Riwayat**



---

## 🏆 Kontribusi

🔥 Ingin berkontribusi? Silakan buat **Pull Request** atau **Issue**!\
Terima kasih telah menggunakan **To-Do List App** ini! 🙌

---

## 🐝 Dibuat oleh

Aplikasi ini dibuat dengan ❤️ oleh **Alwan Nabil Priyanto**. Bebas digunakan untuk keperluan pribadi maupun edukasi. 🚀

