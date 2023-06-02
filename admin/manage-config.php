<?php
    require_once '../lib/config.php';
    include("../lib/session.php");
    require_once '../lib/function.calss.php';
    
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

        <link href="../assets/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

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

    <body class="skin-default card-no-border" oncopy="return false" oncut="return false" onpaste="return false" style="background-color: #56C86A;">
        
        <?php include("../includes/preloader.php");?>

        <section id="wrapper">
            <div><br/>
                <div class="login-box card">
                    <div class="card-body">
                        <form class="form-horizontal" id="frmConfig" name="frmConfig" method="post" autocomplete="off">	
                            <input type="hidden" id="hid" name="hid"/>			
                            <h3 class="text-center m-b-20"><image src="../assets/images/ptg_logo.png"/> <br/><b>Time Attendance</b></h3>
                            <div class="form-group">
                                <input class="form-control" type="text" id="txtbranch" name="txtbranch" placeholder="ชื่อสาขา" autofocus>	
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" id="txtbranch_code" name="txtbranch_code" placeholder="รหัสสาขา" disabled>	
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" id="txtlat" name="txtlat" placeholder="Latitude" disabled>	
                            </div>     
                            <div class="form-group">
                                <input class="form-control" type="text" id="txtlot" name="txtlot" placeholder="Longitude" disabled>	
                            </div>                                   											
                            <div class="form-group">
                                <a href="#" id="BtnSave" name="BtnSave" onClick="eventClick()" class="btn btn-block btn-lg btn-success btn-rounded">บันทึกตั้งค่าระบบ</a>
                                <a id="link-manager" href="home.php" class="btn btn-block btn-lg btn-info btn-rounded"> ย้อนกลับ</a>
                                <a href="../logout.php" class="btn btn-block btn-lg btn-warning btn-rounded"> ออกจากระบบ</a>                        
                            </div>
                            
                            <?php include("../includes/footer.php");?>                
                        </form>
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
        <!--Auto Complete JavaScript -->
        <script src="../dist/js/autocomplete/jquery-1.12.4.js"></script>
        <script src="../dist/js/autocomplete/jquery-ui.js"></script>

        <script src="../assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script src="../assets/node_modules/sweetalert2/sweet-alert.init.js"></script>
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
                function() {$('.place-image').fadeIn('slow');},function() {
                     $('.place-image').fadeOut('slow');
                }
            );
        </script>	
    </body>
</html>
<!--Validate Form -->
<script>
	var input = document.getElementById('txtbranch');
    var arrData = [];
    var mappingBranchCode = { };
    var mappingLat = { };
    var mappingLot = { };

    $("#txtbranch").val(localStorage.getItem('branchName'));
    $("#txtbranch_code").val(localStorage.getItem('branchCode'));	
    $("#txtlat").val(localStorage.getItem('currentLat'));	
    $("#txtlot").val(localStorage.getItem('currentLot'));

	input.onkeydown = function() {
		var key = event.keyCode || event.charCode;
		if(key == 8 || key == 46) 
		{
			$("#txtbranch").val("");
            $("#txtbranch_code").val("");	         
		}
		if( key == 13 ) 
		{
			$('#BtnSave').focus();
            clearArray(arrData);
		}
    };
   
    $(function() {
        $("#txtbranch").autocomplete({            
            source: function( request, response ) {
                    $.post("../repository/admin/get-branch-information.php", {
                        branchName: $("#txtbranch").val()}, 
                        function(result) {
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
            }});        
    } //end function
  );
  
</script>
<!--End Validate Form -->
<!-- End Validate Input -->
<script>
    function eventClick() {
        localStorage.setItem('branchName', $("#txtbranch").val()); 
        localStorage.setItem('branchCode', $("#txtbranch_code").val()); 
        localStorage.setItem('branchLat',  $("#txtlat").val()); 
        localStorage.setItem('branchLot',  $("#txtlot").val()); 

        $.post("../repository/admin/save-activate-branch.php", {
            brnCode: $("#txtbranch_code").val(),
            brnName: $("#txtbranch").val()}, 
            function(result) {
                Swal.fire({
                    title: "ทำการติดตั้งระบบสำเร็จ",
                    text: "ออกจากระบบเพื่อเริ่มต้นใช้งาน",
                    timer: 10000,
                    showConfirmButton: true,
                    onClose: () => {}
                });
        });
    }
</script>