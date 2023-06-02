<?php
include("../lib/session.php");
include("../lib/config.php");
include("../lib/convert.class.php");
require_once '../repository/call_api.php';

//if ($s_role_code != role_hr || $s_ad_active !='Active') {header('Location: ../index.php');}
if ($_GET["roleCode"] != role_hr) {header('Location: ../index.php');}

$empid = isset($_GET['empid'])?$_GET['empid']:"";

$service_url = api_getTempStaff.''.$empid;

$jsonString = callGetApi($service_url);
$objArray   = json_decode($jsonString, true);

foreach($objArray['success'] as $i => $item) {
    $emp_id      = $item['EMP_ID'];
    $emp_name    = $item['EMP_FULLNAME_TH'];
    $pos_name    = $item['POS_NAME_TH'];
    $pos_code    = $item['POS_CODE'];
    $branch_name = $item['DEPT_NAME_TH'];
    $branch_code = $item['DEPT_CODE'];
    $dateval     = $item['START_DATE'].' to '.$item['END_DATE'];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("../includes/head.php");?> 
        <style>
        .ui-autocomplete {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 160px;
            padding: 5px 0;
            margin: 2px 0 0;
            list-style: none;
            font-size: 14px;
            text-align: left;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            background-clip: padding-box;
        }
        .ui-autocomplete > li > div {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: normal;
            line-height: 1.42857143;
            color: #333333;
            white-space: nowrap;
        }
        .ui-state-hover,
        .ui-state-active,
        .ui-state-focus {
            text-decoration: none;
            color: #262626;
            background-color: #f5f5f5;
            cursor: pointer;
        }
        .ui-helper-hidden-accessible {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }
        </style>	
    </head>

    <body class="skin-green fixed-layout">
        
        <?php include("../includes/preloader.php");?>

        <div id="main-wrapper">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <header class="topbar">
                <?php include("../includes/header.php");?>
            </header>
            <!-- ============================================================== -->
            <!-- End Topbar header -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <aside class="left-sidebar">
                <?php include("../includes/left-sidebar.php");?>
            </aside>
            <!-- Page wrapper  -->
            <!-- ============================================================== -->
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <!-- Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->
                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h4 class="text-themecolor">แก้ไข ข้อมูล พนักงาน [ ชั่วคราว ] </h4>
                        </div>
                        <div class="col-md-7 align-self-center text-right">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active">พนักงาน [ ชั่วคราว ]</li>
                                </ol>
                                
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- Start Page Content -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="frm" name="frm" method="post" autocomplete="off">	
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">     
                                                <label>รหัสพนักงาน</label>
                                                <input type="number" id="txtemp_id" name="txtemp_id" value="<?php echo $emp_id;?>" maxlength="8" class="form-control" placeholder="รหัสพนักงาน" readonly /> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>ชื่อ - นามสกุล</label>
                                                <input type="text" id="txtemp_name" name="txtemp_name" value="<?php echo $emp_name;?>" class="form-control" placeholder="ชื่อ - นามสกุล" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>ตำแหน่ง</label>
                                                <input type="text" id="txtpos_name" name="txtpos_name" value="<?php echo $pos_name;?>" class="form-control" placeholder="ตำแหน่ง" /> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>รหัสตำแหน่ง</label>
                                                <input type="text" id="txtpos_code" name="txtpos_code" value="<?php echo $pos_code;?>" class="form-control" placeholder="รหัสตำแหน่ง" readonly /> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>สาขา</label>
                                                <input type="text" id="txtbranch_name" name="txtbranch_name" value="<?php echo $branch_name;?>" class="form-control" placeholder="สาขา" /> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>รหัสสาขา</label>
                                                <input type="text" id="txtbranch_code" name="txtbranch_code" value="<?php echo $branch_code;?>" class="form-control" placeholder="รหัสสาขา" readonly /> 
                                            </div>
                                        </div>
                                    </div>								
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>วันที่เริ่มต้น  - วันที่สิ้นสุด</label>
                                                <input id="txtdate" type='text' value="<?php echo $dateval;?>" class="form-control dateLimit" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">  
                                                <p onClick="eventClick()" id="btnAdd" name="btnAdd" class="btn btn-success"><i class="fas fa-save"></i> บันทึก</p>&nbsp;
                                                <!--
                                                <p onclick='window.location.href = "tempstaff.php";' id="btnCancel" name="btnCancel" class="btn btn-warning"><i class="far fa-times-circle"></i> ยกเลิก</p>
                                                --> 
                                                <p onClick="linkTempStaffFromEdit()" id="btnCancel" name="btnCancel" class="btn btn-warning"><i class="far fa-times-circle"></i> ยกเลิก</p> 
                                            </div>
                                        </div>
                                    </div>									
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End PAge Content -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include("../includes/footer-be.php");?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <?php include("../includes/javascripts.php");?>

        <script>
            var arrData = [];
            var mappingPositionCode = { };
            var mappingBranchCode = { };
            
            $('.dateLimit').daterangepicker({
                dateLimit: {            
                    days: 150
                },     
                locale: {
                    format: 'DD-MM-YYYY',
                    separator: " to "
                },
            });
            
        $(function() {

            $("#txtpos_name").autocomplete({
                
            source: function( request, response ) {
                $.post("../repository/hr/get-position-information.php", {positionName: $("#txtpos_name").val()}, function(result){			
                        let ret = jQuery.parseJSON(result);
                        arrData = [];

                        $.each(ret, function(index,item) {                     
                            $.each(item, function(data) {
                                $str = item[data].NAMPOST;
                                arrData.push($str);    
                                mappingPositionCode[$str] = item[data].CODPOS;
                            }); 
                        });
                        response(arrData); 
                    
                });        

                },minLength: 2,
                select: function (event, ui) {
                    $("#txtpos_code").val(mappingPositionCode[ui.item.value]);
                }       
            
                } 
                );
                
            } //end auto complete	
        ); //end function
        $(function() {	
            $("#txtbranch_name").autocomplete({                
                source: function( request, response ) {
                    $.post("../repository/hr/get-branch-information.php", {branchName: $("#txtbranch_name").val()}, function(result){			
                            let ret = jQuery.parseJSON(result);
                            arrData = [];

                            $.each(ret, function(index,item) {                     
                                $.each(item, function(data) {
                                    arrData.push(item[data].BRN_NAME);    
                                    mappingBranchCode[item[data].BRN_NAME] = item[data].BRN_CODE;
                                }); 
                            });
                            response(arrData);
                    });
                    },minLength: 2,
                    select: function (event, ui) {
                        $("#txtbranch_code").val(mappingBranchCode[ui.item.value]);	 
                    }            
                } 
            );
                
        } //end auto complete	
        ); //end function
        </script> 
        <!-- End Validate Input -->
        <script>
        function eventClick() {
            var txtemp_id      = $("#txtemp_id").val();
            var txtemp_name    = $("#txtemp_name").val();
            var txtpos_name    = $("#txtpos_name").val();
            var txtpos_code    = $("#txtpos_code").val();
            var txtbranch_name = $("#txtbranch_name").val();
            var txtbranch_code = $("#txtbranch_code").val();
            var dateVal        = $("#txtdate").val();
            var txtfromDate    = dateVal.substring(0, 10);
            var txttoDate      = dateVal.substring(14);	
                        
            //validate
            if (txtemp_id.length >= 5 && txtbranch_code.length > 0 && txtpos_code.length > 0) {
                $.post("../repository/hr/update-tempstaff.php", 
                {emp_id: txtemp_id,
                 emp_name: txtemp_name,
                 pos_code: txtpos_code, pos_name: txtpos_name, branch_code: txtbranch_code,
                 branch_name: txtbranch_name, datefrom: txtfromDate, dateto: txttoDate}, 
                function(result){
                    let response = jQuery.parseJSON(result);                
                    $.each(response, function(index) {
                        $status =index ;
                    });
                    try {
                        if($status =='success'){
                            Swal.fire({
                                title: "บันทึกข้อมูลสำเร็จ",
                                timer: 10000,
                                showConfirmButton: true,
                                    onClose: () => {
                                        //window.location.href = 'tempstaff.php';
                                        window.location.href = 'tempstaff.php?' + 'roleCode=' + localStorage.getItem('roleCode') + '&fullName=' + localStorage.getItem('empFullname');
                                    }
                            });	
                        }
                    } catch(err) {
                        Swal.fire({
                            title: "บันทึกข้อมูลไม่สำเร็จ",
                            text: err,
                            timer: 10000,
                            showConfirmButton: true,
                                onClose: () => {
                                }
                        });	
                    }            
                });
            } else {
                Swal.fire({
                    title: "บันทึกข้อมูลไม่สำเร็จ",
                    text: "กรุณากรอกข้อมูลให้ครบถ้วนและถูกต้อง",
                    timer: 10000,
                    showConfirmButton: true,
                        onClose: () => {
                        }
                });			
            }	    
        }

        function linkTempStaffFromEdit() {
            window.location.href = "tempstaff.php?" + "roleCode=" + localStorage.getItem('roleCode') + '&fullName=' + localStorage.getItem('empFullname');
        }
        </script>
    </body>
</html>