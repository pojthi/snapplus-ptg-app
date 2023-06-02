<?php 
session_start();
require_once '../../lib/config.php';
require_once '../call_api.php';

$service_url = api_getRoleConfig;
$jsonString  = callGetApi($service_url);

if (!$jsonString) {
    $retVal = '{"error":"Error message"}';
} else {
    $retVal = $jsonString;
}

echo $retVal;
?>