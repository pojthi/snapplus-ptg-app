<?php 
/*
//require_once '../lib/config.php';
//require_once '../lib/logger.php';
*/

//include("../lib/config.php");
//include("../lib/logger.php");

error_reporting(0);

//$apiUser = Api_Auth_USER;
//$apiPwd  = Api_Auth_PWD;
//$logger  = getLogger();

function callGetApi($service_url) {
    
    //$logger->info("callGetApi => " . $service_url);
    /*
    $stream_opts = [
      "ssl" => ["verify_peer"=>false,"verify_peer_name"=>false,]
    ];
    $retVal = file_get_contents($service_url, false, stream_context_create($stream_opts));
    */
    $apiUser = "snapluzz";
    $apiPwd  = "NTnWphrRuT06C1xtwgDJfg";
    $options = array( 'ssl'  => array("verify_peer" => false,
                                       "verify_peer_name" => false),
                      'http' => array('method'  => "GET",
                                      'header'  => "Content-Type: application/json\r\n" .
                                                   "Accept: application/json\r\n" .
                                                   "Authorization: Basic " . base64_encode("$apiUser:$apiPwd"),
                                      'timeout' => 120 )
                    );     
    $context = stream_context_create($options);
    $retVal = file_get_contents($service_url, false, $context);

    return $retVal;
}
 
function callPostApi($service_url, $data) {
    
    //$logger->info("callPostApi => " . $service_url);
    $apiUser = "snapluzz";
    $apiPwd  = "NTnWphrRuT06C1xtwgDJfg";
    $options = array('http' => array('method'  => 'POST',
                                     'content' => json_encode($data),
                                     'header'  => "Content-Type: application/json\r\n" .
                                                  "Accept: application/json\r\n" .
                                                  "Authorization: Basic " . base64_encode("$apiUser:$apiPwd"),
                                      'timeout' => 120 )
                    );     
    $context = stream_context_create($options);
    $retVal  = file_get_contents($service_url, true, $context);     
      
    return $retVal;
}
?>