<?php
header("Content-Type: application/json");

$id = $_GET['id'];
echo file_get_contents("https://emsifa.github.io/api-wilayah-indonesia/api/regencies/$id.json");
?>
