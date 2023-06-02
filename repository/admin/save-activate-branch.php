<?php
include("../../lib/session.php");//first row alway
require_once '../../lib/config.php';
require_once '../../lib/function.calss.php';
require_once '../call_api.php';

$fun = new ToolFuntion();
$date = new DateTime("now", new DateTimeZone('Asia/Bangkok') );
$dateWithTime= $date->format('Y-m-d H:i:s');

$brnCode = $_POST["brnCode"];
$brnName = $_POST["brnName"];

$dataActivityLog = array(   
    "ActivateBrnParam" => array (
        "brnCode"=> $brnCode,
        "brnName"=> $brnName,
        "macAddr"=> $fun->GETMAC_ADDR(),
        "lat"=> $s_lat,
        "lot"=> $s_lot,
        "createdDate"=> $dateWithTime,
        "createdBy"=>  $s_userid
    ) 
);

$service_url = api_saveActivateBrn;
$jsonString = callPostApi($service_url,$dataActivityLog);

if (!$jsonString){
    $retVal = '{"error":"Error message"}';
}else{
    $retVal = $jsonString;
}

echo $retVal;
?>