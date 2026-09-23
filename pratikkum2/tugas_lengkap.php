<?php
include "koneksi.php";
$db = new database();
$data_siswa = $db->tampil_data();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tugas AJAX - Input Data (Lengkap)</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f9fa;
            padding: 30px 20px;
            color: #333;
        }
        .form-container {
            max-width: 650px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #222;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            font-weight: 500;
            margin-bottom: 6px;
            font-size: 14px;
        }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
            background: #fff;
        }
        input[type="text"]:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #007bff;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        .btn-submit {
            background-color: #007bff;
            color: white;
            padding: 11px 20px;
            border: none;
            border-radius: 4px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
        .alert {
            padding: 12px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }
        .table-container {
            max-width: 900px;
            margin: 40px auto 0;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #dee2e6;
        }
        th, td {
            padding: 10px 12px;
            text-align: left;
            font-size: 13px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Input Data</h2>

        <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'berhasil'): ?>
            <div class="alert">
                Data siswa berhasil disimpan ke dalam database!
            </div>
        <?php endif; ?>

        <form action="simpan.php" method="POST" id="formSiswa">
            <input type="hidden" name="redirect" value="tugas_lengkap.php">

            <div class="form-group">
                <label>Kode Siswa</label>
                <input type="text" name="kode_siswa" id="kode_siswa" placeholder="Masukkan kode siswa" required>
            </div>

            <div class="form-group">
                <label>Nama Siswa</label>
                <input type="text" name="nama_siswa" id="nama_siswa" placeholder="Masukkan nama siswa" required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" id="alamat" placeholder="Silakan isi alamat" required></textarea>
            </div>

            <div class="form-group">
                <label>Kota</label>
                <select name="kota" id="kota" required>
                    <option value="">-- Pilih Kota --</option>
                </select>
                <input type="hidden" name="nama_kota" id="nama_kota">
            </div>

            <div class="form-group">
                <label>Kecamatan</label>
                <select name="kecamatan" id="kecamatan" required>
                    <option value="">-- Pilih Kecamatan --</option>
                </select>
                <input type="hidden" name="nama_kecamatan" id="nama_kecamatan">
            </div>

            <div class="form-group">
                <label>Kelurahan</label>
                <select name="kelurahan" id="kelurahan" required>
                    <option value="">-- Pilih Kelurahan --</option>
                </select>
                <input type="hidden" name="nama_kelurahan" id="nama_kelurahan">
            </div>

            <button type="submit" class="btn-submit">Simpan Data</button>
        </form>
    </div>

    <div class="table-container">
        <h3 style="margin-top:0;">Daftar Data Siswa Tersimpan</h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Siswa</th>
                    <th>Nama Siswa</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th>Kecamatan</th>
                    <th>Kelurahan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data_siswa)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; color: #888;">Belum ada data siswa di database.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($data_siswa as $siswa): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($siswa['kode_siswa']); ?></td>
                            <td><?= htmlspecialchars($siswa['nama_siswa']); ?></td>
                            <td><?= htmlspecialchars($siswa['alamat']); ?></td>
                            <td><?= htmlspecialchars($siswa['kota'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($siswa['kecamatan'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($siswa['kelurahan'] ?? '-'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
    // 1. Ambil daftar kota (Default: Provinsi Jawa Timur / ID 35)
    fetch("getKota.php?id=35")
    .then(response => response.json())
    .then(data => {
        let kota = document.getElementById("kota");
        kota.innerHTML = "<option value=''>-- Pilih Kota --</option>";
        data.forEach(item => {
            kota.innerHTML += `<option value="${item.id}">${item.name}</option>`;
        });
    });

    // 2. Saat kota berubah, ambil daftar kecamatan
    document.getElementById("kota").addEventListener("change", function(){
        let idKota = this.value;
        let namaKota = this.selectedOptions[0] && this.value !== "" ? this.selectedOptions[0].text : "";
        document.getElementById("nama_kota").value = namaKota;

        let kecamatan = document.getElementById("kecamatan");
        kecamatan.innerHTML = "<option value=''>-- Pilih Kecamatan --</option>";
        resetKelurahan();

        if (idKota === "") return;

        fetch("getKecamatan.php?id=" + idKota)
        .then(response => response.json())
        .then(data => {
            data.forEach(item => {
                kecamatan.innerHTML += `<option value="${item.id}">${item.name}</option>`;
            });
        });
    });

    function resetKelurahan(){
        let kelurahan = document.getElementById("kelurahan");
        kelurahan.innerHTML = "<option value=''>-- Pilih Kelurahan --</option>";
        document.getElementById("nama_kelurahan").value = "";
    }

    // 3. Saat kecamatan berubah, ambil daftar kelurahan
    document.getElementById("kecamatan").addEventListener("change", function(){
        let idKecamatan = this.value;
        let namaKecamatan = this.selectedOptions[0] && this.value !== "" ? this.selectedOptions[0].text : "";
        document.getElementById("nama_kecamatan").value = namaKecamatan;

        resetKelurahan();
        if (idKecamatan === "") return;

        fetch("getKelurahan.php?id=" + idKecamatan)
        .then(response => response.json())
        .then(data => {
            let kelurahan = document.getElementById("kelurahan");
            data.forEach(item => {
                kelurahan.innerHTML += `<option value="${item.id}">${item.name}</option>`;
            });
        });
    });

    // 4. Saat kelurahan berubah, simpan nama kelurahan terpilih
    document.getElementById("kelurahan").addEventListener("change", function(){
        let namaKelurahan = this.selectedOptions[0] && this.value !== "" ? this.selectedOptions[0].text : "";
        document.getElementById("nama_kelurahan").value = namaKelurahan;
    });
    </script>
</body>
</html>
