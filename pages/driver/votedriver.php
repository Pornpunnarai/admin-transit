<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>คะแนนคนขับรถ</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="css/style.css" />

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
    <?php include 'navbar.html';
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">คะแนนคนขับรถ</h1>
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
            <!-- /.row -->
            <div class="row">
            </div>

        </div>

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
