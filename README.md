# Sistem Informasi Pelanggaran & Pembinaan Siswa
Project UAS – Sistem Pengembangan Backend

## Tentang Project Ini
Sistem Informasi Pelanggaran dan Pembinaan Siswa adalah aplikasi backend berbasis PHP
yang digunakan untuk mencatat pelanggaran siswa, memberikan pembinaan, serta
menyediakan laporan poin pelanggaran untuk kebutuhan monitoring sekolah.
Aplikasi ini tidak menggunakan antarmuka frontend dan seluruh proses dilakukan
melalui API menggunakan Thunder Client atau Postman.

## Tools 
- PHP 8+
- MySQL
- Composer
- Firebase PHP-JWT (Library Eksternal)
- XAMPP
- Thunder Client / Postman

## Entitas Database
- users
- roles
- siswa
- pelanggaran
- pembinaan

## Role & Hak Akses (RBAC)
| admin | Login, melihat data user, pelanggaran, pembinaan, dan laporan |
| guru_bk | Login, input dan update pelanggaran serta pembinaan |
| kepala_sekolah | Login dan melihat laporan saja |

## Authentication
POST /index.php/login
Body JSON: {
  "email": "admin@sekolah.com",
  "password": "admin123"
}

POST /index.php/logout (untuk logout)

## Siswa (Read Only)
GET /index.php/siswa

## Get siswa by ID
GET /index.php/siswa/{id}

## Pelanggaran
GET /index.php/pelanggaran

#Tambah Pelanggaran
POST /index.php/pelanggaran
Body Json: {
  "siswa_id": ,
  "guru_id": ,
  "jenis_pelanggaran": "",
  "poin": ,
  "tanggal": ""
}

## Update Pelanggaran
PUT /index.php/pelanggaran/{id}
Body JSON: Body Json: {
  "siswa_id": ,
  "guru_id": ,
  "jenis_pelanggaran": "",
  "poin": ,
  "tanggal": ""
}

## Delete Pelanggaran
DELETE /index.php/pelanggaran/{id}

## Pembinaan
GET /index.php/pembinaan

## Tambah Pembinaan
POST /index.php/pembinaan
Body JSON: {
  "pelanggaran_id": ,
  "tindakan": "",
  "keterangan": "",
  "tanggal": ""
}

## Update Pembinaan
PUT /index.php/pembinaan/{id}
Body Json:  {
  "pelanggaran_id": ,
  "tindakan": "",
  "keterangan": "",
  "tanggal": ""
}

## Delete Pembinaan
DELETE /index.php/pembinaan/{id}

## Laporan 
GET /index.php/laporan/poin-siswa

## Users (Admin Only)
GET /index.php/users







