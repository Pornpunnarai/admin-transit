<!DOCTYPE html>
<html>
<head>
  <title>Driver Info</title>
  <meta charset=utf-8>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
  <div id="contact" class="contact">
    <div class="section secondary-section">
      <div class="container">
        <div class="span9 center contact-info">
          <div class="title">
            <h2>CM-TRANSIT</h2>
          </div>
        </div>
        <div class="map-wrapper">
          <div class="container">
            <div class="row-fluid">
              <div class="span contact-form centered">
                <div class="col-lg-12">
                  <form action="phpMySQLEditRecordSave.php?ID=<?php echo $_GET["ID"];?>" name="frmEdit" method="post">

                      <?php include 'connect-mysql.php';

                      $sql = "SELECT * FROM driver_info WHERE id = '".$_GET["ID"]."' ";
                      $query = mysqli_query($objCon, $sql);

                      while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                    ?>
                        <div class="col-lg-12">
                          <table class="table table-bordered table-hover" >
                            <thead>
                              <tr>
                                <th><div align="center">ลำดับ</div></th>
                                <td><input type="text" name="textid" value="<?php echo $result["id"];?>"></td>
                              </tr>
                              <tr>
                                <th><div align="center">ชื่อ</div></th>
                                <td><input type="text" name="txtfirstname" value="<?php echo $result["firstname"];?>"></td>
                                <th><div align="center">นามสกุล</div></th>
                                <td><input type="text" name="txtlastname" value="<?php echo $result["lastname"];?>"></td>
                              </tr>
                              <tr>
                                <th><div align="center">เบอร์โทรศัพท์</div></th>
                                <td><input type="text" name="textphone" value="<?php echo $result["phone"];?>"></td>
                              </tr>
                              <tr>
                                <th><div align="center">ทะเบียนรถ</div></th>
                                <td><input type="text" name="textcar_id" value="<?php echo $result["car_id"];?>"></td>
                              </tr>
                              <tr>
                                <th><div align="center">เลขประจำตัวประชาชน</div></th>
                                <td><input type="text" name="textnationnal_id" value="<?php echo $result["nationnal_id"];?>"></td>
                              </tr>
                              <tr>
                                <th><div align="center">เลขที่ใบอนุญาตขับขี่</div></th>
                                <td><input type="text" name="textlicence_id" value="<?php echo $result["licence_id"];?>"></td>
                              </tr>
                              <tr>
                                <th><div align="center">กลุ่ม</div></th>
                                <td><input type="text" name="texttype" value="<?php echo $result["type"];?>"></td>
                              </tr>
                            </thead>
                          </table>
                          <input type="submit" name="submit" value="submit">
                        <?php
                      }
                      mysqli_close($objCon);
                      ?>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

