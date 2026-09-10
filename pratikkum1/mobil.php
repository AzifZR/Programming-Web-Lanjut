<?php
class mobil{
var $jenis;
var $merk;
var $warna;

function hargaMobil(){
if ($this->jenis == 'SUV' && $this->merk == 'Honda' && $this->warna == 'merah')
echo 'Rp 400000000';
else echo 'Rp 150000000';
}
}

$mobil1 = new mobil();
$mobil1->jenis = 'SUV';
$mobil1->merk = 'Honda';
$mobil1->warna = 'merah';
echo $mobil1->hargaMobil();
echo "<br>";
$mobil2 = new mobil();
$mobil2->jenis = 'SUV';
$mobil2->merk = 'Toyota';
$mobil2->warna = 'putih';
echo $mobil2->hargaMobil();
?>
