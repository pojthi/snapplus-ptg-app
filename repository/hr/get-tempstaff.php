<?php 
session_start();
error_reporting(0);
require_once '../../lib/config.php';
require_once '../call_api.php';

$emp_id = $_POST["emp_id"];

$service_url = api_getTempStaff.''.$emp_id;
$jsonString  = callGetApi($service_url);

if (!$jsonString) {
    $retVal = '{"error":"Error message"}';
} else {
    $retVal = $jsonString;
}

echo $retVal;
?>