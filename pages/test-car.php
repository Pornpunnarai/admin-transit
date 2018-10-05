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

    <style>
        /*#mapCanvas{*/
            /*width: 100%;*/
            /*height: 400px;*/
        /*}*/

        #wrapper { position: relative; }
        #over_map { position: absolute; top: 88%; left: 45%; z-index: 99; }

        .btn{
            font-size: 30px;
        }
        .btn.btn-r1g{
            background-color: white;
            color:#339999;
            font-size: 20px;
            border: 1px solid #339999 ;
            padding-left: 15px;
            padding-right: 15px;
        }
        .btn.btn-r1g:hover:focus{
            background-color: #339999;
            color:white;
        }

        .btn.btn-r1p{
            background-color: white;
            color:#771a7f;
            border: 1px solid #771a7f ;
            font-size: 20px;
            padding-left: 15px;
            padding-right: 15px;
        }
        .btn.btn-r1p:hover:focus{
            background-color: #771a7f;
            color:white;
        }

        .btn.btn-r2{
            background-color: white;
            color:#f268cc;
            border: 1px solid #f268cc ;
            font-size: 20px;
            padding-left: 15px;
            padding-right: 15px;
        }
        .btn.btn-r2:hover:focus{
            background-color: #f268cc;
            color:white;
        }

        .btn.btn-r3r{
            background-color: white;
            color:#ff0026;
            border: 1px solid #ff0026 ;
            font-size: 20px;
            padding-left: 15px;
            padding-right: 15px;
        }
        .btn.btn-r3r:hover:focus{
            background-color: #ff0026;
            color:white;
        }

        .btn.btn-r3y{
            background-color: white;
            color:#face48;
            border: 1px solid #face48 ;
            font-size: 20px;
            padding-left: 15px;
            padding-right: 15px;
        }
        .btn.btn-r3y:hover:focus{
            background-color: #face48;
            color:white;
        }

    </style>
</head>

<body>
<div id="wrapper">

    <?php include 'navbar.php' ?>

    <div id="page-wrapper">

        <!-- Page Content -->
        <div class="container-fluid">
            <ol class="breadcrumb" style="margin-top: 1rem;">
                <li class="breadcrumb-item active" style="height: 35px">Map</li>
                <button id="busstop" style="float: right" class="btn btn-success" onclick="icon_off()">Enable Bus Stop</button>
            </ol>



            <div id="wrapper">
                <div class="embed-responsive embed-responsive-16by9">
                    <div id="mapCanvas" class="embed-responsive-item" style="overflow: hidden;">
                    </div>
                </div>

                <div id="over_map">
                    <div class="row" style="justify-content: center">
                        <button onclick="route('R1G')" class="btn btn-r1g">R1G</button>
                        <button onclick="route('R1P')" class="btn btn-r1p">R1P</button>
                        <button onclick="route('R2B')" class="btn btn-r2">R2</button>
                        <button onclick="route('R3R')" class="btn btn-r3r">R3R</button>
                        <button onclick="route('R3Y')" class="btn btn-r3y">R3L</button>
                    </div>

                </div>
            </div>


        </div>


    </div>
    <!-- /#page-wrapper -->

</div>



<!--<div id="mapCanvas"></div>-->
</body>

</html>
