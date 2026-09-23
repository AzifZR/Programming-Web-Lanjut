<?php
class database {
    public $host = "localhost",
        $uname = "root",
        $pass = "",
        $db = "politeknik1",
        $connect;

    function __construct() {
        $conn = new mysqli($this->host, $this->uname, $this->pass);
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $conn->query("CREATE DATABASE IF NOT EXISTS " . $this->db);
        $conn->select_db($this->db);

        $tableQuery = "CREATE TABLE IF NOT EXISTS siswa (
            id INT AUTO_INCREMENT PRIMARY KEY,
            kode_siswa VARCHAR(50) NOT NULL,
            nama_siswa VARCHAR(255) NOT NULL,
            alamat TEXT,
            kota VARCHAR(100),
            kecamatan VARCHAR(100),
            kelurahan VARCHAR(100)
        )";
        $conn->query($tableQuery);

        $this->connect = $conn;
    }

    function tampil_data() {
        $data = "SELECT * FROM siswa ORDER BY id DESC";
        $hasil = $this->connect->query($data);
        $result = [];
        if ($hasil) {
            while ($d = mysqli_fetch_array($hasil)) {
                $result[] = $d;
            }
        }
        return $result;
    }

    function input($kode_siswa, $nama_siswa, $alamat, $kota, $kecamatan, $kelurahan) {
        $kode_siswa = $this->connect->real_escape_string($kode_siswa);
        $nama_siswa = $this->connect->real_escape_string($nama_siswa);
        $alamat = $this->connect->real_escape_string($alamat);
        $kota = $this->connect->real_escape_string($kota);
        $kecamatan = $this->connect->real_escape_string($kecamatan);
        $kelurahan = $this->connect->real_escape_string($kelurahan);

        $simpan = "INSERT INTO siswa (kode_siswa, nama_siswa, alamat, kota, kecamatan, kelurahan) 
                   VALUES ('$kode_siswa', '$nama_siswa', '$alamat', '$kota', '$kecamatan', '$kelurahan')";
        return $this->connect->query($simpan);
    }
}
?>
