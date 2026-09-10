<?php
class Kendaraan {
    public $nama;
    protected $kecepatan = 0;
    private $nomorRangka;

    function __construct($nama, $nomorRangka) {
        $this->nama = $nama;
        $this->nomorRangka = $nomorRangka;
    }

    function tambahKecepatan($km) {
        $this->kecepatan += $km;
    }

    function getNomorRangka() {
        return $this->nomorRangka;
    }

    function getKecepatan() {
        return $this->kecepatan;
    }
}


class Mobil extends Kendaraan {
    public $jumlahPintu;

    function klakson() {
        return "Tin tin!";
    }
}

$mobil = new Mobil("Toyota Avanza", "MH12345678");
$mobil->jumlahPintu = 4;

echo "<h3>Data Mobil</h3>";
echo $mobil->nama . ": " . $mobil->klakson() . "<br>";
$mobil->tambahKecepatan(50);
$mobil->tambahKecepatan(20);
echo "Nama Mobil: " . $mobil->nama . "<br>";
echo "Jumlah Pintu: " . $mobil->jumlahPintu . "<br>";
echo "Kecepatan Saat Ini: " . $mobil->getKecepatan() . " km/jam<br>";
echo "Nomor Rangka: " . $mobil->getNomorRangka() . "<br>";
?>
