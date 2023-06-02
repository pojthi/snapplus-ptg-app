<?php
include("../lib/session.php");
include("../lib/config.php");
require_once '../repository/call_api.php';

$userId = $_GET['userId'];
$role   = $_GET['role'];

//if ($s_role_code != role_manager || $s_ad_active != 'Active') {header('Location: ../index.php');}
if ($role != role_manager) {header('Location: ../index.php');}

$empid    = isset($_GET['emp'])  ? $_GET['emp']   : "";
$datefrom = isset($_GET['sdate'])? $_GET['sdate'] : "";
$dateto   = isset($_GET['edate'])? $_GET['edate'] : "";

if (strlen($empid) > 0 && strlen($datefrom) > 0 && strlen($dateto) > 0) {
    if ($empid == "ALL") {
        //$service_url = api_getReportScanByManagerId.''.$s_userid.'/'.$datefrom.'/'.$dateto;
        $service_url = api_getReportScanByManagerId.''.$userId.'/'.$datefrom.'/'.$dateto;
    } else {
        $service_url = api_getReportScanByEmployeeId.''.$empid.'/'.$datefrom.'/'.$dateto;
    }
    $jsonString = callGetApi($service_url);
}

$objArray = json_decode($jsonString, true);

$date         = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
$dateWithTime = $date -> format('Y-m-d-His');

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
                    <td>สาขา</td>
                    <td>รหัสพนักงาน</td>
                    <td>พนักงาน</td>
                    <td>ตำแหน่ง</td>
                    <td>IN/OUT</td>
                    <td>เวลา</td>
                </tr>
            <?php
            if ($empid != "" && $datefrom != "" && $dateto != "") {                      
                foreach($objArray['success'] as $i => $item) {                                   
            ?>                                                    
                <tr>
                    <td><?php echo $i+1;?></td>
                    <td><?php echo $item['BRANCH']; ?></td>
                    <td><?php echo $item['EMP_ID']; ?></td>
                    <td><?php echo $item['USERNAME']; ?></td>
                    <td><?php echo $item['POS_CODE_NAME']; ?></td>
                    <td><?php echo $item['DIRECTION']; ?></td>
                    <td><?php echo $item['QRTIME']; ?></td>                                              
                </tr>
            <?php
                }//end for
            }//end if
            ?>  												
        </table>
    </body>
</html>