<?php

require_once 'lib/config.php';
require_once 'repository/call_api.php';
require_once 'lib/function.calss.php';

$empId       = $_POST["empId"];
$empFullname = $_POST["empFullname"];
$posCode     = $_POST["posCode"];
$posName     = $_POST["posName"];
$deptCode    = $_POST["deptCode"];
$deptName    = $_POST["deptName"];
$currentLat  = $_POST["currentLat"];
$currentLot  = $_POST["currentLot"];
$roleCode    = $_POST["roleCode"];
$roleName    = $_POST["roleName"];
$branchCode  = $_POST["branchCode"];
$branchName  = $_POST["branchName"];
$branchLat   = $_POST["branchLat"];
$branchLot   = $_POST["branchLot"];
$camera      = $_POST["camera"];
$snapImg     = $_POST["snapImg"];
$logMessage  = $_POST["logMessage"];
$dateWithTime = $_POST["dateWithTime"];

//$date = new DateTime("now", new DateTimeZone('Asia/Bangkok') );
//$MMddyy = $date->format('m-d-Y');
//$dateWithTime = $date->format('Y-m-d H:i:s');
$fun = new ToolFuntion();

$dataActivityLog = array(    
    "ActivityLogParam"  => array (
        "empId"         => $empId,
        "empFullNameTH" => $empFullname,
        "brnCode"       => $branchCode,
        "brnCodeName"   => $branchName,
        "posCode"       => $posCode,
        "posCodeName"   => $posName,
        "stampTime"     => $dateWithTime,
        "func"          => "IN",
        "snapImg"       => $snapImg,
        "lat"           => $branchLat,
        "lot"           => $branchLot,
        "createdDate"   => $dateWithTime,
        "createdBy"     => $empId,
        "logMessage"    => $logMessage
    )   
);

$dataScanTrans = array(
    "ScanTransParam" => array (    
        "userName"    => $empFullname,
        "direction"   => "IN",
        "ipSource"    => $fun->getClientIP(),
        "qrTime"      => $dateWithTime,
        "lat"         => $branchLat,
        "lot"         => $branchLot,
        "updateTs"    => $dateWithTime,
        "branch"      => $branchName,
        "brnLat"      => $branchLat,
        "brnLot"      => $branchLot,
        "deviceId"    => $fun->GETMAC_ADDR(),
        "hash"        => $fun->GUID(),
        "picUrl"      => $snapImg,
        "empId"       => $empId,
        "brnCode"     => $branchCode,
        "posCode"     => $posCode,
        "posCodeName" => $posName,
        "createdDate" => $dateWithTime,
        "createdBy"   => $empId
    )
);

$service_url = api_saveActivityLog;
$jsonString  = callPostApi($service_url, $dataActivityLog);

$service_url = api_saveScanTrans;
$jsonString  = callPostApi($service_url, $dataScanTrans); 

echo $dateWithTime;

?>