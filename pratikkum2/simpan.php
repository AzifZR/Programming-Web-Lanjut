<?php
include "koneksi.php";
$db = new database();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $kode_siswa = $_POST['kode_siswa'] ?? $_POST['nim'] ?? '';
    $nama_siswa = $_POST['nama_siswa'] ?? $_POST['nama'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $kota = $_POST['nama_kota'] ?? $_POST['kota'] ?? '';
    $kecamatan = $_POST['nama_kecamatan'] ?? $_POST['kecamatan'] ?? '';
    $kelurahan = $_POST['nama_kelurahan'] ?? $_POST['kelurahan'] ?? '';

    $saved = $db->input($kode_siswa, $nama_siswa, $alamat, $kota, $kecamatan, $kelurahan);

    // Cek apakah request berupa AJAX
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' || isset($_GET['ajax'])) {
        header('Content-Type: application/json');
        if ($saved) {
            echo json_encode(["status" => "success", "message" => "Data siswa berhasil disimpan ke database!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal menyimpan data siswa."]);
        }
        exit;
    }

    $redirect = !empty($_POST['redirect']) ? $_POST['redirect'] : 'tugas.php';
    header("Location: " . $redirect . "?pesan=berhasil");
    exit;
}
?>
