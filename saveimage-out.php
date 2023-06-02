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

$date = new DateTime("now", new DateTimeZone('Asia/Bangkok') );
$MMddyy = $date -> format('m-d-Y');
$dateWithTime = $date -> format('Y-m-d H:i:s');
$fun = new ToolFuntion();
$filemgr = new FileManager();

//for show scan in-out; reduce request api
//$_SESSION['dateWithTime'] = $dateWithTime;

if ($get_camera == 'allow') { 
    $filename = $get_userid.'-'.time().'.jpg';
    $filepath = 'upload/'.date("Y").'/'.date("M").'/'.date("d").'/INOUT/';
    $snapImg  = $filepath.$filename;
    
    if (!file_exists($filepath)) {
        mkdir($filepath, 0777, true);
    }
    
    $empId      = "ID : ".$get_userid;	
    $loc        = $get_lat.','.$get_lot;
    //$logMessage = '';
    
    move_uploaded_file($_FILES['webcam']['tmp_name'], $snapImg);
    $filemgr -> createWatermark($snapImg, $empId, $loc);
    $filemgr -> uploadBlob($snapImg);
    unlink($snapImg);

    $logMessage = 'Save-image-out-successful.';

} else {
    $snapImg    = 'assets/icon/noimage.png';
    $logMessage = 'Camera-not-found-!!';
}

/*
$dataActivityLog = array(
    "ActivityLogParam" => array (
        "empId"         => $s_userid,
        "empFullNameTH" => $s_name,
        "brnCode"       => $s_brn_code,
        "brnCodeName"   => $s_brn_name,
        "posCode"       => $s_position_code,
        "posCodeName"   => $s_position_name,
        "stampTime"     => $dateWithTime,
        "func"          => "OUT",
        "snapImg"       => $snapImg,
        "lat"           => $s_lat,
        "lot"           => $s_lot,
        "createdDate"   => $dateWithTime,
        "createdBy"     => $s_userid,
        "logMessage"    => $logMessage        
    )
);

$dataScanTrans = array(
    "ScanTransParam" => array (    
        "userName"    => $s_name,
        "direction"   => "OUT",
        "ipSource"    => $fun -> getClientIP(),
        "qrTime"      => $dateWithTime,
        "lat"         => $s_lat,
        "lot"         => $s_lot,
        "updateTs"    => $dateWithTime,
        "branch"      => $s_brn_name,
        "brnLat"      => $s_brn_lat,
        "brnLot"      => $s_brn_lot,
        "deviceId"    => $fun -> GETMAC_ADDR(),
        "hash"        => $fun -> GUID(),
        "picUrl"      => $snapImg,
        "empId"       => $s_userid,
        "brnCode"     => $s_brn_code,
        "posCode"     => $s_position_code,
        "posCodeName" => $s_position_name,
        "createdDate" => $dateWithTime,
        "createdBy"   => $s_userid
      )
    );

$service_url = api_saveActivityLog;
$jsonString  = callPostApi($service_url, $dataActivityLog);

$service_url = api_saveScanTrans;
$jsonString  = callPostApi($service_url, $dataScanTrans);
*/

//echo str_replace("[PATH_IMG]", $snapImg, SAS_ID);
echo str_replace("[PATH_IMG]", $snapImg, SAS_ID) . "|" . $snapImg . "|" . $logMessage . "|" . $dateWithTime;
?>
