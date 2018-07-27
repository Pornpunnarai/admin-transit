<?php include 'connect-mysql.php';

$strExcelFileName="Vote-All.xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");

$sql = "select driver_info.*,driver_vote.* from driver_info,driver_vote WHERE driver_info.id=driver_vote.id ORDER BY driver_vote.id ASC";
$query = mysqli_query($objCon, $sql);

?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"xmlns="http://www.w3.org/TR/REC-html40">
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<br>
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
<table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
<thead>
                                            <tr>
                                            	<th><div align="center">ชื่อ</div></th>
                                            	<th><div align="center">นามสกุล</div></th>
                                                <th><div align="center">ทะเบียนรถ</div></th>
                                                <th><div align="center">คะแนน</div></th>
                                                <th><div align="center">comment</div></th>
                                                <th><div align="center">เวลา</div></th>
                                                
                                            </tr> 
                                        </thead>
                                        <tbody>
                                        <?php while($result=mysqli_fetch_array($query,MYSQLI_ASSOC)) { ?>
                                            <tr>
                                            	<td width="120"><?php echo $result['firstname']; ?></td>
                                            	<td width="120"><?php echo $result['lastname']; ?></td>
                                                <td width="80"><div align="center"><?php echo $result['car_id']; ?></div></td>
                                                <td width="30"><div align="center"><?php echo $result['vote']; ?></div></td>
                                                <td width="600"><?php echo $result['comment']; ?></td>
                                                <td width="180"><div align="center"><?php echo $result['timestamp']; ?></div></td>
                                                
                                            </tr>
                                            <?php } ?>
                                        </tbody>
</table>
</div>
<script>
window.onbeforeunload = function(){return false;};
setTimeout(function(){window.close();}, 10000);
</script>
</body>
</html>