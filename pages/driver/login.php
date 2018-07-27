<!DOCTYPE html>
<html>
<head>
	<title>ลงทะเบียนคนขับรถแดง</title>
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
                </div>
                <div class="map-wrapper">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="span contact-form centered">
                                <h3>เข้าระบบ</h3>
                                <form action="check.php" method="post" enctype="multipart/form-data" name="form1">
                                    <div>
                                        <input class="span4" name="txtUsername" type="text" id="txtUsername" placeholder="User Name" " size="20" >
                                    </div>
                                    <div>
                                        <input class="span4" name="txtPassword" type="text" id="txtPassword" placeholder="Password" " size="20" >
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <button name="submit" id="submit" type="submit" class="message-btn">Log in</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--?php include 'form_vote.php'; echo create_vote(2);?-->

</body>
</html>


