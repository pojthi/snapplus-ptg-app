<?php
date_default_timezone_set("Asia/Bangkok");
error_reporting(E_ALL ^ E_NOTICE);

define("C_COMPANY","PTG.CO.TH");	
### [PRD]
define("Account_Storage", "timeattendancestorage");
define("Account_Key", "nmgr95o1qtnKngLDzpcnyCHGOq+27dCqChjNN66j+5g2N25e4FU+fBeKyBnc8zljGvmkGAeRtAV86yzWH4Pkbg==");
define("Azure_Blob_Container", "pt-hr-time-attendance");
define("SAS_TOKEN", "sp=r&st=2021-02-22T06:08:34Z&se=2050-02-22T14:08:34Z&spr=https&sv=2020-02-10&sr=c&sig=Ool7aiVTgoKakZSS%2BPgspt8jPGsRwElo8sICcW9cw3I%3D");

### [UAT]
#define("Account_Storage","uattimeattendancestg");
#define("Account_Key","DGqYYv6t1ulxDzvxYsDOWJEqSKqRf+gbDxmVOwohW4tqSNfQNLPK6yEJz6RQf07AGh0bzDip3UuG+AStsR2uWA==");
#define("Azure_Blob_Container","pt-hr-time-attendance-uat");
#define("SAS_TOKEN","sp=racw&st=2022-08-29T05:11:12Z&se=2023-12-31T13:11:12Z&spr=https&sv=2021-06-08&sr=c&sig=jDv5hyRk0wtpV2bjThgL%2BmMcouYtfJS01%2BpgJ8Eu7Ew%3D");

define("SAS_ID","https://" . Account_Storage . ".blob.core.windows.net/" . Azure_Blob_Container . "/[PATH_IMG]?" . SAS_TOKEN);	
define("Azure_Blob_Conenction","DefaultEndpointsProtocol=https;AccountName=" . Account_Storage . ";AccountKey=" . Account_Key );

define("role_operation","EMPLOYEE");
define("role_manager","MANAGER");
define("role_hr","HRADMIN");
define("role_config","ITADMIN");

#local
#$apiUrl = "http://localhost:8088/";
#SIT / DEV /PILOT
#$apiUrl = "https://ta-web-api.azurewebsites.net/";

## [Production]
$apiUrl = "https://timeattendance-api.pt.co.th/";

## [PRD]
#$apiUrl = "https://prod-timeattendance-api-asv.azurewebsites.net/";

## [UAT]
//$apiUrl = "https://uat-timeattendance-api-asv.azurewebsites.net/";
//$apiUrl = "https://uat-timeattendance-api.azurewebsites.net/";
//$apiUrl = "https://uat2-timeattendance-api.azurewebsites.net/";

define("Api_Auth_USER","snapluzz");
define("Api_Auth_PWD","NTnWphrRuT06C1xtwgDJfg");

#for Monitoring
#$apiUrl = "https://ta-web-api-for-mornitor.azurewebsites.net/";

define("api_getBranchByName",$apiUrl . "api/findBranchByNameList/");
define("api_getEmployeeBrnDetailByEmpId",$apiUrl . "api/getEmployeeBrnDetailByEmpId/");
define("api_getLDAPAuthentication",$apiUrl . "api/authenticate");
define("api_getScanTransDetail",$apiUrl . "api/getScanTransDetail/");
define("api_getEmployeePosByPosCod",$apiUrl . "api/findEmployeePosByPosCode/");
define("api_getEmployeePosByPosName",$apiUrl . "api/findEmployeePosByPosName/");
define("api_saveActivityLog",$apiUrl . "api/saveActivityLog");
define("api_saveScanTrans",$apiUrl . "api/saveScanTrans");
define("api_saveActivateBrn",$apiUrl . "api/saveActivateBrn");
define("api_saveRole",$apiUrl . "api/saveRole");
define("api_getScanTransReport",$apiUrl . "api/getScanTransReport/");
define("api_getEmployeeUnderByEmpId",$apiUrl . "api/getEmployeeUnderByEmpId/");
define("api_getHrActivityLogReport",$apiUrl . "api/getActivityLogReport/");
define("api_getRoleConfig",$apiUrl . "api/getRoleConfigList");
define("api_getRoleByEmpId",$apiUrl . "api/getRoleByEmpId/");
define("api_getActivityLogNoCameraReport",$apiUrl . "api/getActivityLogNoCameraReport/");
define("api_getHealthCheck",$apiUrl . "api/getHealthCheck/");

define("api_getReportScanByEmployeeId",$apiUrl . "api/getReportScanByEmployeeId/");
define("api_getReportScanByManagerId",$apiUrl . "api/getReportScanByManagerId/");
define("api_getActivateBrn",$apiUrl . "api/getActivateBrn/");

define("api_getlistTempStaff",$apiUrl . "api/listTempStaff/");
define("api_getTempStaff",$apiUrl . "api/getTempStaff/");
define("api_saveTempStaff",$apiUrl . "api/saveTempStaff");
define("api_updateTempStaff",$apiUrl . "api/updateTempStaff");
?>