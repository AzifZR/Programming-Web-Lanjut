<!DOCTYPE html>
<html>
<head>
    <title>Combobox Dinamis AJAX</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background:#f4f4f4;
            padding:40px;
        }
        .container{
            width:500px;
            background:white;
            padding:25px;
            border-radius:10px;
            box-shadow:0px 0px 10px rgba(0,0,0,.2);
            margin: auto;
        }
        h2{
            text-align:center;
            color: #888;
        }
        label{
            font-weight:bold;
        }
        select{
            width:100%;
            padding:10px;
            margin-top:5px;
            margin-bottom:20px;
            border-radius:5px;
            border:1px solid #ccc;
        }
        #hasil{
            background:#eef7ff;
            padding:15px;
            border-radius:8px;
            display:none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Wilayah Indonesia</h2>

        <label>Provinsi</label><br>
        <select id="provinsi">
            <option value="">-- Pilih Provinsi --</option>
        </select>
        <br><br>

        <label>Kabupaten / Kota</label><br>
        <select id="kota">
            <option value="">-- Pilih Kota --</option>
        </select>
        <br><br>

        <label>Kecamatan</label><br>
        <select id="kecamatan">
            <option value="">-- Pilih Kecamatan --</option>
        </select>
        <br><br>

        <label>Kelurahan</label><br>
        <select id="kelurahan">
            <option value="">-- Pilih Kelurahan --</option>
        </select>
        <br><br>

        <div id="hasil">
            <h3>Alamat Terpilih</h3>
            <p><b>Provinsi : </b><span id="textProvinsi"></span></p>
            <p><b>Kota : </b><span id="textKota"></span></p>
            <p><b>Kecamatan : </b><span id="textKecamatan"></span></p>
            <p><b>Kelurahan : </b><span id="textKelurahan"></span></p>
        </div>
    </div>

    <script>
    fetch("getProvinsi.php")
    .then(response => response.json())
    .then(data => {
        let provinsi = document.getElementById("provinsi");
        provinsi.innerHTML =
        "<option value=''>-- Pilih Provinsi --</option>";
        data.forEach(function(item){
            provinsi.innerHTML +=
            `<option value="${item.id}">
            ${item.name}
            </option>`;
        });
    });

    document.getElementById("provinsi")
    .addEventListener("change", function(){
        let idProvinsi = this.value;
        fetch("getKota.php?id="+idProvinsi)
        .then(response => response.json())
        .then(data => {
            let kota = document.getElementById("kota");
            kota.innerHTML =
            "<option value=''>-- Pilih Kota --</option>";
            data.forEach(function(item){
                kota.innerHTML +=
                `<option value="${item.id}">
                ${item.name}
                </option>`;
            });
        });
    });

    document.getElementById("kota")
    .addEventListener("change", function(){
        let idKota = this.value;
        fetch("getKecamatan.php?id="+idKota)
        .then(response => response.json())
        .then(data => {
            let kecamatan = document.getElementById("kecamatan");
            kecamatan.innerHTML =
            "<option value=''>-- Pilih Kecamatan --</option>";
            data.forEach(function(item){
                kecamatan.innerHTML +=
                `<option value="${item.id}">
                ${item.name}
                </option>`;
            });
        });
    });

    function resetKelurahan(){
        let kelurahan = document.getElementById("kelurahan");
        kelurahan.innerHTML = "<option value=''>-- Pilih Kelurahan --</option>";
    }

    //pilih kelurahan
    document.getElementById("kecamatan").addEventListener("change", function(){
        let idKecamatan = this.value;
        resetKelurahan();
        if(idKecamatan=="") return;
        fetch("getKelurahan.php?id="+idKecamatan)
        .then(response=>response.json())
        .then(data=>{
            let kelurahan = document.getElementById("kelurahan");
            kelurahan.innerHTML =
            "<option value=''>-- Pilih Kelurahan --</option>";
            data.forEach(item=>{
                kelurahan.innerHTML +=
                `<option value="${item.id}">
                ${item.name}
                </option>`;
            });
        });
    });

    // Cetak hasil pilihan
    document.getElementById("kelurahan").addEventListener("change", function(){
        document.getElementById("hasil").style.display="block";
        document.getElementById("textProvinsi").innerHTML =
        document.getElementById("provinsi").selectedOptions[0].text;
        document.getElementById("textKota").innerHTML =
        document.getElementById("kota").selectedOptions[0].text;
        document.getElementById("textKecamatan").innerHTML =
        document.getElementById("kecamatan").selectedOptions[0].text;
        document.getElementById("textKelurahan").innerHTML =
        document.getElementById("kelurahan").selectedOptions[0].text;
    });
    </script>
</body>
</html>
