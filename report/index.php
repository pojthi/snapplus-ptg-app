<?php
include("../lib/session.php");
include("../lib/config.php");
include("../lib/convert.class.php");
require_once '../repository/call_api.php';
require_once '../lib/function.calss.php';
$fun = new ToolFuntion();
$fun -> HttpsRedirect();

$get_empId = $_GET["empId"];

$date     = new DateTime("now", new DateTimeZone('Asia/Bangkok') );
$ddMMyyyy = $date->format('d-m-Y');
$convert  = new Convert();
$monthTH  = $convert->tomonthname(date("m"),1);
$rptMonth = $monthTH.' '.date("Y");

$startMonth = '01'.$date->format('-m-Y');

//$service_url = api_getScanTransReport.''.$s_userid.'/'.$startMonth.'/'.$ddMMyyyy;
$service_url = api_getScanTransReport.''.$get_empId.'/'.$startMonth.'/'.$ddMMyyyy;
$jsonString  = callGetApi($service_url);
$objArray    = json_decode($jsonString,true);

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
        <link rel="icon" type="image/png" href="./assets/images/ptg_logo.png" />
        <title>PTG Time Attendance</title>
        <!-- toast CSS -->
        <link href="../assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">    	
        <!-- page css -->
        <link href="../dist/css/pages/login-register-lock.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="../dist/css/style.min.css" rel="stylesheet">
        <link href="../dist/scss/core/spinner.scss" rel="stylesheet">
        <!-- Popup CSS -->
        <link href="../assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
    </head>

    <body class="skin-default card-no-border" oncopy="return false" oncut="return false" onpaste="return false" style="background-color: #CBC9C9;">
        
        <?php include("../includes/preloader.php");?>
        <section id="wrapper">
            <div>
                <div class="login-box card" style="width:100%;">                
                    <form class="form-horizontal form-material" id="fromrpt" name="fromrpt"  method="post">				
                        <!-- Body -->
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #F9CD2A;">
                            <span style="color:white;">รายงาน ประจำเดือน <?php echo $rptMonth;?><br/>
                            <?php echo $s_name; ?> <br/> ตำแหน่ง <?php echo $s_position_name; ?>
                            </span>	
                            <a href="../logout.php" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>  
                            </div>
                            <div style="width:100%;">	              
                                <table id="table" name="table" class="table table-sm">
                                    <thead style="background-color: #F9CD2A;">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" width="100px">วันที่</th>
                                        <th scope="col">เวลา</th>
                                        <th scope="col">ภาพพนักงาน</th>                                
                                        <th scope="col">ทำรายการ</th>
                                        <th scope="col">สาขาทำรายการ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php                            
                                        foreach($objArray['success'] as $i => $item) {
                                            $pic_url = str_replace("[PATH_IMG]", $item['PIC_URL'], SAS_ID);
                                    ?>
                                        <tr>
                                            <td scope="row"><?php echo $i+1;?></td>
                                            <td scope="row"><?php echo date('d-m-Y', strtotime($item['QRTIME']));?></td>
                                            <td scope="row"><?php echo date('H:i:s', strtotime($item['QRTIME']));?></td>
                                            <td>
                                                <div class="popup-gallery">
                                                    <?php if ($item['PIC_URL'] != null ) {?>
                                                    <a href="<?php echo $pic_url;?>" title="<?php echo $s_name; ?>" data-chaos-modal-caption="<?php echo $s_name; ?>">
                                                    <img class="img-responsive" src="<?php echo $pic_url;?>" width="50px" /></a>
                                                    <?php } else echo "<center>-</center>"; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <?php 
                                                if ($item['DIRECTION'] == 'IN' ) {
                                                    echo '<font color=\'blue\'> ลงเวลาเข้างาน</font>';
                                                } else {
                                                    echo '<font color=\'red\'>ลงเวลาเลิกงาน</font>';
                                                }
                                                ?>
                                        </td> 
                                            <td><?php echo $item['BRANCH']; ?></td>                                    
                                        </tr>                                
                                    <?php
                                        }//end for
                                    ?>
                                    </tbody>
                                    </table>		
                            </div>
                        </div>
                        <!-- End Body -->				
                        <?php include("../includes/footer.php");?>	
                    </form>                    
                </div>                
            </div>
        </section>
        <!-- Modal -->
        <!-- End Modal -->
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
        <script src="../assets/node_modules/toast-master/js/jquery.toast.js"></script>
        <script src="../dist/js/pages/toastr.js"></script>	
        <script src="../dist/js/app.helper.js"></script>
        <script src="../dist/js/jquery.modal.min.js"></script>
        <script src="../dist/js/jquery.modal.js"></script>
        <!-- Magnific popup JavaScript -->
        <script src="../assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
        <script src="../assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
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
        </script>	  
    </body>
</html>