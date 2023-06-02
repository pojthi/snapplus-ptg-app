<?php 
session_start();

$s_userid        = isset($_SESSION['empId'])       ? $_SESSION['empId']       : "";
$s_name          = isset($_SESSION['empFullname']) ? $_SESSION['empFullname'] : "";
$s_position_code = isset($_SESSION['posCode'])     ? $_SESSION['posCode']     : "";
$s_position_name = isset($_SESSION['posName'])     ? $_SESSION['posName']     : "";	
$s_dept_code     = isset($_SESSION['deptCode'])    ? $_SESSION['deptCode']    : "";
$s_dept_name     = isset($_SESSION['deptName'])    ? $_SESSION['deptName']    : "";
$s_lat           = isset($_SESSION['currentLat'])  ? $_SESSION['currentLat']  : "";
$s_lot           = isset($_SESSION['currentLot'])  ? $_SESSION['currentLot']  : "";
$s_status        = isset($_SESSION['lastStatus'])  ? $_SESSION['lastStatus']  : "";
$s_role_code     = isset($_SESSION['roleCode'])    ? $_SESSION['roleCode']    : "";
$s_role_name     = isset($_SESSION['roleName'])    ? $_SESSION['roleName']    : "";
$s_ad_active     = isset($_SESSION['adActive'])    ? $_SESSION['adActive']    : "";
$s_brn_code      = isset($_SESSION['branchCode'])  ? $_SESSION['branchCode']  : "";
$s_brn_name      = isset($_SESSION['branchName'])  ? $_SESSION['branchName']  : "";
$s_brn_lat       = isset($_SESSION['branchLat'])   ? $_SESSION['branchLat']   : "";
$s_brn_lot       = isset($_SESSION['branchLot'])   ? $_SESSION['branchLot']   : "";
$s_camera        = isset($_SESSION['camera'])      ? $_SESSION['camera']      : "allow";

//if(empty($s_userid)) header("Location:index.php");
?>