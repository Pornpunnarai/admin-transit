<?php
include ('connect-mysql.php');





//
//
//$sql = "SELECT * FROM `file_list` WHERE  `content_list_id` = '".$content_list_id."' AND `status` = 'Pre-Add' OR `status` = 'Delete'";
//$objQuery = mysqli_query($objCon, $sql);
//$result = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);

$station_table = $_POST["station_table"];
$route_table = $_POST["route_table"];
$route_cal = $_POST["route_cal"];
//station
foreach ($station_table as $value) {


    $sql = "UPDATE `station` SET `point_lat`='".$value["point_lat"]."',`point_lng`= '".$value["point_lng"]."' WHERE `id` = '".$value["station_id"]."'";
    $objQuery = mysqli_query($objCon, $sql);


}


foreach ($route_table as $value) {

$sql = "INSERT INTO `route`(`lat`, `lng`, `station_start`, `station_end`, `type`) VALUES ('".$value["lat"]."','".$value["lng"]."','".$value["station_start"]."',
'".$value["station_end"]."','".$value["type"]."')";
    $objQuery = mysqli_query($objCon, $sql);
}

foreach ($route_cal as $value) {


    $sql2 = "SELECT `id` FROM `route_name` WHERE  `route_code` = '".$value["route_type"]."' ";
$objQuery2 = mysqli_query($objCon, $sql2);
$result = mysqli_fetch_array($objQuery2, MYSQLI_ASSOC);


    $sql = "INSERT INTO `route_calculate`(`route_id`, `route_type`, `station_id_start`,
 `station_name_start`, `station_id_dest`, `station_name_dest`, `section_start`,
  `section_end`, `section_all`, `lat_start`, `lat_dest`, `lng_dest`, `lng_start`,
   `direction`,`distance`) VALUES ('".$result["id"]."','".$value["route_type"]."','".$value["station_id_start"]."',
   '".$value["station_name_start"]."','".$value["station_id_dest"]."','".$value["station_name_dest"]."','".$value["section_start"]."',
   '".$value["section_end"]."','".$value["section_all"]."','".$value["lat_start"]."','".$value["lat_dest"]."'
   ,'".$value["lng_dest"]."','".$value["lng_start"]."','".$value["direction"]."','".$value["distance"]."')";
    $objQuery = mysqli_query($objCon, $sql);
echo $sql2;

}