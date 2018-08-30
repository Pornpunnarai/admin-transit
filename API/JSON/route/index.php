<?php
$url = 'http://www.cmtransit.com/API/route/'; // path to your JSON file
$content = file_get_contents($url);
$json = json_decode($content, true);

echo json_encode($json);
?>