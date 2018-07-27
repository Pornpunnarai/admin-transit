<html>
<head>
</head>
<body>
<?php include 'connect-mysql.php';

$strSQL = "UPDATE driver_info SET ";
$strSQL .="id = '".$_POST["textid"]."' ";
$strSQL .=",firstname = '".$_POST["txtfirstname"]."' ";
$strSQL .=",lastname = '".$_POST["txtlastname"]."' ";
$strSQL .=",phone = '".$_POST["textphone"]."' ";
$strSQL .=",car_id = '".$_POST["textcar_id"]."' ";
$strSQL .=",nationnal_id = '".$_POST["textnationnal_id"]."' ";
$strSQL .=",licence_id = '".$_POST["textlicence_id"]."' ";
$strSQL .=",type = '".$_POST["texttype"]."' ";
$strSQL .="WHERE id = '".$_GET["ID"]."' ";
$objQuery = mysqli_query($objCon, $strSQL);
if($objQuery)
{
  echo "Save Done.";
//  print "<a href='http://chiangmaibus.org/driver/php/data.php?page=1'>Back to main page</a>";
    header('location: alldriver.php');
}
else
{
  echo "Error Save [".$strSQL."]";
}
//mysqli_close($objcon);
?>
</body>
</html>