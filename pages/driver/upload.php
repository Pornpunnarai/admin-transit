 <?php include 'connect-mysql.php';

$sql = "SELECT MAX(id) AS id FROM driver_info";
$query=mysqli_query($objCon,$sql);
$result=mysqli_fetch_array($query,MYSQLI_ASSOC);

$highest_id = $result['id']+1;

$firstname=trim($_POST['txtFirstname']);
$lastname=trim($_POST['txtLastname']);
$phone=trim($_POST['txtPhone']);
$car_id=trim($_POST['txtCar_id']);
$nationnal_id=trim($_POST['txtNational_id']);
$licence_id=trim($_POST['txtLicense_id']);
$type=trim($_POST['txtType']);


 $sql = "insert into `driver_info`(id,firstname,lastname,phone,car_id,nationnal_id,licence_id,type) values('$highest_id', '$firstname', '$lastname', '$phone', '$car_id', '$nationnal_id', '$licence_id','$type')";
 $query = mysqli_query($objCon,$sql);
//mysqli_query("");

$Str_file = explode(".",$_FILES['fileUpload']['name']);
$new_name= $highest_id.".".$Str_file['1'];
//echo $new_name."<br>";

if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"],"./img/".$new_name))
{
    echo $highest_id."<br>";
	header("Location: show.php?id=".$highest_id); /* Redirect browser */
//    header("Location: http://chiangmaibus.org/driver/php/show.php?id=".$highest_id); /* Redirect browser */
	exit();
	echo "Upload Complete";
}
?>
