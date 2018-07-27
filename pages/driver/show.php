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

            $sql="SELECT firstname,lastname,phone,car_id,licence_id FROM driver_info where id =".$data;
            $query = $db->query($sql);
            //echo "<pre>".print_r($query->fetch(2), true)."</pre>";
            $row = $query->fetch();
            
        } catch (PDOException $e) {
            echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : ".$e->getMessage();  
        }
    ?>
        <div class="section">
            <div class="container">
                <div class="map-wrapper">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="span contact-form">
                                <div class="sapn">
                                    <div class="span3 centered">
                                        <img src="img/<?php echo $data; ?>.jpg">
                                    </div>
                                    <div class="span6">
                                        <div class="yello"><h2><b><?php echo $row[0]." ".$row[1]; ?></b></h2></div>
                                        <div class="space"></div>
                                        <div class="yello"><h2>เบอร์โทรศัพท์ : <?php echo $row[2]; ?></h2></div>
                                        <div class="space"></div>
                                        <div class="blue"><h2>ทะเบียนรถ : <?php echo $row[3]; ?></h2></div>
                                        <div class="space"></div>
                                        <div class="blue"><h6>ใบอนุญาตขับรถเลขที่ : <?php echo $row[4]; ?></h6></div>
                                    </div>
                                    <div class="span3">
                                        <div class="centered">
                                            <?php
                                            require_once('phpqrcode/qrlib.php');
//                                            QRcode::png('http://192.168.70.41/driver/php/info.php?id='.$data, 'file/'.$data.'.png', 'H', 5); // creates file
                                            QRcode::png('http://chiangmaibus.org/driver/php/info.php?id='.$data, 'file/'.$data.'.png', 'H', 5); // creates file
                                            ?>
                                            <img src="file/<?php echo $data; ?>.png" height="360" width="360">
                                        </div>
                                        <h4 class="centered">สแกน QR Code<br><br>ร่วมติชมการให้บริการ</h4>
                                    </div>
                                </div>
                                <h3 class="span centered"><b><br>โครงการยกระดับการให้บริการรถโดยสารสาธารณะจังหวัดเชียงใหม่</b></h3>
                                <div class="span">
                                    <div class="span1"></div>
                                    <div class="span10 yello">
                                        <h4>&#8226; ราคาค่าบริการ(Service Fees)(ไม่เกินวงแหวนรอบ2)<br><br>&#8226; วิ่งวนไม่เกิน 30 บาท/คน (Non Charter trip Max. 30 Baht/person)<br><br>&#8226; เหมา ไม่เกิน 200 บาท (Charter trip spacific area Max. 200 Baht/trip)</h4>
                                    </div>
                                    <div class="span1"></div>
                                </div>
                                <div class="span centered">
                                        <div class="span2"></div>
                                        <img src="photo/logo.jpg" class="span8">
                                    </div>
                                    <h1 class="centered"><b>ร้องเรียนรถสาธารณะ โทร 1584</b></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>


