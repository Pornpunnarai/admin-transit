<?php

$url = 'http://localhost/admin-transit/API/';
//$data = file_get_contents($url);
//
//echo $data;
////echo json_encode($characters);


$file = file_get_contents($url);
$only_body = preg_replace("/.*<body[^>]* >|<\/body>.*/si", "", $file);
echo $only_body;