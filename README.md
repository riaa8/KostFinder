<h1 align="center">KostFinder</h1>
<h2 align="center">(Sistem Pencarian Kost Online)</h2>

<p align="center">
  <img src="/unsulbar_logo2_copy.jpg" width="300" alt="Logo Unsulbar">
</p>

<p align="center"><strong>Ria Ramadani</strong></p>
<p align="center">D0223014</p>
<p align="center"><strong>Framework Web Based</strong></p>
<p align="center">2025</p>


## 📌 Deskripsi Singkat

**KostFinder** adalah sistem informasi berbasis web yang membantu pencari kost menemukan tempat tinggal ideal berdasarkan harga, fasilitas, dan alamat. Aplikasi ini memfasilitasi pencari kost untuk menelusuri pilihan kost yang tersedia, dan pemilik kost untuk mempromosikan properti mereka. Admin bertugas memastikan seluruh data tetap valid dan terpercaya.

---
## 👥 Role & Fitur-fitur

### 1. Admin
**Fitur :**

* Melihat semua data pengguna, kost, review
* Menghapus atau memperbarui data kost
* Mengelola akun pengguna
* Memoderasi komentar atau riview

### 2. Pemilik Kost
**Fitur :**

* Registrasi dan login
* Mengelola data kost (Menambah, mengedit dan menghapus)
* Mengelola data fasilitas dan alamat kost
* Melihat review dari pengguna terhadap kost mereka

### 3. Pencari Kost
**Fitur :**

* Registrasi dan login
* Menelusuri dan memfilter kost
* Melihat detail kost, fasilitas, dan alamat
* Memberikan review dan rating
* Menghubungi pemilik via nomor telepon

#### 🔒 Ringkasan Hak Akses

| Fitur                                      | Admi    | Pemilik Kost   | Pencari Kost      |
|--------------------------------------------|---------|----------------|-------------------|
| Login & Register                           | ✅      | ✅            | ✅                |
| Lihat daftar kost                          | ✅      | ✅            | ✅                |
| Tambah / Edit / Hapus kost                 | ❌      | ✅            | ❌                |
| Lihat & Kelola review                      | ✅      | ✅ (lihat)    | ✅ (beri ulasan)  |
| Kelola data pengguna                       | ✅      | ❌            | ❌                |
| Tambah fasilitas & alamat kost             | ❌      | ✅            | ❌                |
| Hubungi pemilik melalui nomor telepon      | ❌      | ❌            | ✅                |


---

## **Tabel-Tabel Database**

### **Tabel Pengguna**

| Nama Field    | Tipe Data    | Keterangan                    |
| ------------- | ------------ | ----------------------------- |
| Id            | INT(PK)      | Primary key (Auto Increment)  |
| Nama          | VARCHAR      | Nama pengguna                 |
| Email         | VARCHAR      | Email pengguna (unique)       |
| Kata\_sandi   | VARCHAR      | Password terenkripsi          |
| Role          | ENUM         | 'admin', 'pemilik', 'pencari' |
| No\_phone     | VARCHAR      | Nomor HP pengguna             |
| Created_at    | TIMESTAMP    | Tanggal registrasi pengguna   |


### **Tabel Kosts**

| Nama Field        | Tipe Data    | Keterangan                               |
| ----------------- | ------------ | ---------------------------------------- |
| Id                | INT(PK)      | Primary key                              |
| Nama              | VARCHAR      | Nama kost                                |
| Deskripsi         | VARCHAR      | Deskripsi kost (fasilitas, aturan)       |
| Harga_per_bulan   | DECIMAL      | Harga sewa per bulan                     |
| Url_gambar        | VARCHAR      | URL gambar kost                          | 
| Gender            | ENUM         | Jenis kost berdasarkan gender penghuni   |
| id_pemilik        | INT(FK)      | Foreign key ke tabel pengguna            |
| created_at        | TIMRSTAMP    | Tanggal kost ditambahkan                 |



### **Tabel Fasilitas**

| Nama Field       | Tipe Data | Keterangan                               |
| ---------------- | --------- | ---------------------------------------- |
| Id               | INT(PK)   | Primary key                              |
| Nama_fasilitas   | VARCHAR   | Nama fasilitas (misalnya: wifi, AC, dll) |
| Created_at       | BIGINT    | Tanggal fasilitas ditambahkan            |


### **Tabel Kost_Fasilitas**

| Nama Field   | Tipe Data     | Keterangan                                |
| ------------ | ------------- | ----------------------------------------- |
| Id           | INT (PK)      | Primary key                               |
| Id_kost      | INT (FK)      | Foreign key ke tabel kost                 |
| ID_fasilitas | INT (FK)      | Foreign key ke tabel fasilitas            |
| Created_at   | TIMESTAMP     | Tanggal hubungan ditambahkan              |

### **Tabel Alamat**

| Nama Field   | Tipe Data     | Keterangan                                |
| ------------ | ------------- | ----------------------------------------- |
| Id_kost      | INT (PK, FK)  | ID kost (kost.id, kunci utama)            |
| Jalan        | VARCHAR       | Nama Jalan                                |
| Kota         | VARCHAR       | Nama kota                                 |
| Provinsi     | VARCHAR       | Nama provinsi                             |
| Kode_pos     | VARCHAR       | Kode pos                                  |
| Created_at   | TIMESTAMP     | Tanggal hubungan ditambahkan              |


### **Tabel Review**

| Nama Field  | Tipe Data    | Keterangan                    |
| ----------- | ------------ | ----------------------------- |
| Id          | INT          | Primary key                   |
| Id_kost     | INT          | Foreign key ke tabel kost     |
| Id_pengguna | INT          | Foreign key ke tabel pengguna |
| Rating      | INT          | Nilai rating (1-5)            |
| Komentar    | STRING       | Komentar ulasan (opsional)    |
| created_at  | TIMESTAMP    | Tanggal ulasan ditambahkan    |



---

## **Jenis Relasi dan Tabel yang Berelasi**

### **Relasi**


1. **Pengguna – Kost**
   - One-to-Many: satu pemilik bisa punya banyak kost.
   - `pengguna.id → kost.id_pemilik`

2. **Kost – Fasilitas**  (melalui `kost_fasilitas`)
   - Many-to-Many: satu kost bisa punya banyak fasilitas, dan sebaliknya.
   - `kost.id → kost_fasilitas.id_kost`
   - `fasilitas.id → kost_fasilitas.id_fasilitas`

3. **kost ↔ alamat**
   - One-to-One: satu kost hanya memiliki satu alamat.
   - `kost.id → alamat.id_kost`

4. **kost ↔ review**
   - One-to-Many: satu kost bisa memiliki banyak review.
   - `kost.id → review.id_kost`

5. **pengguna ↔ review**
   - One-to-Many: satu pengguna dapat memberikan banyak review.
   - `pengguna.id → review.id_pengguna`

---

## 📎 Catatan Tambahan

- Kata sandi pengguna dienkripsi menggunakan hashing (misal bcrypt).
- Sistem tidak mencakup fitur pembayaran atau booking online.
- Validasi data dilakukan di sisi server untuk menjaga keamanan dan integritas data.

---
