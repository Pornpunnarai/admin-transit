<!DOCTYPE html>
<html>
<head>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left
        }
    </style>
</head>
<body>

<h2>Cell that spans two rows:</h2>
<table style="width:100%">
    <tr>
        <th>NO.</th>
        <th>HeaderName</th>
        <th>Date</th>
        <th>Time</th>
        <th>HeaderCenter</th>
        <th>IDCar</th>
        <th>CM_Command</th>
        <th>CM_Meter</th>
        <th>CM_Engine</th>
        <th>CM_Battery</th>
        <th>FuelLevel</th>
        <th>Sensor1</th>
        <th>Sensor2</th>
        <th>Sensor3</th>
        <th>SignalGPS</th>
        <th>LaGoogle</th>
        <th>LongGoogle</th>
        <th>Fast</th>
        <th>Direction</th>
        <th>PhoneGPS</th>
        <th>IpGPS</th>
        <th>SignalFall</th>
        <th>Port</th>
        <th>Correct_Date</th>
        <th>SpeedOver</th>
        <th>GeoOver</th>
        <th>Speedlimit</th>
        <th>Engineoffever</th>
        <th>DP_Use</th>
        <th>St_Command</th>
        <th>St_Ban</th>
        <th>St_Recive</th>
        <th>DriverName</th>
        <th>DriverIDCard</th>
        <th>DriverDateTimeLogInOut</th>
        <th>StatusLogInOut</th>
        <th>LogIn</th>
        <th>LogOut</th>
        <th>SensorPM</th>
        <th>disphat</th>
        <th>Registerid</th>
        <th>Type</th>
        <th>Brand</th>
        <th>Model</th>
        <th>Color</th>
        <th>YearCar</th>
        <th>Carbodyno</th>
        <th>Motorid</th>
        <th>Fuel</th>
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


        <?php

        $url = 'http://183.90.168.61/cmcar/';
        $content = file_get_contents($url);
        $json = json_decode($content, true);
        $no = 1;


        foreach($json as $i){


        ?>

    <tr>
        <td> <?=$no?></td>
        <td><?=$i['HeaderName']?></td>
        <td><?=$i['Date']?></td>
        <td><?=$i['Time']?></td>
        <td><?=$i['HeaderCenter']?></td>
        <td><?=$i['IDCar']?></td>
        <td><?=$i['CM_Command']?></td>
        <td><?=$i['CM_Meter']?></td>
        <td><?=$i['CM_Engine']?></td>
        <td><?=$i['CM_Battery']?></td>
        <td><?=$i['FuelLevel']?></td>
        <td><?=$i['Sensor1']?></td>
        <td><?=$i['Sensor2']?></td>
        <td><?=$i['Sensor3']?></td>
        <td><?=$i['SignalGPS']?></td>
        <td><?=$i['LaGoogle']?></td>
        <td><?=$i['LongGoogle']?></td>
        <td><?=$i['Fast']?></td>
        <td><?=$i['Direction']?></td>
        <td><?=$i['PhoneGPS']?></td>
        <td><?=$i['IpGPS']?></td>
        <td><?=$i['SignalFall']?></td>
        <td><?=$i['Port']?></td>
        <td><?=$i['Correct_Date']?></td>
        <td><?=$i['SpeedOver']?></td>
        <td><?=$i['GeoOver']?></td>
        <td><?=$i['Speedlimit']?></td>
        <td><?=$i['Engineoffever']?></td>
        <td><?=$i['DP_Use']?></td>
        <td><?=$i['St_Command']?></td>
        <td><?=$i['St_Ban']?></td>
        <td><?=$i['St_Recive']?></td>
        <td><?=$i['DriverName']?></td>
        <td><?=$i['DriverIDCard']?></td>
        <td><?=$i['DriverDateTimeLogInOut']?></td>
        <td><?=$i['StatusLogInOut']?></td>
        <td><?=$i['LogIn']?></td>
        <td><?=$i['LogOut']?></td>
        <td><?=$i['SensorPM']?></td>
        <td><?=$i['disphat']?></td>
        <td><?=$i['Registerid']?></td>
        <td><?=$i['Type']?></td>
        <td><?=$i['Brand']?></td>
        <td><?=$i['Model']?></td>
        <td><?=$i['Color']?></td>
        <td><?=$i['YearCar']?></td>
        <td><?=$i['Carbodyno']?></td>
        <td><?=$i['Motorid']?></td>
        <td><?=$i['Fuel']?></td>
        <td><?=$i['Detail']?></td>
        <td><?=$i['User']?></td>
        <td><?=$i['DateTimeUse']?></td>
        <td><?=$i['Trackingtransport']?></td>
        <td><?=$i['Drivertitle']?></td>
        <td><?=$i['Drivername']?></td>
        <td><?=$i['DriverSername']?></td>
        <td><?=$i['Detail2']?></td>
        <td><?=$i['Provice']?></td>
    </tr>
        <?php
            $no++;
        }
        ?>


</table>

</body>
</html>
