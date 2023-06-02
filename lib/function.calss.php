<?php
class ToolFuntion {

    public function getClientIP() {

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) { //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    public function GUID() {

        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }
    
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public function GETMAC_ADDR() {
        $MAC = exec('getmac'); 
        $MAC = strtok($MAC, ' '); 

        return $MAC;
    }

    function HttpsRedirect() {
      // if ($_SERVER['SERVER_NAME'] !='localhost'){
      //     if($_SERVER['SERVER_PORT'] != 443)
      //     {
      //         $redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
      //         header("Location:$redirect");
      //     } 
      // }
    } 
    
}//end class
?>