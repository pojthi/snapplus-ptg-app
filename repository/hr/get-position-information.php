<?php 
session_start();
error_reporting(0);
require_once '../../lib/config.php';
require_once '../call_api.php';

$posName = urlencode($_POST["positionName"]);

$service_url = api_getEmployeePosByPosName.''.$posName;
$jsonString  = callGetApi($service_url);

if (!$jsonString) {
    $retVal = '{"error":"Error message"}';
} else {
    $retVal = $jsonString;
}

echo $retVal;
?>