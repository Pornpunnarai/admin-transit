<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ลงทะเบียนคนขับรถแดง</title>

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

<div id="wrapper">
    <!-- Navigation -->
    <?php include '../navbar.php' ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">ลงทะเบียน</h1>
                <div class="row-fluid">
                    <div class="span contact-form centered">
                        <h3>กรุณากรอกข้อมูลให้ครบถ้วน</h3>
                        <form action="upload.php" method="post" enctype="multipart/form-data" name="f1">
                            <div>
                                <input class="form-control divform" name="txtFirstname" type="text" id="txtFirstname" placeholder="* ชื่อ"  size="20">
                                <input class="form-control divform" name="txtLastname" type="text" id="txtLastname" placeholder="* นามสกุล"  size="20" >
                            </div>
                            <div>
                                <input class="form-control divform" name="txtPhone" type="text" id="txtPhone" placeholder="* เบอร์โทรศัพท์"  size="20" >
                                <input class="form-control divform" name="txtCar_id" type="text" id="txtCar_id" placeholder="* หมายเลขทะเบียนรถ"  size="20" >
                            </div>
                            <div>
                                <input class="form-control divform" name="txtNational_id" type="text" id="txtNational_id" placeholder="* เลขประจำตัวประชาชน"  size="13" >
                                <input class="form-control divform" name="txtLicense_id" type="text" id="txtLicense_id" placeholder="* เลขที่ใบอนุญาตขับขี่"  size="20" >
                            </div>
                            <div>
                                <input class="form-control divform" name="txtType" type="text" id="txtType" placeholder="* กลุ่ม เช่น A B C"  size="20" >
                            </div>
                            <div>
                                <input class="form-control divform" type="file" name="fileUpload" >
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <button name="submit" id="submit" type="submit" class="message-btn">UPLOAD</button>
                                </div>
                            </div>
                        </form>
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
