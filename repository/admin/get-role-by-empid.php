<?php 
session_start();
require_once '../../lib/config.php';
require_once '../call_api.php';

$empId = $_POST["usr"];

$service_url = api_getRoleByEmpId.''.$empId;
$jsonString  = callGetApi($service_url);

if (!$jsonString) {
    $retVal = '{"error":"Error message"}';
} else {
    $retVal = $jsonString;
}

echo $retVal;
?>