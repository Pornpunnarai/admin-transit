<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ข้อมูลคนขับรถ</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <style>
        .navbar .nav > li:hover> a, .navbar .nav > .active > a, .navbar .nav > .active > a:hover, .navbar .nav > .active > a:focus {
            border: 0px solid #2e3f50;
            color: #fff;
            background-color: #2e3f50;
            transition: border-color 1s ease;
        }
        .nav .open>a, .nav .open>a:focus, .nav .open>a:hover {
            background-color: #2e3f50;
            border-color: #2e3f50;
        }
        #page-wrapper {
            background-color: #2e3f501a;
        }
        .divform{
            margin-bottom: 2px;
        }
    </style>
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
<div id="wrapper">
    <!-- Navigation -->
    <?php include '../navbar.html';
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">ข้อมูลคนขับรถ</h1>
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
<!--                                            <td></td>-->
                                            <td><div align="center">
                                                    <img src="img/<?php echo $result['id']; ?>.jpg" alt="" style="width:100px;">
                                                </div></td>
                                            <td>
                                                <div align="center">
                                                    <a href="edit_driver_info.php?ID=<?php echo $result['id']; ?>">Edit</a>
                                                </div></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
        </div>

    </div>

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../../vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../../vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../../dist/js/sb-admin-2.js"></script>

</body>

</html>
