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

    <form action="upload.php" method="post" enctype="multipart/form-data" name="f1">
        <div>
            <input class="span4" name="txtFirstname" type="text" id="txtFirstname" placeholder="* ชื่อ" " size="20">
            <input class="span4" name="txtLastname" type="text" id="txtLastname" placeholder="* นามสกุล" " size="20" >
        </div>
        <div>
            <input class="span4" name="txtPhone" type="text" id="txtPhone" placeholder="* เบอร์โทรศัพท์" " size="20" >
            <input class="span4" name="txtCar_id" type="text" id="txtCar_id" placeholder="* หมายเลขทะเบียนรถ" " size="20" >
        </div>
        <div>
            <input class="span4" name="txtNational_id" type="text" id="txtNational_id" placeholder="* เลขประจำตัวประชาชน" " size="20" >
            <input class="span4" name="txtLicense_id" type="text" id="txtLicense_id" placeholder="* เลขที่ใบอนุญาตขับขี่" " size="20" >
        </div>
        <div>
            <input class="message-btn" type="file" name="fileUpload" >
        </div>
        <div class="control-group">
            <div class="controls">
                <button name="submit" id="submit" type="submit" class="message-btn">UPLOAD</button>
            </div>
        </div>
    </form>
    
</body>
</html>


