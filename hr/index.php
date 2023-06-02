<?php
include("../lib/session.php");
include("../lib/config.php");

//if ($s_role_code != role_hr) {header('Location: ../index.php');}
if ($_GET["roleCode"] != role_hr) {header('Location: ../index.php');}
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
						<form class="form-horizontal" id="frmHr" name="frmHr" method="get" autocomplete="off">
							<div id="divHead" class="form-group">				
								<h3 class="text-center m-b-20"><image src="../assets/images/ptg_logo.png"/><br/><b>Time Attendance</b></h3>
							</div>
							<div class="form-group">
								<input class="form-control" type="text" id="fullname" name="fullname" value="<?php echo $_GET["empName"]; ?>" disabled>	
							</div>
							<div class="form-group">
								<input class="form-control" type="text" id="position" name="position" value="<?php echo $_GET["posName"]; ?>" disabled>	
							</div>					
							<div class="form-group">
								<input class="form-control" type="text" id="username" name="username" value="<?php echo $_GET["empId"]; ?>" disabled>
							</div>
							<div class="form-group">
								<input class="form-control" type="password" id="password" name="password" placeholder="รหัสผ่าน" autofocus autocomplete="off">
							</div>
							<div class="form-group">		
								<div class="col-xs-12 p-b-20">
								<a href="#" id="BtnSignin" name="BtnSignin" onClick="check_user()" class="btn btn-block btn-lg btn-success btn-rounded" >ดูรายงานลงเวลาพนักงาน</a>						
								<a id="link-manager" href="../logout.php" class="btn btn-block btn-lg btn-info btn-rounded"> ย้อนกลับ</a>
								</div>                                        
							</div>             
							<?php include("../includes/footer.php");?>
						</form>
					</div>
				</div>
			</div>
		</section>

		<!-- Modal WEB CAM -->
		<div class="modal fade" id="capture-imageRpt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #2DBF7A;">
						<a class="navbar-brand">		
							<span style="color:white;"><?php echo $_GET["empId"]." - ";?><?php echo $_GET["empName"];?></span> 
						</a>	  
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div id="results"></div>
					<div class="modal-body">	  
						<br/>
						<center>
							<div id="my_camera"></div>
							<img id="camImg" src="../assets/icon/camera.png" width="300px" />
							<div id="camera"></div><br>
							<button id="take_snapshots" onClick="take_snapshot()" class="btn btn-success btn-sm"><b>ดูรายงานลงเวลาพนักงาน</b></button>
						</center>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal WEB CAM-->
		<div class="select" style="visibility: hidden;">
			<label for="videoSource">Camera :&nbsp;</label><select id="videoSource"></select>
		</div>	
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
		<script src="../plugins/jquery.validate.min.js"></script>
		<script src="../assets/node_modules/toast-master/js/jquery.toast.js"></script>
		<script src="../dist/js/pages/toastr.js"></script>	
		<script src="../dist/js/app.helper.js"></script>
		<script src="../dist/js/webcam.min.js"></script>
		<script src="../dist/js/jquery.modal.min.js"></script>
		<script async src="../dist/js/main.js"></script>
		<!-- For Alert Box -->
		<script src="../assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
		<!--Custom JavaScript -->
		<!-- For Back Button -->
		<script type="text/javascript">
			function preventBack() { window.history.forward(); }
			setTimeout("preventBack()", 0);
			window.onunload = function () { null };
		</script>
		<script type="text/javascript">

		$(function() {
			setTimeout(function(){ $(".preloader").fadeOut(); }, 1000);
		});
		$('.place-image').hover(
			function() {$('.place-image').fadeIn('slow');}, function() {
				$('.place-image').fadeOut('slow');
			}
		);

		Webcam.set({
			width: 350,
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 70
		});
		Webcam.on('live', function() {
			localStorage.setItem('camera', 'allow'); 
		});
		Webcam.on('error', function(err) {
			if (localStorage.getItem('camera') != 'disable') {
				Swal.fire({
					title: "ไม่สามารถบันทึกภาพได้",
					text: "กรุณาตรวจสอบอุปกรณ์ ( กล้อง )",
					timer: 10000,
					showConfirmButton: true,
					onClose: () => {
						localStorage.setItem('camera', 'disable'); 
					}
				});
			}
		});

		if (localStorage.getItem('camera') == 'allow') {		
			$('#camImg').hide();
			$('#my_camera').show();
		} else {
			$('#camImg').show();
			$('#my_camera').hide();
		}
		Webcam.attach('#my_camera');

		// preload shutter audio clip
		var shutter = new Audio();
		shutter.autoplay = false;
		shutter.src = navigator.userAgent.match(/Firefox/) ? '../assets/sound/shutter.ogg' : '../assets/sound/shutter.mp3';

		function take_snapshot() {
			console.log("##### Start HR take_snapshot #####");

			if (localStorage.getItem('camera') == 'allow') {
				console.log("HR config camera allow ...");
					
				document.getElementById('results').innerHTML = '';// Clear webcam picture

				// play sound effect
				shutter.play();

				var queryStr = '?empId='+localStorage.getItem('empId')+'&lat='+localStorage.getItem('branchLat')+'&lot='+localStorage.getItem('branchLot')+'&cam='+localStorage.getItem('camera');
				console.log("queryStr = " + queryStr);

				Webcam.snap( function(imgBase64) {
					Webcam.upload(imgBase64, '../saveimage-rpt.php'+queryStr, function(code, text) {
						//document.getElementById('results').innerHTML = '<center><img src="' + text + '"/></center>';

						//console.log(">> [data_uri] = " + imgBase64);
						console.log(">> [code]     = " + code);
						console.log(">> [text]     = " + text);  

						var retSaveImgIn = text.split('|');
						var blobUri      = retSaveImgIn[0];
						var snapImg      = retSaveImgIn[1];
						var logMessage   = retSaveImgIn[2];
						var dateWithTime = retSaveImgIn[3];

						console.log("blobUri      = " + blobUri);
						console.log("snapImg      = " + snapImg);
						console.log("logMessage   = " + logMessage);		
						console.log("dateWithTime = " + dateWithTime);

						if (!text) {
							document.getElementById('results').innerHTML = '<center><img src="../assets/icon/noimage.png"/></center>';
						} else {
							console.log(">>>>>> Start saveimage-rpt-data ...");									
							document.getElementById('results').innerHTML = '<center><img src="' + blobUri + '"/></center>';	
							console.log("result.innerHTML = " + blobUri);	
							saveImageRptData(snapImg, logMessage, dateWithTime);
							console.log("func MANAGER rpt take_snapshot -> dateWithTime = " + dateWithTime);											
						}
					});
				});
			} else {
				console.log("HR config camera disabled ...");

				var queryStr = '?empId='+localStorage.getItem('empId')+'&lat='+localStorage.getItem('branchLat')+'&lot='+localStorage.getItem('branchLot')+'&cam='+localStorage.getItem('camera');
					console.log("queryStr = " + queryStr);

				$.post("../saveimage-rpt.php" + queryStr, function(result) {
					//document.getElementById('results').innerHTML = '<br/><br/><center><img src="../assets/icon/noimage.png"/></center>';

					var retSaveImgIn = result.split('|');
					var blobUri      = retSaveImgIn[0];
					var snapImg      = retSaveImgIn[1];
					var logMessage   = retSaveImgIn[2];
					var dateWithTime = retSaveImgIn[3];

					console.log("blobUri      = " + blobUri);
					console.log("snapImg      = " + snapImg);
					console.log("logMessage   = " + logMessage);		
					console.log("dateWithTime = " + dateWithTime);

					if (!result) {
						document.getElementById('results').innerHTML = '<center><img src="../assets/icon/noimage.png"/></center>';
					} else {
						console.log(">>>>>> Start saveimage-rpt-data ...");									
						document.getElementById('results').innerHTML = '<center><img src="' + blobUri + '"/></center>';	
						console.log("result.innerHTML = " + blobUri);	
						saveImageRptData(snapImg, logMessage, dateWithTime);
						console.log("func HR rpt take_snapshot -> dateWithTime = " + dateWithTime);
					}
				});
			}
			console.log("##### End HR take_snapshot #####");

			//do something
			//$(location).attr('href',"main.php");   
			
			var queryStr = '?roleCode='+localStorage.getItem('roleCode')+'&fullName='+localStorage.getItem('empFullname');
            window.location.href = 'main.php'+queryStr;
		}
		
		function saveImageRptData(snapImg, logMessage, dateWithTime) {	
				console.log("call func -> saveImageRptData");	
				$.post("../saveimage-rpt-data.php", {									    
						empId:       localStorage.getItem('empId'),
						empFullname: localStorage.getItem('empFullname'),
						posCode:     localStorage.getItem('posCode'),
						posName:     localStorage.getItem('posName'),
						deptCode:    localStorage.getItem('deptCode'),
						deptName:    localStorage.getItem('deptName'),
						currentLat:  localStorage.getItem('currentLat'),
						currentLot:  localStorage.getItem('currentLot'),
						roleCode:    localStorage.getItem('roleCode'),
						roleName:    localStorage.getItem('roleName'),
						branchCode:  localStorage.getItem('branchCode'),
						branchName:  localStorage.getItem('branchName'),
						branchLat:   localStorage.getItem('branchLat'),
						branchLot:   localStorage.getItem('branchLot'),
						camera:      localStorage.getItem('camera'),
						snapImg:     snapImg,
						logMessage:  logMessage,
						dateWithTime: dateWithTime
					}, 
					function(result) {						
						console.log("Call save image rpt API result >> " + result);
						try {							
							if (result) {
								console.log("Valid save image rpt result = " + result);								
							} else {								
								console.log("Call save image rpt API Error !! ");												
							}
						} catch(err) {							
							console.log("Call save image rpt API Error !! ");			
						}
					}
				);				
			}
		</script>	
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
				if (!regex.test(key)) {
					theEvent.returnValue = false;
					if(theEvent.preventDefault) theEvent.preventDefault();
				}
			}
		</script>
		<!-- End Validate Input -->
		<!--Validate Form -->
		<script>
			var input = document.getElementById('password');
			input.onkeydown = function() {
				var key = event.keyCode || event.charCode;
				if(key == 8 || key == 46) {
					$("#password").val("");			
				}		
			};
			function check_user() {
				var usrId = $("#username").val();
				var pass  = $("#password").val();
				var cam   = localStorage.getItem('camera');

				$.post("../repository/hr/check-authen-ldap.php", 
					{usr: usrId, pwd: pass, camera:cam}, 
					function(result) {
						let response = jQuery.parseJSON(result);
						$.each(response, function(index) {      
							$status =index ;
						});
						try {
							if ($status == 'success') {
								var str_snapname = response.success[0].uid + " - " + response.success[0].cn;
								$('#dsp_snap_name').html(str_snapname).prop('disabled', true);
								$('#capture-imageRpt').modal('show');
								$('#take_snapshots').focus();
							} else {	
								if ($status == 'error') {
									Swal.fire({
										//title: "พบปัญหาการเชื่อมต่อระบบ LDAP",
										//text: "อีก 5 นาทีให้ทดลองอีกครั้ง หรือ ติดต่อผู้ดูแลระบบ",
										title: "พบปัญหา[การยืนยันตัวตน] กับ ระบบ[LDAP] !!",
										text: "กรุณาตรวจสอบ[รหัสพนักงาน] หรือ [รหัสผ่าน] !!",
										showConfirmButton: true,
										onClose: () => {window.location.replace("index.php");}
									});
								} else {
									Swal.fire({
										title: "ข้อมูลชื่อผู้ใช้งานไม่ถูกต้อง",
										text: "กรุณาลองใหม่อีกครั้ง หรือ ติดต่อผู้ดูแลระบบ",
										timer: 2000,
										showConfirmButton: true,
										onClose: () => {window.location.replace("index.php");}
									});
								}
							}	
						} catch(err) {
							Swal.fire({
								title: "กรุณาตรวจสอบรหัสผ่านให้ถูกต้อง",
								text: "กรุณาลองใหม่อีกครั้ง หรือ ติดต่อผู้ดูแลระบบ",
								timer: 2000,
								showConfirmButton: true,
								onClose: () => {$("#password").val("");}
							});
						}
					}
				);
			}		
		</script>	

		<!--End Validate Form -->
	</body>
</html>