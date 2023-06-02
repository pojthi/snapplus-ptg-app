<?php
session_start();
error_reporting(0);
require_once '../../lib/config.php';
require_once '../call_api.php';

$emp_id      = $_POST["emp_id"];
$emp_name    = $_POST["emp_name"];
$pos_code    = $_POST["pos_code"];
$pos_name    = $_POST["pos_name"];
$branch_code = $_POST["branch_code"];
$branch_name = $_POST["branch_name"];
$datefrom    = $_POST["datefrom"];
$dateto      = $_POST["dateto"];

$dataObj = array(   
    "TempStaffParam" => array (
        "EMP_ID"=> $emp_id,
        "EMP_FULLNAME_TH"=> $emp_name,
        "POS_CODE"=> $pos_code,
        "POS_NAME_TH"=> $pos_name,
        "DEPT_CODE"=> $branch_code,
        "DEPT_NAME_TH"=> $branch_name,
        "START_DATE"=> $datefrom,
        "END_DATE"=> $dateto
    ) 
);

$service_url = api_saveTempStaff;

$jsonString = callPostApi($service_url,$dataObj);

if (!$jsonString) {
    $retVal = '{"error":"Error message"}';
} else {
    $retVal = $jsonString;
}

echo $retVal;
?>