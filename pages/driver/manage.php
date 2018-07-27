<!DOCTYPE html>
<html>
<head>
    <title>ลงทะเบียนคนขับรถแดง</title>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/tabcontent.css" />
    <script type="text/javascript" src="js/tabcontent.js"></script>
</head>
<body>
    <?php
        session_start();
        if($_SESSION['UserID'] == "")
        {
        echo "Please Login!";
        exit();
        }

        if($_SESSION['Status'] != "ADMIN")
        {
        echo "This page for Admin only!";
        exit();
        }
    ?>

    <div id="contact" class="contact">
        <div class="section secondary-section">
            <div class="container">
            <div align="right"><a href="logout.php">Logout</a></div>
                <div class="span9 center contact-info">
                    <div class="title">
<!--                        <h2>ระบบจัดการฐานข้อมูลคนขับรถยนต์สี่ล้อแดงจังหวัดเชียงใหม่</h2>-->
                        <h2>CM-TRANSIT</h2>
                    </div>
                </div>

                <ul id="countrytabs" class="shadetabs">
                    <li><a href="#" rel="country1" class="selected">ลงทะเบียน</a></li>
                    <li><a href="#" rel="country2">ข้อมูลคนขับรถ</a></li>
                    <li><a href="#" rel="country3">คะแนนคนขับรถ</a></li>
                </ul>


                <div id="country2" class="tabcontent">
                <div class="map-wrapper">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="span contact-form centered">
                                <?php
                                    ini_set('display_errors', 1);
                                    error_reporting(~0);

                                    $strKeyword = null;

                                    if(isset($_POST["txtKeyword"])){
                                        $strKeyword = $_POST["txtKeyword"];
                                    }
                                ?>
                                <form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                                    <table>
                                        <tr>
                                            <th>กรุณากรอกชื่อที่ต้องการค้นหา
                                                <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>">
                                                <input type="submit" value="Search">
                                            </th>
                                        </tr>
                                    </table>
                                </form>
                                <?php include 'connect-mysql.php';

                                    $sql = "select * from driver_info WHERE firstname LIKE '%".$strKeyword."%' ";
                                    $query = mysqli_query($objCon, $sql);
                                ?>
                                <div class="col-lg-12">
                                    <table class="table table-bordered table-hover" >
                                        <thead>
                                            <tr>
                                                <th><div align="center">ลำดับ</div></th>
                                                <th><div align="center">ชื่อ</div></th>
                                                <th><div align="center">นามสกุล</div></th>
                                                <th><div align="center">เบอร์โทรศัพท์</div></th>
                                                <th><div align="center">ทะเบียนรถ</div></th>
                                                <th><div align="center">เลขประจำตัวประชาชน</div></th>
                                                <th><div align="center">เลขที่ใบอนุญาตขับขี่</div></th>
                                                <th><div align="center">กลุ่ม</div></th>
                                                <th><div align="center">รูปประจำตัว</div></th>
                                                <th><div align="center">แก้ไข</div></th>

                                            </tr> 
                                        </thead>
                                        <tbody>
                                        <?php while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) { ?>
                                            <tr>
                                                <td><div align="center"><?php echo $result['id']; ?></div></td>
                                                <td><?php echo $result['firstname']; ?></td>
                                                <td><?php echo $result['lastname']; ?></td>
                                                <td><div align="center"><?php echo $result['phone']; ?></div></td>
                                                <td><div align="center"><?php echo $result['car_id']; ?></div></td>
                                                <td><div align="center"><?php echo $result['nationnal_id']; ?></div></td>
                                                <td><div align="center"><?php echo $result['licence_id']; ?></div></td>
                                                <td><div align="center"><?php echo $result['type']; ?></div></td>
                                                <td><div align="center"><img src="img/<?php echo $result['id']; ?>.jpg" alt="" style="width:100px;"></div></td>
                                                <td><div align="center"><a href="phpMySQLEditRecordForm.php?ID=<?php echo $result['id']; ?>">Edit</a></div></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div id="country3" class="tabcontent">
                <div class="map-wrapper">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="span contact-form centered">
                                <?php include 'connect-mysql.php';

                                    $sql = "select driver_info.*,driver_vote.* from driver_info,driver_vote WHERE driver_info.id=driver_vote.id ORDER BY timestamp desc";
                                    $query = mysqli_query($objCon, $sql);
                                ?>
                                <div class="col-lg-12">
                                    <table class="table table-bordered table-hover" >
                                        <thead>
                                            <div align="right"><a href="excel.php">Save to Excel <img border="0" alt="" src="image/excel-save.png" width="40"></a></div>
                                            <tr>
                                                <th><div align="center">ชื่อ</div></th>
                                                <th><div align="center">นามสกุล</div></th>
                                                <th><div align="center">ทะเบียนรถ</div></th>
                                                <th><div align="center">คะแนน</div></th>
                                                <th><div align="center">comment</div></th>
                                                <th><div align="center">เวลา</div></th>
                                            </tr> 
                                        </thead>
                                        <tbody>
                                        <?php while($result=mysqli_fetch_array($query,MYSQLI_ASSOC)) { ?>
                                            <tr>
                                                <td width="120"><?php echo $result['firstname']; ?></td>
                                                <td width="120"><?php echo $result['lastname']; ?></td>
                                                <td width="80"><div align="center"><?php echo $result['car_id']; ?></div></td>
                                                <td width="30"><div align="center"><?php echo $result['vote']; ?></div></td>
                                                <td width="600"><?php echo $result['comment']; ?></td>
                                                <td width="180"><div align="center"><?php echo $result['timestamp']; ?></div></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        var countries=new ddtabcontent("countrytabs")
        countries.setpersist(true)
        countries.setselectedClassTarget("link") //"link" or "linkparent"
        countries.init()
    </script>

</body>
</html>


