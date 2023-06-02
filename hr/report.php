<?php
include("../lib/session.php");
include("../lib/config.php");
include("../lib/convert.class.php");
require_once '../repository/call_api.php';

//if ($s_role_code != role_hr || $s_ad_active !='Active') {header('Location: ../index.php');}
if ($_GET["roleCode"] != role_hr) {header('Location: ../index.php');}

$date        = new DateTime("now", new DateTimeZone('Asia/Bangkok') );
$currentDate = $date->format('d-m-Y');

$empid    = isset($_GET['emp'])?$_GET['emp']:"";
$datefrom = isset($_GET['sdate'])?$_GET['sdate']:$currentDate;
$dateto   = isset($_GET['edate'])?$_GET['edate']:$currentDate;

$service_url = api_getScanTransReport.''.$empid.'/'.$datefrom.'/'.$dateto;

if ($empid != "" && $datefrom != "" && $dateto != "") {
    $jsonString = callGetApi($service_url);
}

$objArray = json_decode($jsonString,true);
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
                            <h4 class="text-themecolor">Report</h4>
                        </div>
                        <div class="col-md-7 align-self-center text-right">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active">ลงเวลาพนักงาน</li>
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
                                            <h5>พนักงาน</h5>
                                            <input type="text" id="empId" name="empId" value="<?php echo $empid;?>" class="form-control" placeholder="รหัสพนักงาน" maxlength="8"/> 
                                        </div>    
                                        <div class="col-md-3">
                                            <h5>วันที่เริ่มต้น - สิ้นสุด</h5>
                                            <input id="txtdate" type='text' value="<?php echo $datefrom.' to '.$dateto;?>" class="form-control dateLimit" readonly />
                                        </div>   
                                        <div class="col-md-3">                                        
                                            <h5>&nbsp;</h5>
                                            <p onclick='eventSearchClick()' id="btnSearch" name="btnSearch" class="btn btn-info"><i class="fa fa-search"></i> ดูรายงาน</p>
                                            <p onclick='eventExportClick()' id="btnExport" name="btnExport" class="btn btn-info"><i class="fas fa-file-excel"> </i> Export Excel</p>
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
                                                <table class="table color-table success-table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>สาขา</th>
                                                            <th>รหัสพนักงาน</th>
                                                            <th>พนักงาน</th>
                                                            <th>ตำแหน่ง</th>
                                                            <th>IN/OUT</th>
                                                            <th>เวลา</th>
                                                            <th>รูปภาพ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if ($empid != "" && $datefrom != "" && $dateto != "") {                      
                                                        foreach($objArray['success'] as $i => $item) {
                                                            $pic_url = str_replace("[PATH_IMG]",$item['PIC_URL'],SAS_ID);
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i+1;?></td>
                                                            <td><?php echo $item['BRANCH']; ?></td>
                                                            <td><?php echo $item['EMP_ID']; ?></td>
                                                            <td><?php echo $item['USERNAME']; ?></td>
                                                            <td><?php echo $item['POS_CODE_NAME']; ?></td>
                                                            <td><?php echo $item['DIRECTION']; ?></td>
                                                            <td><?php echo $item['QRTIME']; ?></td>
                                                            <td>
                                                                <div class="popup-gallery">
                                                                <?php if ($item['PIC_URL'] != null ) {?>
                                                                <a href="<?php echo $pic_url;?>" title="caption" data-chaos-modal-caption="caption">
                                                                <img class="img-responsive" src="<?php echo $pic_url;?>" width="50px" /></a>
                                                                <?php } else echo "<center>-</center>"; ?>
                                                                </div>
                                                            </td>                                                  
                                                        </tr>
                                                        <?php
                                                            }//end for
                                                        }
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
            $('.dateLimit').daterangepicker({
                dateLimit: {            
                    days: 30
                },     
                locale: {
                    format: 'DD-MM-YYYY',
                    separator: " to "
                },
            });

            function eventSearchClick() { 
                var empIdVal = $("#empId").val();      
                var dateVal  = $("#txtdate").val();
                var fromDate = dateVal.substring(0, 10);
                var toDate   = dateVal.substring(14);

                window.location.href = "?emp=" + empIdVal + "&sdate=" + fromDate + "&edate=" + toDate + "&roleCode=" + localStorage.getItem('roleCode')+'&fullName='+localStorage.getItem('empFullname');
            }

            function eventExportClick() { 
                var empIdVal = $("#empId").val();
                var dateVal  = $("#txtdate").val();
                var fromDate = dateVal.substring(0, 10);
                var toDate   = dateVal.substring(14);

                window.location.href = "report-export.php?emp=" + empIdVal + "&sdate=" + fromDate + "&edate=" + toDate + "&roleCode=" + localStorage.getItem('roleCode') + '&fullName=' + localStorage.getItem('empFullname');
            }
        </script>    
    </body>
</html>