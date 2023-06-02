<?php 
session_start();
require_once '../../lib/config.php';
require_once '../call_api.php';

$brnName = urlencode($_POST["branchName"]);//urlencode('สถานีบริการ');//

$service_url = api_getBranchByName.''.$brnName;
$jsonString  = callGetApi($service_url);

if (!$jsonString){
    $retVal = '{"error":"Error message"}';
} else {
    $retVal = $jsonString;
}

echo $retVal;
?>