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

    <script src="car-test.js"></script>

    <!--    <style>-->
    <!--        #mapCanvas{-->
    <!--            width: 100%;-->
    <!--            height: 400px;-->
    <!--        }-->
    <!--    </style>-->
</head>

<body>
<div id="wrapper">

    <?php include 'navbar2.php' ?>

    <div id="page-wrapper">

        <!-- Page Content -->
        <div class="container-fluid">
            <ol class="breadcrumb" style="margin-top: 1rem;">
                <li class="breadcrumb-item active">Driver & Car</li>
            </ol>

            <div class="col-lg-12" style="background-color: white; padding: 1%">
                <div class="col-lg-6">

                    <div class="row">
                        <h4>ข้อมูลคนขับรถ</h4>


                        <div class="col-lg-2">
                            <img src="/admin-transit/image/avatar.png" width="100%">
                        </div>

                        <div id="driver" class="col-lg-10">
                        </div>


                    </div>
                    <br>
                    <div class="row">
                        <div class="embed-responsive embed-responsive-16by9">
                            <div id="mapCanvas" class="embed-responsive-item" style="overflow: hidden;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="col-lg-12" style="background-color: #ccc">
                        <h4 class="text-center">ข้อมูลรถ</h4>

                        <table id="createTable2" class="table table-bordered" style="text-align: center">
                            <tr>
                                <th>Car ID</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Login Time</th>
                                <th>Logout Time</th>
                                <th>Infomation</th>
                            </tr>
                            <?php

                            $file ='http://cmtransit.com/admin-transit/CM_CAR/API/';
                            $json_str = file_get_contents($file);

                            # Get as an object
                            $json_obj = json_decode($json_str);

                            foreach ($json_obj as $key => $value) {
                                   if($value->Type=="kwvan"||$value->Type=="minibus"||$value->Type=="bus"){
                            ?>
                            <tr>
                                <td><?=$value->Registerid?></td>
                                <td><?=$value->Detail?></td>
                                <?php
                                if($value->StatusLogInOut=="I"){
                                    $status = "<button class=\"btn btn-success btn-circle\"></button>";
                                }else{
                                    $status = "<button class=\"btn btn-danger btn-circle\"></button>";
                                }
                                ?>
                                <td><?=$status?></td>
                                <td><?=$value->LogIn?></td>
                                <td><?=$value->LogOut?></td>
                                <td><button class="btn btn-primary" onclick="driver('<?=$value->Registerid?>')">Info</button></td>
                            </tr>
                            <?php
                                   }
                            }
                            ?>
                        </table>


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
