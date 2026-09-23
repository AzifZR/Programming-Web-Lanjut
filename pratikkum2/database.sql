CREATE DATABASE IF NOT EXISTS politeknik1;
USE politeknik1;

CREATE TABLE IF NOT EXISTS siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_siswa VARCHAR(50) NOT NULL,
    nama_siswa VARCHAR(255) NOT NULL,
    alamat TEXT,
    kota VARCHAR(100),
    kecamatan VARCHAR(100),
    kelurahan VARCHAR(100)
);
