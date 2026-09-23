<?php
header('Content-Type: application/json');

$id = $_GET['id'];
$url = "https://emsifa.github.io/api-wilayah-indonesia/api/villages/$id.json";
echo file_get_contents($url);
?>
