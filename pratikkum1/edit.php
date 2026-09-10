<?php
include 'koneksi.php';
$db = new database();
?>
<?php
foreach ($db->edit($_GET['nim']) as $data) {
?>
<html lang="en" dir="ltr">
<head>
    <title align="center">CRUD OOP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h3 align="center">Edit Data Mahasiswa</h3>
    <form action="proses.php?aksi=update" method="post">
        <table>
            <div class="form-group">
                <label for="nama">NIM</label>
                <input type="text" class="form-control" name="nim" style="width:500px;" value="<?php echo $data['nim'] ?>">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" style="width:500px;" value="<?php echo $data['nama'] ?>">
            </div>
            <div class="form-group">
                <label for="nama">Alamat</label>
                <input type="text" class="form-control" name="alamat" style="width:500px;" value="<?php echo $data['alamat'] ?>">
            </div>
            <div class="form-group">
                <label for="nama">Telepon</label>
                <input type="text" class="form-control" name="telepon" style="width:500px;" value="<?php echo $data['telepon'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </table>
        <?php } ?>
    </form>
</div>
</body>
</html>