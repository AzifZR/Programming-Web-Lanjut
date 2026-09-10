<?php
class buku{
public $judul;
private $harga;
protected $penerbit;

function __construct($x, $y, $z){
$this->judul=$x;
$this->harga=$y;
$this->penerbit=$z;
}

function cetakBuku(){
return "Cetak sebuah buku";
}

function bacaJudul()
{
return $this->judul;
}

function bacaHarga()
{
return $this->harga;
}
function bacaPenerbit()
{
return $this->penerbit;
}
}

$buku1 = new buku('Belajar PHP', 2000000, 'Erlangga');
echo 'Nama judul: ' . $buku1->judul;
echo "<br>";

echo 'Harga: ' . $buku1->bacaHarga();
echo "<br>";

echo 'Penerbit: ' . $buku1->bacaPenerbit();
?>
