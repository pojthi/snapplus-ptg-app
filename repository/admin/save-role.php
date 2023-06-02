<?php 
include("../../lib/session.php");//first row alway
require_once '../../lib/config.php';
require_once '../call_api.php';


$date = new DateTime("now", new DateTimeZone('Asia/Bangkok') );
$dateWithTime= $date->format('Y-m-d H:i:s');

$roleCode = $_POST["roleCode"];
$roleName = $_POST["roleName"];
$posCode = $_POST["posCode"];

$dataRole = array(
    "RoleParam" => array (
        "roleCode"=> $roleCode,
        "roleName"=> $roleName,
        "posCode"=> $posCode,
        "createdDate"=> $dateWithTime,
        "createdBy"=>  $s_userid
    )
);


$service_url = api_saveRole;
$jsonString = callPostApi($service_url,$dataRole);

if (!$jsonString){
    $retVal = '{"error":"Error message"}';
}else{
    $retVal = $jsonString;
}

echo $retVal;
?>