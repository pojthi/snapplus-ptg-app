<?php
session_start();
require_once '../../lib/config.php';
require_once '../call_api.php';

$date         = new DateTime("now", new DateTimeZone('Asia/Bangkok') );
$dateWithTime = $date->format('d-m-Y');

$userid     = $_POST["userid"];//'000145';
$currentLat = $_POST["currentLat"];
$currentLot = $_POST["currentLot"];
$branchName = $_POST["brn"];
$branchCode = $_POST["brncode"];
$branchLat  = $_POST["brnLat"];
$branchLot  = $_POST["brnLot"];
$camera     = $_POST["camera"];

$service_url = api_getEmployeeBrnDetailByEmpId.''.$userid;
$jsonString  = callGetApi($service_url);

if (!$jsonString) {
    $retVal = '{"error":"Error message"}';
} else {
    $retVal = $jsonString;
    $obj    = json_decode($jsonString,true);

    $arr = $obj['success'];
    
    //$_SESSION['empId']       = $arr[0]['EMP_ID'];
    //$_SESSION['empFullname'] = $arr[0]['EMP_FULLNAME_TH'];
    //$_SESSION['posCode']     = $arr[0]['POS_CODE'];
    //$_SESSION['posName']     = $arr[0]['POS_NAME_TH'];
    //$_SESSION['deptCode']    = $arr[0]['DEPT_CODE'];
    //$_SESSION['deptName']    = $arr[0]['DEPT_NAME_TH'];
    //$_SESSION['lastStatus']  = $arr[0]['DIRECTION'];
    //$_SESSION['roleCode']    = $arr[0]["ROLE_CODE"];
    //$_SESSION['roleName']    = $arr[0]["ROLE_NAME"];
    //$_SESSION['currentLat']  = $currentLat;
    //$_SESSION['currentLot']  = $currentLot;
    //$_SESSION['branchName']  = $branchName;
    //$_SESSION['branchCode']  = $branchCode;
    //$_SESSION['branchLat']   = $branchLat;
    //$_SESSION['branchLot']   = $branchLot;
    //$_SESSION['camera']      = $camera;
}

echo $retVal;
?>