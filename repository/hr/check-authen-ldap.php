<?php 
session_start();
error_reporting(0);
require_once '../../lib/config.php';
require_once '../call_api.php';

$usr    = $_POST["usr"];
$pwd    = $_POST["pwd"];
$camera = $_POST["camera"];

$data = array("AuthenParam" => array ('userName' => $usr,'password' => $pwd));

$service_url = api_getLDAPAuthentication;
$jsonString  = callPostApi($service_url, $data);

if (!$jsonString) {
    $retVal = '{"error":"Error message"}';
} else {
    $retVal = $jsonString;
    $obj    = json_decode($jsonString, true);

    //$_SESSION['empId']       = $obj['success'][0]['uid'];
    //$_SESSION['empFullname'] = $obj['success'][0]['cn'];
    //$_SESSION['adActive']    = 'Active';
    //$_SESSION['camera']      = $camera;
}

echo $retVal;
?>