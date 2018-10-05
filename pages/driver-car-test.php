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

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCeIm4Qr_eDTBDnE55Q1DJbZ4qXZLYjss"></script>




    <script src="car-test.js"></script>

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

                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Car ID</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Login Time</th>
                                <th>Logout Time</th>
                                <th>Infomation</th>
                            </tr>
                            </thead>
                            <tbody>
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
                                        <td><?=convert_car_detail($value->Detail)?></td>
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
                            </tbody>
                        </table>


                    </div>

                </div>

            </div>

        </div>


    </div>
    <!-- /#page-wrapper -->

</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<!--<div id="mapCanvas"></div>-->
</body>

</html>
<?php
function convert_car_detail($detail) {
    if($detail=="R1"){
        $car_type = "R1G";
    }
    if($detail=="R2"||$detail=="สำรอง"){
        $car_type = "R2P";
    }
    if($detail=="R3-Y"){
        $car_type = "R3Y";
    }
    if($detail=="R3-R"){
        $car_type = "R3R";
    }

    if($detail=="B1,2"||$detail=="B1,6"||$detail=="B1,3" ||$detail=="B1,1"
        ||$detail=="B1,5"||$detail=="B1,4")
    {
        $car_type = "B1G";
    }
    if($detail=="B2,5"||$detail=="B2,1"|| $detail=="B2,4"
        ||$detail=="B2,6"||$detail=="B2,2"||$detail=="B2,3")
    {
        $car_type = "B2G";
    }
    if($detail=="B3,30"||$detail=="B3,33"||$detail=="B3,34"||$detail=="B3,37")
    {
        $car_type = "B3G";
    }
    if($detail=="")
    {
        $car_type = "KWG";
    }

    return $car_type;
}
?>