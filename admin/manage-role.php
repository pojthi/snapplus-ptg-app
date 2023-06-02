<?php
    require_once '../lib/config.php';
    include("../lib/session.php");
    require_once '../lib/function.calss.php';
	$fun = new ToolFuntion();
	$fun -> HttpsRedirect();
    
    //if ($s_role_code!=role_config) header("Location:index.php");

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
                        <input type="hidden" id="hidPosCode" name="hidPosCode"/>			
                        <h3 class="text-center m-b-20"><image src="../assets/images/ptg_logo.png"/> <br/><b>Time Attendance</b></h3>
                        <div class="form-group">
                            <input class="form-control" type="text" id="txtpos_code" name="txtpos_code" placeholder="Position Code" autofocus>	
                        </div>             
                        <div class="form-group">
                            <select class="form-control" name="role" id="role"></select> 
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
                function() {$('.place-image').fadeIn('slow');}, 
                function() {
                    $('.place-image').fadeOut('slow');
                }
            );
        </script>	
    </body>

</html>
<!--Validate Form -->
<script>
    var inputPosCode = document.getElementById('txtpos_code');
    var arrData = [];
    var mappingPositionCode = { };

	inputPosCode.onkeydown = function() {
		var key = event.keyCode || event.charCode;
		if(key == 8 || key == 46) {
			$("#txtpos_code").val("");          
		}
    };

    $.post("../repository/admin/get-role-config.php", function(result) {
        let response = jQuery.parseJSON(result);
        $.each(response, function(index,item) {
            $.each(item, function(data) {
                $('#role').append($('<option></option>') 
                .val(item[data].ROLE_CODE)
                .html(item[data].ROLE_CODE));  
            });
        });
    });
    
$(function() {
    $("#txtpos_code").autocomplete({        
        source: function( request, response ) {
            $.post("../repository/admin/get-position-information.php", 
                {positionName: $("#txtpos_code").val()}, 
                function(result) {
                    let ret = jQuery.parseJSON(result);
                    arrData = [];

                    $.each(ret, function(index,item) {                     
                        $.each(item, function(data) {
                            $str = item[data].CODPOS;
                            $str = $str.concat('-',item[data].NAMPOST);
                            arrData.push($str);    
                            mappingPositionCode[$str] = item[data].CODPOS;
                        }); 
                    });
                    response(arrData);              
                });
            },minLength: 2,
            select: function (event, ui) {
                $("#hidPosCode").val(mappingPositionCode[ui.item.value]);
            }    
    });        
}); //end auto complete
//end function
 
</script>
<!--End Validate Form -->
<!-- Validate Input -->
<script>
	function validate(evt) {
        var theEvent = evt || window.event;
        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if(!regex.test(key)) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
	}
</script>
<!-- End Validate Input -->
<script>
    function eventClick() {
        var roleVal = $("#role").val();
        if ($("#txtpos_code").val().length > 10) {
            $.post("../repository/admin/save-role.php", {
                roleCode: roleVal,
                roleName: roleVal,
                posCode: $("#hidPosCode").val() }, 
                function(result) {
                    let response = jQuery.parseJSON(result);            
                    try {
                        $.each(response, function(index) {      
                            $status =index ;				
                        });        
                        if ($status =='success') {
                            $("#txtpos_code").val("");
                            $("#hidPosCode").val("");   
                            Swal.fire({
                                title: "บันทึกข้อมูลสำเร็จ",
                                text: "ออกจากระบบเพื่อเริ่มต้นใช้งาน",
                                timer: 10000,
                                showConfirmButton: true,
                                onClose: () => {}
                            });
                        } else {
                            Swal.fire({
                                title: "บันทึกข้อมูลไม่สำเร็จ",
                                text: "กรุณาตรวจสอบข้อมูล",
                                timer: 10000,
                                showConfirmButton: true,
                                onClose: () => {}
                            });	
                        }
                    } catch(err) {
                        Swal.fire({
                            title: "บันทึกข้อมูลไม่สำเร็จ",
                            text: "กรุณาตรวจสอบข้อมูล",
                            timer: 10000,
                            showConfirmButton: true,
                            onClose: () => {}
                        });	
                    }
            }); 
        } else {
            Swal.fire({
                title: "บันทึกข้อมูลไม่สำเร็จ",
                text: "กรุณาตรวจสอบข้อมูล Position Code",
                timer: 10000,
                showConfirmButton: true,
                onClose: () => {}
            });
        }    
    }
</script>