<?php
$url = 'http://localhost/admin-transit/API/';
$data = file_get_contents($url);
//$characters = json_decode($data);
$text = (string)$data;

echo $text;
?>