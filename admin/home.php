<?php
    require_once '../lib/config.php';
    include("../lib/session.php");

    //if ($s_role_code != role_config) header("Location:index.php");
    
    $get_roleCode = $_GET["role"];
    if ($get_roleCode != role_config) header("Location:index.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" href="../assets/images/ptg_logo.png" />
        <title>PTG Time Attendance</title>
        <!-- toast CSS -->
        <link href="../assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">    	
        <!-- page css -->
        <link href="../dist/css/pages/login-register-lock.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="../dist/css/style.min.css" rel="stylesheet">
        <link href="../dist/scss/core/spinner.scss" rel="stylesheet">
    </head>

    <body class="skin-default card-no-border" oncopy="return false" oncut="return false" onpaste="return false" style="background-color: #56C86A;">
        
        <?php include("../includes/preloader.php");?>
        
        <section id="wrapper">
            <div><br/>
                <div class="login-box card">
                    <div class="card-body">
                        <span style="float:left; color: red;" id="display_loc"></span>
                        <span style="float:right; color: blue;">&nbsp;</span>
                        <br/>
                        <input type="hidden" id="hid" name="hid"/>			
                        <h3 class="text-center m-b-20"><image src="../assets/images/ptg_logo.png"/> <br/><b>Time Attendance</b></h3>
                        <div class="form-group">
                            <div id="dsp_name" style="text-align: left;"></div><br/>
                            <div class="col-xs-12 p-b-20">
                                <!--
                                <a href="manage-config.php" class="btn btn-block btn-lg btn-success btn-rounded"> ตั้งค่าระบบ</a>
                                <a href="manage-role.php" class="btn btn-block btn-lg btn-success btn-rounded"> จัดการสิทธิ์การใช้งาน</a> 
                                -->  
                                <a href="javascript:manageConfig()" class="btn btn-block btn-lg btn-success btn-rounded"> ตั้งค่าระบบ</a>
                                <a href="javascript:manageRole()" class="btn btn-block btn-lg btn-success btn-rounded"> จัดการสิทธิ์การใช้งาน</a>                         
                                <a href="../logout.php" class="btn btn-block btn-lg btn-warning btn-rounded"> ออกจากระบบ</a>
                            </div>                                        
                        </div>
                        <?php include("../includes/footer.php");?>	
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="../assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="../assets/node_modules/popper/popper.min.js"></script>
        <script src="../assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <!--Plugin JavaScript -->
        <script src="../plugins/jquery.validate.min.js"></script>
        <script src="../assets/node_modules/toast-master/js/jquery.toast.js"></script>
        <script src="../dist/js/pages/toastr.js"></script>	
        <script src="../dist/js/app.helper.js"></script>
        <!-- For Alert Box -->
		<script src="../assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <!-- Go to manage-config and manage-role page --> 
        <script type="text/javascript">
            function manageConfig() {
                var roleCode    = localStorage.getItem('roleCode');
                var itAdminRole = '<?php echo role_config ?>';
                if ((!roleCode) && (!itAdminRole) &&  (roleCode !== itAdminRole)) {
                    Swal.fire({
                        title: "ไม่มีสิทธิ์เข้าใช้งานระบบ !!",
                        text: "กรุณาติดต่อผู้ดูแลระบบ !!",
                        timer: 2000,
                        showConfirmButton: true,
                        onClose: () => {
                            window.location.replace("index.php");
                        }
                    });
                } else {
                    var queryStr = '?role='+roleCode;
                    window.location.href = 'manage-config.php'+queryStr;
                } 
            }

            function manageRole() {
                var roleCode    = localStorage.getItem('roleCode');
                var itAdminRole = '<?php echo role_config ?>';
                if ((!roleCode) && (!itAdminRole) &&  (roleCode !== itAdminRole)) {
                    Swal.fire({
                        title: "ไม่มีสิทธิ์เข้าใช้งานระบบ !!",
                        text: "กรุณาติดต่อผู้ดูแลระบบ !!",
                        timer: 2000,
                        showConfirmButton: true,
                        onClose: () => {
                            window.location.replace("index.php");
                        }
                    });
                } else {
                    var queryStr = '?role='+roleCode;
                    window.location.href = 'manage-role.php'+queryStr;
                } 
            }
        </script>
        <!-- For Back Button -->       
        <script type="text/javascript">
            function preventBack() { window.history.forward(); }
            setTimeout("preventBack()", 0);
            window.onunload = function () { null };
        </script>
        <!--Custom JavaScript -->
        <script type="text/javascript">
            $(function() {
                setTimeout(function(){ $(".preloader").fadeOut(); }, 1000);
            });
            $('.place-image').hover(
                function() {$('.place-image').fadeIn('slow');},
                function() {
                    $('.place-image').fadeOut('slow');
                }
            );
        </script>	
    </body>
</html>
