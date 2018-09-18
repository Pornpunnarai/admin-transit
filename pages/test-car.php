<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CM - Transit</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCeIm4Qr_eDTBDnE55Q1DJbZ4qXZLYjss"></script>

    <script src="car.js"></script>

<!--    <style>-->
<!--        #mapCanvas{-->
<!--            width: 100%;-->
<!--            height: 400px;-->
<!--        }-->
<!--    </style>-->
</head>

<body>
<div id="wrapper">

    <?php include 'navbar.php' ?>

    <div id="page-wrapper">

        <!-- Page Content -->
        <div class="container-fluid">
            <ol class="breadcrumb" style="margin-top: 1rem;">
                <li class="breadcrumb-item active" style="height: 35px">Map</li>
                <button style="float: right" class="btn btn-primary" onclick="icon_off()">Icon</button>
            </ol>



            <div class="embed-responsive embed-responsive-16by9">
                <div id="mapCanvas" class="embed-responsive-item" style="overflow: hidden;">
                </div>
            </div>
        </div>


    </div>
    <!-- /#page-wrapper -->

</div>



<!--<div id="mapCanvas"></div>-->
</body>

</html>
