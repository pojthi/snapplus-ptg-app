<?php

include("lib/session.php");//first row alway
require_once 'lib/config.php';
require_once 'lib/function.calss.php';
require_once 'lib/filemanager.class.php';
require_once 'repository/call_api.php';

$get_userid = $_GET["empId"]; 
$get_lat    = $_GET["lat"];
$get_lot    = $_GET["lot"];
$get_camera = $_GET["cam"];

$date         = new DateTime("now", new DateTimeZone('Asia/Bangkok') );
$MMddyy       = $date -> format('m-d-Y');
$dateWithTime = $date -> format('Y-m-d H:i:s');
$fun          = new ToolFuntion();
$filemgr      = new FileManager();

if ($get_camera == 'allow') {       
    
    $filename =  $get_userid.'-'.time().'.jpg';
    $filepath = 'upload/'.date("Y").'/'.date("M").'/'.date("d").'/INOUT/';
    $snapImg  = $filepath.$filename;

    if (!file_exists($filepath)) {
        mkdir($filepath, 0777, true);
    }
  
    $empId      = "ID : ".$get_userid;		
    $loc        = $get_lat.','.$get_lot;
        
    move_uploaded_file($_FILES['webcam']['tmp_name'], $snapImg);
    $filemgr -> createWatermark($snapImg, $empId, $loc);
    $filemgr -> uploadBlob($snapImg);
    unlink($snapImg);

    $logMessage = 'Save-image-in-successful.';

} else {    
    $snapImg    = 'assets/icon/noimage.png';
    $logMessage = 'Camera-not-found-!!';
}

echo str_replace("[PATH_IMG]", $snapImg, SAS_ID) . "|" . $snapImg . "|" . $logMessage . "|" . $dateWithTime;

?>  