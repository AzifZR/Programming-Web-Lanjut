CREATE DATABASE IF NOT EXISTS politeknik;
USE politeknik;

CREATE TABLE IF NOT EXISTS mahasiswa (
    nim INT(12) PRIMARY KEY,
    nama VARCHAR(255),
    alamat VARCHAR(255),
    telepon VARCHAR(15)
);
