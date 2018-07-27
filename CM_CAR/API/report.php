
<html lang="en" class="gr__183_90_168_61">
<head>
    <meta http-equiv="refresh" content="600">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Smarttaxi Monitor</title>
    <!-- Bootstrap core CSS-->
    <link href="/cm_monitor/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="/cm_monitor/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="/cm_monitor/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="/cm_monitor/css/sb-admin.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>



<body class="fixed-nav sticky-footer bg-dark" id="page-top" data-gr-c-s-loaded="true">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="/cm_monitor/index.php">ศูนย์ควบคุมระบบการเดินรถแบบอัจฉริยะแห่งจังหวัดเชียงใหม่</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="สัญญาณหาย">
                <a class="nav-link" href="/cm_monitor/index.php">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">รถโดยสารประจำทาง</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="ถอดแบต">
                <a class="nav-link" href="/cm_monitor/CM_CAR/API/report.php">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">รายงาน</span>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>

            </li>
        </ul>
    </div>
</nav>
<div class="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">รายงาน</li>

        </ol>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>NO.</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>HeaderCenter</th>
                        <th>IDCar</th>
                        <th>CM_Battery</th>
                        <th>SignalGPS</th>
                        <th>LaGoogle</th>
                        <th>LongGoogle</th>
                        <th>Fast</th>
                        <th>Direction</th>
                        <th>PhoneGPS</th>
                        <th>IpGPS</th>
                        <th>SignalFall</th>
                        <th>Correct_Date</th>
                        <th>DriverName</th>
                        <th>DriverIDCard</th>
                        <th>DriverDateTimeLogInOut</th>
                        <th>StatusLogInOut</th>
                        <th>LogIn</th>
                        <th>LogOut</th>
                        <th>SensorPM</th>
                        <th>Registerid</th>
                        <th>Type</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Color</th>
                        <th>YearCar</th>
                        <th>Carbodyno</th>
                        <th>Motorid</th>
                        <th>Detail</th>
                        <th>User</th>
                        <th>DateTimeUse</th>
                        <th>Trackingtransport</th>
                        <th>Drivertitle</th>
                        <th>Drivername</th>
                        <th>DriverSername</th>
                        <th>Detail2</th>
                        <th>Province</th>
                    </tr>
                    </thead>

                    <?php
                    $url = 'http://183.90.168.61/cmcar/';
                    $content = file_get_contents($url);
                    $json = json_decode($content, true);
                    $no = 1;
                    foreach($json as $i)
                    {
                    ?>
                    <tbody>

                        <tr>
                            <td> <?=$no?></td>
                            <td><?=$i['Date']?></td>
                            <td><?=$i['Time']?></td>
                            <td><?=$i['HeaderCenter']?></td>
                            <td><?=$i['IDCar']?></td>
                            <td><?=$i['CM_Battery']?></td>
                            <td><?=$i['SignalGPS']?></td>
                            <td><?=$i['LaGoogle']?></td>
                            <td><?=$i['LongGoogle']?></td>
                            <td><?=$i['Fast']?></td>
                            <td><?=$i['Direction']?></td>
                            <td><?=$i['PhoneGPS']?></td>
                            <td><?=$i['IpGPS']?></td>
                            <td><?=$i['SignalFall']?></td>
                            <td><?=$i['Correct_Date']?></td>
                            <td><?=$i['DriverName']?></td>
                            <td><?=$i['DriverIDCard']?></td>
                            <td><?=$i['DriverDateTimeLogInOut']?></td>
                            <td><?=$i['StatusLogInOut']?></td>
                            <td><?=$i['LogIn']?></td>
                            <td><?=$i['LogOut']?></td>
                            <td><?=$i['SensorPM']?></td>
                            <td><?=$i['Registerid']?></td>
                            <td><?=$i['Type']?></td>
                            <td><?=$i['Brand']?></td>
                            <td><?=$i['Model']?></td>
                            <td><?=$i['Color']?></td>
                            <td><?=$i['YearCar']?></td>
                            <td><?=$i['Carbodyno']?></td>
                            <td><?=$i['Motorid']?></td>
                            <td><?=$i['Detail']?></td>
                            <td><?=$i['User']?></td>
                            <td><?=$i['DateTimeUse']?></td>
                            <td><?=$i['Trackingtransport']?></td>
                            <td><?=$i['Drivertitle']?></td>
                            <td><?=$i['DriverName']?></td>
                            <td><?=$i['DriverSername']?></td>
                            <td><?=$i['Detail2']?></td>
                            <td><?=$i['Provice']?></td>
                        </tr>
                    </tbody>

                        <?php
                    $no++;
                    }
                    ?>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
<footer class="sticky-footer">
    <div class="container">
        <div class="text-center">
            <small>Copyright © Cm-Monitor</small>
        </div>
    </div>
</footer>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">ยืนยันการออกจากระบบ</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<script src="/cm_monitor/vendor/jquery/jquery.min.js"></script>
<script src="/cm_monitor/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="/cm_monitor/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Page level plugin JavaScript-->
<script src="/cm_monitor/vendor/chart.js/Chart.min.js"></script>
<script src="/cm_monitor/vendor/datatables/jquery.dataTables.js"></script>
<script src="/cm_monitor/vendor/datatables/dataTables.bootstrap4.js"></script>
<!-- Custom scripts for all pages-->
<script src="/cm_monitor/js/sb-admin.min.js"></script>
<!-- Custom scripts for this page-->
<script src="/cm_monitor/js/sb-admin-datatables.min.js"></script>
</body>
</html>
