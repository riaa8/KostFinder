<h1 align="center">KostFinder</h1>
<h2 align="center">(Sistem Pencarian Kost Online)</h2>

<p align="center">
  <img src="/unsulbar_logo2_copy.jpg" width="300" alt="Logo Unsulbar">
</p>

<p align="center"><strong>Ria Ramadani</strong></p>
<p align="center">D0223014</p>
<p align="center"><strong>Framework Web Based</strong></p>
<p align="center">2025</p>


## **Role dan Fitur-fitur**

### **Admin**

* Menejemen User
* Melihat Laporan
* Menindak lanjuti review atau report

### **Pemilik Kost**

* Menambahkan kost baru
* Mengelola data kost (Update/hapus)
* Melihat review pengguna

### **Pencari Kost**

* Mencari kost berdasarkan filter
* Memberi review dan rating
* Menambahkan kost ke dalam favorit
* Melaporkan kost (jika perlu)

---

## **Tabel-Tabel Database**

### **Tabel User**

| Nama Field | Tipe Data    | Keterangan                    |
| ---------- | ------------ | ----------------------------- |
| Id         | BIGINT       | Primary key (Auto Increment)  |
| Name       | STRING       | Nama pengguna                 |
| Email      | STRING       | Email pengguna (unique)       |
| Password   | STRING       | Password terenkripsi          |
| No\_phone  | STRING       | Nomor HP pengguna             |
| Role       | ENUM         | 'admin', 'pemilik', 'pencari' |

### **Tabel Kosts**

| Nama Field        | Tipe Data    | Keterangan                               |
| ----------------- | ------------ | ---------------------------------------- |
| Id                | BIGINT       | Primary key                              |
| Name              | STRING       | Nama kost                                |
| Alamat            | STRING       | Alamat kost                              |
| Harga             | INTEGER      | Harga per bulan                          |
| Fasilitas         | STRING       | Fasilitas                                | 
| Gender            | ENUM         | Jenis kost berdasarkan gender penghuni   |
| Status            | ENUM         | Status kost (aktif, nonaktif, pending)   |
| Owner\_id         | BIGINT       | Foreign key ke tabel users               |
| Main\_Review\_id  | BIGINT       | FOreign key ke tabel Review (one to one) |


### **Tabel Favorites**

| Nama Field | Tipe Data | Keterangan                 |
| ---------- | --------- | -------------------------- |
| Id         | BIGINT    | Primary key                |
| User\_id   | BIGINT    | Foreign key ke tabel users |
| Kost\_id   | BIGINT    | Foreign key ke tabel kosts |

### **Tabel Reviews**

| Nama Field | Tipe Data    | Keterangan                 |
| ---------- | ------------ | -------------------------- |
| Id         | BIGINT       | Primary key                |
| User\_id   | BIGINT       | Foreign key ke tabel users |
| Kost\_id   | BIGINT       | Foreign key ke tabel kost  |
| Rating     | INTEGER      | Nilai rating               |
| Comment    | STRING       | Isi komentar               |

### **Tabel Report**

| Nama Field   | Tipe Data     | Keterangan                                |
| ------------ | ------------- | ----------------------------------------- |
| Id           | BIGINT        | Primary key                               |
| User\_id     | BIGINT        | Foreign key ke tabel users                |
| Kost\_id     | BIGINT        | Foreign key ke tabel kost                 |
| Report\_text | STRING        | Alasan laporan                            |
| Status       | ENUM          | Status laporan (pending, proses, selesai) |

---

## **Jenis Relasi dan Tabel yang Berelasi**

### **Relasi**


* **Users – Kost**
  One to Many (1 pemilik bisa punya banyak kost)

* **Users – Favorites – Kosts**
  Many to Many 

  * Satu user bisa menambahkan banyak kost ke favoritnya
  * Satu kost bisa difavoritkan oleh banyak user

* **Users – Reviews – Kosts**
  Many to Many 

  * Satu user bisa memberikan review ke banyak kost
  * Satu kost bisa memiliki review dari banyak user

* **Users – Reports – Kosts**
  Many to Many 

  * Satu user bisa melaporkan banyak kost
  * Satu kost bisa dilaporkan oleh banyak user

* **Kost – Review (Main Review)**
  One to One

  * Satu kost bisa memiliki satu review utama
  * Satu review hanya bisa menjadi review utama untuk satu kost



---
