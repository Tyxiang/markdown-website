<?php
include "heading-array.php";
$path = "index.html";
$html = file_get_contents($path);
$array = heading_parse($html);
header('Content-type: application/json');
echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
//var_dump($array);