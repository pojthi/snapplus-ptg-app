<?php 
session_start();
require_once '../../lib/config.php';
require_once '../call_api.php';

$posCode = $_POST["positionName"];

$service_url = api_getEmployeePosByPosCod.''.$posCode;
$jsonString  = callGetApi($service_url);

if (!$jsonString) {
    $retVal = '{"error":"Error message"}';
} else {
    $retVal = $jsonString;
}

echo $retVal;
?>