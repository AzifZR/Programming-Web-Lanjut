<!DOCTYPE html>
<html>
<head>
    <title>Input Data</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background: #fff;
            padding: 40px;
            color: #333;
        }
        .form-container {
            max-width: 650px;
            margin: 0 auto;
        }
        h3 {
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 25px;
            color: #222;
        }
        .form-group {
            margin-bottom: 12px;
        }
        label {
            display: block;
            font-size: 13px;
            color: #333;
            margin-bottom: 5px;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: 13px;
            box-sizing: border-box;
            background: #fff;
            color: #444;
        }
        input[type="text"]::placeholder, textarea::placeholder {
            color: #888;
        }
        input[type="text"]:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #aaa;
        }
        .alamat-wrapper {
            display: flex;
            align-items: flex-end;
            margin-bottom: 12px;
        }
        .alamat-wrapper label {
            margin-right: 15px;
            margin-bottom: 2px;
            display: inline-block;
        }
        .alamat-wrapper textarea {
            width: 330px;
            height: 145px;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-family: inherit;
            font-size: 13px;
            box-sizing: border-box;
        }
        .btn-submit {
            background-color: #007bff;
            color: white;
            padding: 9px 18px;
            border: none;
            border-radius: 4px;
            font-size: 13px;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
        }
        .btn-submit:hover {
            background-color: #0069d9;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h3>Input Data</h3>

        <form action="simpan.php" method="POST" id="formSiswa">
            <input type="hidden" name="redirect" value="tugas.php">

            <div class="form-group">
                <label>Kode Siswa</label>
                <input type="text" name="kode_siswa" id="kode_siswa" placeholder="Masukkan kode siswa" required>
            </div>

            <div class="form-group">
                <label>Nama Siswa</label>
                <input type="text" name="nama_siswa" id="nama_siswa" placeholder="Masukkan nama siswa" required>
            </div>

            <div class="alamat-wrapper">
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

            <button type="submit" class="btn-submit">Simpan</button>
        </form>
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
