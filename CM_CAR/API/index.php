<?php
$url = 'http://183.90.168.61/cmcar/';
$content = file_get_contents($url);
$json = json_decode($content, true);

echo json_encode($json);

