<?php
header("Content-Type: application/json");

$data = [
    "nama" => "Andi",
    "nim" => "2341760001",
    "prodi" => "Manajemen Informatika"
];

echo json_encode($data);
?>
