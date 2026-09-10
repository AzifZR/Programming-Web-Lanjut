<?php
include 'koneksi.php';
$db = new database();
?>
<html lang="en" dir="ltr">
<head>
    <title align="center">CRUD OOP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h3 align="center">Data Mahasiswa</h3>
    <table border="1">
        <tr id="tabel">
            <td width="50px" align="center">No</td>
            <td width="200px" align="center">NIM</td>
            <td width="200px" align="center">Nama</td>
            <td width="300px" align="center">Alamat</td>
            <td width="200px" align="center">Telepon</td>
            <td align="center">Aksi</td>
        </tr>
        <?php
        $no = 1;
        foreach ($db->tampil_data() as $data) { ?>
        <tr>
            <td align="center"><?php echo $no++; ?></td>
            <td><?php echo $data['nim']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td><?php echo $data['telepon']; ?></td>
            <td>
                <a href="edit.php?nim=<?php echo $data['nim']; ?>&aksi=edit">Edit</a>
                <a href="proses.php?nim=<?php echo $data['nim']; ?>&aksi=hapus">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <form action="proses.php?aksi=tambah" method="post">
        <table>
            <div class="form-group">
                <label for="nama">NIM</label>
                <input type="text" class="form-control" name="nim" style="width:500px;">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" style="width:500px;">
            </div>
            <div class="form-group">
                <label for="nama">Alamat</label>
                <input type="text" class="form-control" name="alamat" style="width:500px;">
            </div>
            <div class="form-group">
                <label for="nama">Telepon</label>
                <input type="text" class="form-control" name="telepon" style="width:500px;">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </table>
    </form>
</div>
</body>
</html>
