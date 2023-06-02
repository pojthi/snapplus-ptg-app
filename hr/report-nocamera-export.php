<?php
include("../lib/session.php");
include("../lib/config.php");
include("../lib/convert.class.php");
require_once '../repository/call_api.php';

//if ($s_role_code != role_hr || $s_ad_active !='Active') {header('Location: ../index.php');}
if ($_GET["roleCode"] != role_hr) {header('Location: ../index.php');}

$date        = new DateTime("now", new DateTimeZone('Asia/Bangkok') );
$currentDate = $date->format('d-m-Y');

$datefrom = isset($_GET['sdate'])?$_GET['sdate']:$currentDate;
$dateto   = isset($_GET['edate'])?$_GET['edate']:$currentDate;

$service_url = api_getActivityLogNoCameraReport.$datefrom.'/'.$dateto;

if ($datefrom != "" && $dateto != "") {
    $jsonString = callGetApi($service_url);
}

$objArray = json_decode($jsonString,true);

$date         = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$dateWithTime = $date->format('Y-m-d-His');

$strExcelFileName = 'Report-'.$dateWithTime.'.xls';
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
                    <td>สาขา</td>
                </tr>
            <?php
            if ($datefrom != "" && $dateto != "") {                      
                foreach($objArray['success'] as $i => $item) {                                   
            ?>                                                    
                <tr>
                    <td><?php echo $i+1;?></td>
                    <td><?php echo $item['AC_DATE']; ?></td>
                    <td><?php echo $item['EMP_ID']; ?></td>
                    <td><?php echo $item['FUNCTION']; ?></td>
                    <td><?php echo $item['POS_CODE_NAME']; ?></td>
                    <td><?php echo $item['BRN_CODE_NAME']; ?></td>                                          
                </tr>
            <?php
                }//end for
            }//end if
            ?>  												
        </table>
    </body>
</html>