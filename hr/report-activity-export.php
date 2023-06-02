<?php
include("../lib/session.php");
include("../lib/config.php");
require_once '../repository/call_api.php';

//if ($s_role_code != role_hr || $s_ad_active !='Active') {header('Location: ../index.php');}
if ($_GET["roleCode"] != role_hr) {header('Location: ../index.php');}

$empid    = isset($_GET['emp'])?$_GET['emp']:"";
$datefrom = isset($_GET['sdate'])?$_GET['sdate']:"";
$dateto   = isset($_GET['edate'])?$_GET['edate']:"";

$service_url = api_getHrActivityLogReport.''.$empid.'/'.$datefrom.'/'.$dateto;
if ($empid != "" && $datefrom != "" && $dateto != "") {
    $jsonString = callGetApi($service_url);
}

$objArray = json_decode($jsonString,true);

$date         = new DateTime("now", new DateTimeZone('Asia/Bangkok') );
$dateWithTime = $date->format('Y-m-d-His');

$strExcelFileName = 'Report-Activity-'.$dateWithTime.'.xls';
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body class="skin-green fixed-layout">
        <table class="table color-table success-table">
                <tr>
                    <td>#</td>
                    <td>วันที่</td>
                    <td>รหัสพนักงาน</td>
                    <td>ฟังชั่นงาน</td>
                    <td>ตำแหน่ง</td>
                </tr>
            <?php
            if ($empid != "" && $datefrom != "" && $dateto != "") {                      
                foreach($objArray['success'] as $i => $item) {                                   
            ?>                                                    
                <tr>
                    <td><?php echo $i+1;?></td>
                    <td><?php echo date('d-m-Y', strtotime($item['AC_DATE']));?></td>
                    <td><?php echo $item['EMP_ID'];?></td>
                    <td><?php echo $item['FUNCTION'];?></td>
                    <td><?php echo $item['POS_CODE_NAME'];?></td>                                            
                </tr>
            <?php
                }//end for
            }//end if
            ?>  												
        </table>
    </body>
</html>