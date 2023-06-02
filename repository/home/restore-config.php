<?php
    require_once '../../lib/config.php';
    require_once '../../lib/function.calss.php';
    require_once '../call_api.php';
   
    $fun         = new ToolFuntion();
    $mac_address = $fun->GETMAC_ADDR();
    $service_url = api_getActivateBrn.''.$mac_address;
    $jsonString  = callGetApi($service_url);

    if (!$jsonString) {
        $retVal = '{"error":"Error message"}';
    } else {
        $retVal = $jsonString;
    }
    
    echo $retVal;
?>