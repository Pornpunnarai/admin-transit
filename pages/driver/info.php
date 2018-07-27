<!DOCTYPE html>
<html>
<head>
	<title>ข้อมูลคนขับรถ</title>
	<meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
	<?php include 'connect-mysql.php';
		try {
			$db = new PDO('mysql:host='.$serverName.';dbname='.$dbName.';'.$char_set,$username,$password);

			//echo "เชื่อมต่อฐานข้อมูลสำเร็จ";
			$data = $_REQUEST['id'];

			$sql="SELECT firstname,lastname,car_id,licence_id FROM driver_info where id =".$data;
			$query = $db->query($sql);

			//echo "<pre>".print_r($query->fetch(2), true)."</pre>";
			//while($row = $query->fetch()) {
				//echo "ชื่อ : ".$row['firstname']." ".$row['lastname']."<br>";
				//echo "ทะเบียนรถ : ".$row['car_id']."<br>";
				//echo "เลขที่ใบอนุญาตขับขี่ : ".$row['licence_id']."<br>";
			//}
		} catch (PDOException $e) {
			echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : ".$e->getMessage();	
		}
	?>
	<div id="contact" class="contact">
        <div class="section secondary-section">
            <div class="container">
                <div class="span9 center contact-info">
                    <div class="title">
                        <h3>ข้อมูลคนขับรถ</h3>
                    </div>
                    <img src="img/<?php echo $data; ?>.jpg" alt="" style="width:260px;">

                    <a><br><br>
                    	<?php
                    	while($row = $query->fetch()) {
							echo "".$row['firstname']." ".$row['lastname']."<br><br>";
							echo "ทะเบียนรถ : ".$row['car_id']."<br><br>";
							echo "เลขที่ใบอนุญาตขับขี่ : ".$row['licence_id']."<br><br>";
						}
                    	?>
                    </a>
                </div>
                <div class="map-wrapper">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="span contact-form centered">
                                <h3>ให้คะแนน</h3>
                                <?php include 'form_vote.php'; echo create_vote($data);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--?php include 'form_vote.php'; echo create_vote(2);?-->

</body>
</html>


