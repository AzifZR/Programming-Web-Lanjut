<?php
header("Content-Type: application/json");

$data = file_get_contents("https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json");

echo $data;
?>
