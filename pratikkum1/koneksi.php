<?php
class database {
    public $host = "localhost",
        $uname = "root",
        $pass = "",
        $db = "politeknik",
        $connect;

    function __construct() {
        $this->connect = new mysqli($this->host, $this->uname, $this->pass, $this->db);
        if ($this->connect->connect_errno) {
            echo "Database Tidak Ada...!";
            exit;
        }
    }

    function tampil_data() {
        $data = "select * from mahasiswa";
        $hasil = $this->connect->query($data);
        $result = [];
        while ($d = mysqli_fetch_array($hasil)) {
            $result[] = $d;
        }
        return $result;
    }

    function input($nama, $nim, $alamat, $telepon) {
        $simpan = "insert into mahasiswa values('$nim','$nama','$alamat','$telepon')";
        $hasil = $this->connect->query($simpan);
    }

    function delete($nim) {
        $simpan = "delete from mahasiswa where nim = '$nim'";
        $hasil = $this->connect->query($simpan);
    }

    function edit($nim) {
        $data = "select * from mahasiswa where nim='$nim'";
        $hasil = $this->connect->query($data);
        $result = [];
        while ($d = mysqli_fetch_array($hasil)) {
            $result[] = $d;
        }
        return $result;
    }

    function update($nim, $nama, $alamat, $telepon) {
        $simpan = "update mahasiswa set nim ='$nim', nama ='$nama', alamat = '$alamat', telepon = '$telepon' where nim = '$nim'";
        $hasil = $this->connect->query($simpan);
        //return "Masuk Update";
    }
}
?>
