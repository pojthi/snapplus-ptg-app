<?php
include("../lib/session.php");
include("../lib/config.php");
include("../lib/convert.class.php");
require_once '../repository/call_api.php';

//if ($s_role_code != role_hr || $s_ad_active !='Active') {header('Location: ../index.php');}
if ($_GET["roleCode"] != role_hr) {header('Location: ../index.php');}

$keyword = isset($_GET['keyword'])?$_GET['keyword']:"ALL";

$service_url = api_getlistTempStaff.''.urlencode($keyword);

$jsonString = callGetApi($service_url);
$objArray   = json_decode($jsonString, true);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("../includes/head.php");?>   
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
                            <h4 class="text-themecolor">ข้อมูล พนักงาน [ ชั่วคราว ] </h4>
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
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h5>คำค้น</h5>
                                            <input type="text" id="txtkeyword" name="txtkeyword" class="form-control" placeholder="คำค้น เช่น ชื่อ , นามสกุล ,รหัสพนักงาน" /> 
                                        </div>      
                                        <div class="col-md-3">                                        
                                            <h5>&nbsp;</h5>
                                            <p onclick='eventSearchClick()' id="btnSearch" name="btnSearch" class="btn btn-info"><i class="fa fa-search"></i> ค้นหา</p>                                        
                                        </div> 	                                                                                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">                                
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <!--
                                                <p onClick='window.location.href = "tempstaff-add.php";' id="btnAdd" name="btnSearch" class="btn btn-info"><i class="mdi mdi-account-plus"></i> เพิ่มข้อมูล</p>    
                                                -->
                                                <p onClick="linkTempStaffAdd()" id="btnAdd" name="btnSearch" class="btn btn-info"><i class="mdi mdi-account-plus"></i> เพิ่มข้อมูล</p> 
                                                <table class="table color-table success-table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>รหัสพนักงาน</th>
                                                            <th>พนักงาน</th>
                                                            <th>ตำแหน่ง</th>
                                                            <th>สาขา</th>
                                                            <th>วันที่เริ่ม</th>
                                                            <th>วันที่สิ้นสุด</th>
                                                            <th>แก้ไข</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php                   
                                                        foreach($objArray['success'] as $i => $item) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i+1;?></td>
                                                            <td><?php echo $item['EMP_ID']; ?></td>
                                                            <td><?php echo $item['EMP_FULLNAME_TH']; ?></td>
                                                            <td><?php echo $item['POS_NAME_TH']; ?></td>
                                                            <td><?php echo $item['DEPT_NAME_TH']; ?></td>
                                                            <td><?php echo date('d-m-Y', strtotime($item['START_DATE']));?></td>
                                                            <td><?php echo date('d-m-Y', strtotime($item['END_DATE']));?></td>
                                                            <!--
                                                            <td><a href="tempstaff-edit.php?empid=<?php echo $item['EMP_ID']; ?>"><i class="fas fa-pencil-alt"></i></a></td>
                                                            -->
                                                            <td><a href="javascript:linkTempStaffEdit('<?php echo $item['EMP_ID']; ?>')"><i class="fas fa-pencil-alt"></i></a></td>
                                                        </tr>
                                                    <?php
                                                        }//end for                                                   
                                                    ?>  												
                                                    </tbody>
                                                </table>
                                            </div>									
                                        </div>								
                                    </div>
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

    <script type="text/javascript">

        function eventSearchClick() { 
            var txtkeyword = $("#txtkeyword").val();      
            if (txtkeyword == "") txtkeyword="ALL";
            window.location.href = "?keyword=" + txtkeyword + "&roleCode=" + localStorage.getItem('roleCode') + '&fullName=' + localStorage.getItem('empFullname');
        }

        function linkTempStaffAdd() {
            window.location.href = 'tempstaff-add.php?' + 'roleCode=' + localStorage.getItem('roleCode') + '&fullName=' + localStorage.getItem('empFullname');
        }

        function linkTempStaffEdit(empId) {
            window.location.href = 'tempstaff-add.php?empid=' + empId + '&roleCode=' + localStorage.getItem('roleCode') + '&fullName=' + localStorage.getItem('empFullname');
        }
    </script>    
    </body>

</html>