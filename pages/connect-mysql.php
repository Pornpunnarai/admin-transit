<?php
$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "driver";


$objCon = mysqli_connect($serverName,$username,$password,$dbName);

if(!$objCon){
    $serverName = "localhost";
    $username = "root";
    $password = "1q2w3e4r";
    $dbName = "driver";
    $objCon = mysqli_connect($serverName,$username,$password,$dbName);
}


mysqli_set_charset($objCon,"utf8");


?>