<!DOCTYPE html>
<html>
<head>
    <title>Latihan AJAX Sederhana</title>
</head>
<body>
    <h2>Latihan AJAX</h2>
    <button onclick="ambilData()">
        Ambil Data Mahasiswa
    </button>
    <hr>
    <div id="hasil">
        Data belum diambil...
    </div>
    <script>
    function ambilData() {
        fetch("data.php")
        .then(response => response.json())
        .then(data => {
            console.log(data);
            document.getElementById("hasil").innerHTML =
                "<h3>Data Mahasiswa</h3>" +
                "Nama : " + data.nama + "<br>" +
                "NIM : " + data.nim + "<br>" +
                "Prodi : " + data.prodi;
        })
        .catch(error => {
            console.log(error);
        });
    }
    </script>
</body>
</html>
