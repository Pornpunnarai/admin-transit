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
    <link href="/admin-transit/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/admin-transit/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/admin-transit/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/admin-transit/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/admin-transit/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <style>
        .navbar.navbar-default.navbar-static-top {
            background-color: #2e3f50;
            color: white;
        }

        .sidebar ul li a:active {
            background-color: #2e3f50;
            color: white;
        }

        #page-wrapper {
            background-color: #2e3f5033;
        }
        .navbar-default .navbar-brand {
            color: white;
        }
        a {
            color: #2e3f50;
        }

        .nav>li>a {
            padding: 15px 15px;
        }

        a.dropdown-toggle{
            color: white;
        }
        .nav .open>a, .nav .open>a:focus, .nav .open>a:hover {
            color: #f0ad4e;
            background-color: #eee0;
        }

        .nav>li>a:focus, .nav>li>a:hover, a.navbar-brand:focus {
            color: #f0ad4e;
            background-color: #eee0;
        }


    </style>
</head>

<body>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CM-TRANSIT</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">

            <!-- /.dropdown -->
            <!--            <li class="dropdown">-->
            <!--                <a class="dropdown-toggle" data-toggle="dropdown" href="#">-->
            <!--                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>-->
            <!--                </a>-->
            <!--                <ul class="dropdown-menu dropdown-user">-->
            <!--                    <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>-->
            <!--                    <!--</li>-->
            <!--                    <!--<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>-->
            <!--                    <!--</li>-->
            <!--                    <li><a href="/admin-transit/pages/driver-transit.php"><i class="fa fa-user-times"></i> Driver Transit</a>-->
            <!--                    <li class="divider"></li>-->
            <!--                    <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--            </li>-->
        </ul>

        <?php
        $url = 'http://www.cmtransit.com/API/route_name'; // path to your JSON file
        $data = file_get_contents($url); // put the contents of the file into a variable
        $characters = json_decode($data); // decode the JSON feed

        ?>
        <!-- /.navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="/admin-transit/pages/index.php"><i class="fa fa-map-o fa-fw"></i> Map<span class="fa arrow"></span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-map-signs fa-fw"></i>
                            <span class="nav-link-text">Bus Stop</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin-transit/pages/route.php"><i class="fa fa-times-circle-o fa-fw"></i>
                            <span class="nav-link-text">Route & Timetable</span>
                        </a>
                    </li>

                    <li>
                        <a href="#driver-selected"><i class="fa fa-user fa-fw"></i>
                            <span class="nav-link-text">Driver</span><span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <!--                            <li>-->
                            <!--                                <a href="/admin-transit/pages/driver/register.php"><i class="fa fa-dashboard fa-fw"></i> ลงทะเบียน</a>-->
                            <!--                            </li>-->
                            <li>
                                <a href="/admin-transit/pages/driver-car.php"><i class="fa fa-user fa-fw"></i> คนขับรถ-รถ</a>
                            </li>
                            <li>
                                <a href="/admin-transit/pages/driver/listdriver.php"><i class="fa fa-user-plus fa-fw"></i> ข้อมูลคนขับรถ</a>
                            </li>
                            <li>
                                <a href="/admin-transit/CM_CAR/API/report.php"><i class="fa fa-table fa-fw"></i> รายงานคนขับรถ</a>
                            </li>
                            <!--                            <li>-->
                            <!--                                <a href="#"><i class="fa fa-files-o fa-fw"></i>คะแนนคนขับรถ</a>-->
                            <!--                            </li>-->
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

<!--                    <li>-->
<!--                        <a href="/admin-transit/pages/route.php"><i class="fa fa-times-circle-o fa-fw"></i>-->
<!--                            <span class="nav-link-text">Route & Timetable</span>-->
<!--                        </a>-->
<!--                    </li>-->

                    <li>
                        <a href="/admin-transit/pages/ContactUs.php"><i class="fa fa-volume-control-phone fa-fw"></i>
                            <span class="nav-link-text">Contact us</span>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="/admin-transit/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/admin-transit/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="/admin-transit/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="/admin-transit/vendor/raphael/raphael.min.js"></script>
<script src="/admin-transit/vendor/morrisjs/morris.min.js"></script>
<script src="/admin-transit/data/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="/admin-transit/dist/js/sb-admin-2.js"></script>

</body>

</html>
