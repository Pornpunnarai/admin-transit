<?php
$url = 'http://www.cmtransit.com/API/station_fake/'; // path to your JSON file
$content = file_get_contents($url);
$json = json_decode($content, true);

echo json_encode($json);
?>