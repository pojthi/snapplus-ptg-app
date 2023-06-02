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

$dataActivityLog = array(
    "ActivityLogParam" => array (
        "empId"         => $empId,
        "empFullNameTH" => $empFullname,
        "brnCode"       => $branchCode,
        "brnCodeName"   => $branchName,
        "posCode"       => $posCode,
        "posCodeName"   => $posName,
        "stampTime"     => $dateWithTime,
        "func"          => 'REPORT',
        "snapImg"       => $snapImg,
        "lat"           => $branchLat,
        "lot"           => $branchLot,
        "createdDate"   => $dateWithTime,
        "createdBy"     => $empId,
        "logMessage"    => $logMessage
    )
);

$service_url = api_saveActivityLog;
$jsonString  = callPostApi($service_url, $dataActivityLog);

echo $dateWithTime;
?>