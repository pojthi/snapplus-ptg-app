<?php
include("../lib/session.php");
include("../lib/config.php");
require_once '../repository/call_api.php';

//if ($s_role_code != role_hr || $s_ad_active !='Active') {header('Location: ../index.php');}
if ($_GET["roleCode"] != role_hr) {header('Location: ../index.php');}

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
                            <h4 class="text-themecolor">Dashboard</h4>
                        </div>
                        <div class="col-md-7 align-self-center text-right">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>							
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- Start Page Content -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-12">
                            &nbsp;
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

    </body>
    <?php include("../includes/javascripts.php");?>
</html>
<!--
<script>
    function linkMain() {
        var queryStr = '?roleCode='+localStorage.getItem('roleCode');
        window.location.href = 'main.php'+queryStr;
    }

    function linkTempStaff() {
        var queryStr = '?roleCode='+localStorage.getItem('roleCode');
        window.location.href = 'tempstaff.php'+queryStr;
    }

    function linkReport() {
        var queryStr = '?roleCode='+localStorage.getItem('roleCode');
        window.location.href = 'report.php'+queryStr;
    }

    function linkRptActivity() {
        var queryStr = '?roleCode='+localStorage.getItem('roleCode');
        window.location.href = 'report-activity.php'+queryStr;
    }

    function linkRptNoCamera() {
        var queryStr = '?roleCode='+localStorage.getItem('roleCode');
        window.location.href = 'report-nocamera.php'+queryStr;
    }
</script>
-->
