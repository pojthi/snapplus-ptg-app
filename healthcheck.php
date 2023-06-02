<?php
require_once './lib/config.php';
require_once './repository/call_api.php';
require_once './lib/function.calss.php';
$fun = new ToolFuntion();
$fun->HttpsRedirect();

$service_url = api_getHealthCheck;
$jsonString = callGetApi($service_url);

echo $jsonString;
?>