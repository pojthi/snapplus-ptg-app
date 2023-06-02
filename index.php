<?php
	session_start();
	require_once 'lib/config.php';
	require_once 'lib/function.calss.php';
	$fun = new ToolFuntion();

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
		<link href="assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">    	
		<!-- page css -->
		<link href="dist/css/pages/login-register-lock.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="dist/css/style.min.css" rel="stylesheet">
		<link rel="manifest" href="manifest.json">
		<style>
		</style>
	</head>

	<body class="skin-default card-no-border" oncopy="return false" oncut="return false" onpaste="return false" style="background-color: #CBC9C9;">
		
		<?php include("includes/preloader.php");?>
			
		<section id="wrapper">
			<div><br />
				<div class="login-box card">
					<div class="card-body">									
						<div class="form-group">	
							<span style="float:left; color: red;" id="display_loc"></span><br/>
							<form class="form-horizontal" id="frmlogin" name="frmlogin" method="post" autocomplete="off">	
								<input type="hidden" id="hid" name="hid"/>
								<input type="hidden" id="role" name="role"/>
								<input type="hidden" id="emp" name="emp"/>	
								<br />
								<div style="text-align: center;"><image src="./assets/images/ptg_logo.png"/></div>			
								<h3 class="text-center m-b-20"><b>Time Attendance</b></h3>																		
								<div id="divUsername" class="form-group">
									<input class="form-control" type="number" id="username" name="username" placeholder="รหัสพนักงาน" autofocus maxlength="8" onkeypress='validate(event)' autocomplete="off">
								</div>
								<div id="divUsername2" class="form-group">
									<input class="form-control" type="number" id="username2" name="username2" placeholder="ยืนยันรหัสพนักงาน" disabled maxlength="8" onkeypress='validate(event)' autocomplete="off">							
								</div>
								<div class="form-group">
									<input class="form-control" type="text" id="fullname" name="fullname" placeholder="ชื่อ-นามสกุล" disabled>	
								</div>
								<div class="form-group">
									<input class="form-control" type="text" id="position" name="position" placeholder="ตำแหน่ง" disabled>	
								</div>						
								<div class="form-group">
									<div class="col-xs-12 p-b-20">													
										<a href="#" id="btnScanIn" name="btnScanIn" onClick="scan_in()" class="btn btn-block btn-lg btn-success btn-rounded">ลงเวลาเข้างาน</a>
										<a href="#" id="btnScanOut" name="btnScanOut" onClick="scan_out()" class="btn btn-block btn-lg btn-danger btn-rounded">ลงเวลาเลิกงาน</a>
										<!--
										<a id="link-manager" href="manager/"  class="btn btn-block btn-lg btn-warning btn-rounded"> รายงานลงเวลาพนักงาน </a>
										-->
										<a id="link-manager" href="javascript:linkManager()"  class="btn btn-block btn-lg btn-warning btn-rounded"> รายงานลงเวลาพนักงาน </a>
										<!--
										<a id="link-hr" href="hr/"  class="btn btn-block btn-lg btn-warning btn-rounded"> รายงานลงเวลาพนักงาน </a>
										-->
										<a id="link-hr" href="javascript:linkHR()"  class="btn btn-block btn-lg btn-warning btn-rounded"> รายงานลงเวลาพนักงาน </a>
										<!--
										<a id="link-report" href="report/"  class="btn btn-block btn-lg btn-warning btn-rounded"> รายงานลงเวลาทำงาน </a>
										-->
										<a id="link-report" href="javascript:linkReport()"  class="btn btn-block btn-lg btn-warning btn-rounded"> รายงานลงเวลาทำงาน </a>	
									</div>
								</div>
								<?php include("includes/footer.php");?>	
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<!-- Modal WEB CAM -->
		<div class="modal fade" id="capture-image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #2DBF7A;">
						<a class="navbar-brand">		
							<span id="dsp_snap_name" style="color:white;">Disple Name Here</span> 
						</a>	  
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">	  
						<br/>
						<center>
							<div id="my_camera"></div>
							<img id="camImg1" src="assets/icon/camera.png" width="300px" />
							<div id="camera"></div><br>
							<button id="take_snapshots" onClick="take_snapshot()" class="btn btn-success btn-sm"><b>ถ่ายรูปลงเวลาเข้างาน</b></button>
						</center>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="capture-image2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #D0CDCD;">
					<a class="navbar-brand">		
							<span id="dsp_snap_name2" style="color:white;">Disple Name Here</span> 
						</a>	  
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">	  
						<br/>
						<center>
							<div id="my_camera2"></div>
							<img id="camImg2" src="assets/icon/camera.png" width="300px" />
							<div id="camera"></div><br>
							<button id="take_snapshots2" onClick="take_snapshot2()" class="btn btn-secondary btn-sm"><b>ถ่ายรูปลงเวลาเลิกงาน</b></button>
						</center>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal WEB CAM-->
		<!-- Modal -->
		<div class="modal fade" id="scan-in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #62F7B1;">
						<a class="navbar-brand"><span id="dsp_snap_summary" style="color:white;">Disple Name Here</span></a>	  
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div id="results"></div>
					<div class="modal-body">
						<br/>
						<table id="tbl" name="tabtblle" class="table table-sm">
							<thead style="background-color: #62F7B1;">
								<tr>
									<th scope="col">#</th>
									<th scope="col">เวลา</th>
									<th scope="col">รายการ</th>
								</tr>
							</thead>
							<tbody id="tbl_body">				
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="scan-out" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #C8CBCA;">
						<a class="navbar-brand"><span id="dsp_snap_summary2" style="color:white;">Disple Name Here</span></a>	  
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div id="results2"></div>
					<div class="modal-body">
						<br/>
						<table class="table table-sm">
							<thead style="background-color: #C8CBCA;">
							<tr>
								<th scope="col">#</th>
								<th scope="col">เวลา</th>
								<th scope="col">รายการ</th>
								</tr>
							</thead>
							<tbody id="tbl_body2">
							</tbody>
						</table>		
					</div>
				</div>
			</div>
		</div>

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
		<script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
		<!-- Bootstrap tether Core JavaScript -->
		<script src="assets/node_modules/popper/popper.min.js"></script>
		<script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
		<!--Plugin JavaScript -->
		<script src="plugins/jquery.validate.min.js"></script>
		<script src="assets/node_modules/toast-master/js/jquery.toast.js"></script>
		<script src="dist/js/pages/toastr.js"></script>	
		<script src="dist/js/app.helper.js"></script>
		<!-- For Camera -->
		<script src="dist/js/webcam.min.js"></script>
		<!-- Set Default USB Camera -->
		<script async src="dist/js/main.js"></script> 
		<!-- For Alert Box -->
		<script src="assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
		<!-- For Back Button -->
		<script type="text/javascript">
			function preventBack() { window.history.forward(); }
			setTimeout("preventBack()", 0);
			window.onunload = function () { null };
		</script>
		<!--Custom JavaScript -->
		<script type="text/javascript">

			function onMouseUp(e) {
				$('#username').focus();

				setemptyControl1();
				setemptyControl2();

				document.getElementById("divUsername").classList.add('has-warning');
				document.getElementById("username2").setAttribute("disabled", true);
			}

			const txtfocus = document.getElementById('wrapper');
			txtfocus.addEventListener('mouseup', onMouseUp, false);

			$(function() {
				setTimeout(function(){ $(".preloader").fadeOut(); }, 1000);
			});
			$('.place-image').hover(
				function() {$('.place-image').fadeIn('slow');},function() {
				$('.place-image').fadeOut('slow');
				}
			);

			$('#camImg1').hide();
			$('#camImg2').hide();

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
				if (localStorage.getItem('camera')!='disable') {
					Swal.fire({
							title: "ไม่สามารถบันทึกภาพได้ ",
							text: "กรุณาตรวจสอบอุปกรณ์ ( กล้อง )",
							showConfirmButton: true,
							onClose: () => {
								localStorage.setItem('camera', 'disable'); 
								window.location.replace("index.php");						
							}
					});
				}
			});

			if (localStorage.getItem('camera')=='disable') {		
				$('#camImg1').show();
				$('#camImg2').show();
				$('#my_camera').hide();
				$('#my_camera2').hide();
			}

			Webcam.attach('#my_camera');
			Webcam.attach('#my_camera2'); 

			// preload shutter audio clip
			var shutter = new Audio();
			shutter.autoplay = false;
			shutter.src = navigator.userAgent.match(/Firefox/) ? 'assets/sound/shutter.ogg' : 'assets/sound/shutter.mp3';

			function take_snapshot() {// Added by Utain Onniam [20/09/2022]
				console.log("##### Start take_snapshot #####");

				$('#capture-image').modal('hide');
				$('#scan-in').modal('show');		
				if (localStorage.getItem('camera') == 'allow') {

					console.log("Scan in camera allow ...");

					document.getElementById('results').innerHTML = '';// Clear webcam picture

					// play sound effect
					shutter.play();

					var queryStr = '?empId='+localStorage.getItem('empId')+'&lat='+localStorage.getItem('branchLat')+'&lot='+localStorage.getItem('branchLot')+'&cam='+localStorage.getItem('camera');
					console.log("queryStr = " + queryStr);
					
					Webcam.snap(function(imgBase64) {
						Webcam.upload(imgBase64, 'saveimage-in.php'+queryStr, function(code, text) {							
							
							//console.log(">> [imgBase64] = " + imgBase64);
							console.log(">> [code]      = " + code);
							console.log(">> [text]      = " + text);                            
							
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
								document.getElementById('results').innerHTML = '<center><img src="assets/icon/noimage.png"/></center>';
							} else {
								console.log(">>>>>> Start saveimage-in-data ...");									
								document.getElementById('results').innerHTML = '<center><img src="' + blobUri + '"/></center>';	
								console.log("result.innerHTML = " + blobUri);	
								saveImageInData(snapImg, logMessage, dateWithTime);
								console.log("func take_snapshot -> dateWithTime = " + dateWithTime);
								displayTimeScan('IN', dateWithTime);					
							}							
						});//end upload					
					});//end snap
				} else {
					console.log("Scan in camera disabled !!!");

					var queryStr = '?empId='+localStorage.getItem('empId')+'&lat='+localStorage.getItem('branchLat')+'&lot='+localStorage.getItem('branchLot')+'&cam='+localStorage.getItem('camera');
					console.log("queryStr = " + queryStr);

					$.post("saveimage-in.php"+queryStr, function(result) {
												
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
								document.getElementById('results').innerHTML = '<center><img src="assets/icon/noimage.png"/></center>';
						} else {
							console.log(">>>>>> Start saveimage-in-data ...");									
							document.getElementById('results').innerHTML = '<center><img src="' + blobUri + '"/></center>';	
							console.log("result.innerHTML = " + blobUri);	
							saveImageInData(snapImg, logMessage, dateWithTime);
							console.log("func take_snapshot -> dateWithTime = " + dateWithTime);
							displayTimeScan('IN', dateWithTime);					
						}						
					});
				}//end check camera

				console.log("##### End   take_snapshot #####");
			}

			function take_snapshot2() {// Added by Utain Onniam [23/09/2022]
				console.log("##### Start take_snapshot2 #####");

				// take snapshot and get image data
				$('#capture-image2').modal('hide');
				$('#scan-out').modal('show');	
				if (localStorage.getItem('camera') == 'allow') {

					console.log("Scan out camera allow ...");

					document.getElementById('results2').innerHTML = ''; // Clear webcam picture
					
					// play sound effect
					shutter.play();

					var queryStr = '?empId='+localStorage.getItem('empId')+'&lat='+localStorage.getItem('branchLat')+'&lot='+localStorage.getItem('branchLot')+'&cam='+localStorage.getItem('camera');
					console.log("queryStr = " + queryStr);

					Webcam.snap(function(imgBase64) {
						Webcam.upload(imgBase64, 'saveimage-out.php'+queryStr, function(code, text) {	
							
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
								document.getElementById('results2').innerHTML = '<center><img src="assets/icon/noimage.png"/></center>';
							} else {								
								console.log(">>>>>> Start saveimage-out-data ...");									
								document.getElementById('results2').innerHTML = '<center><img src="' + blobUri + '"/></center>';	
								console.log("result2.innerHTML = " + blobUri);	
								saveImageOutData(snapImg, logMessage, dateWithTime);
								console.log("func take_snapshot2 -> dateWithTime = " + dateWithTime);
								displayTimeScan('OUT', dateWithTime);
							}							
						});//end uplaod
					});//end snap

				} else {
					console.log("Scan out camera disabled ...");

					var queryStr = '?empId='+localStorage.getItem('empId')+'&lat='+localStorage.getItem('branchLat')+'&lot='+localStorage.getItem('branchLot')+'&cam='+localStorage.getItem('camera');
					console.log("queryStr = " + queryStr);

					$.post("saveimage-out.php"+queryStr, function(result) {						

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
							document.getElementById('results2').innerHTML = '<center><img src="assets/icon/noimage.png"/></center>';
						} else {							
							console.log(">>>>>> Start saveimage-out-data ...");									
							document.getElementById('results2').innerHTML = '<center><img src="' + blobUri + '"/></center>';	
							console.log("result2.innerHTML = " + blobUri);	
							saveImageOutData(snapImg, logMessage, dateWithTime);
							console.log("func take_snapshot2 -> dateWithTime = " + dateWithTime);
							displayTimeScan('OUT', dateWithTime);
						}
					});
				}
				
				console.log("########## End [take_snapshot2] ##########");
			}

			function saveImageInData(snapImg, logMessage, dateWithTime) {	
				console.log("call func -> saveImageInData");	
				$.post("saveimage-in-data.php", {									    
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
						console.log("Call scan in API result >> " + result);
						try {							
							if (result) {
								console.log("Valid scan in result = " + result);								
							} else {								
								console.log("Call scan in API Error !! ");												
							}
						} catch(err) {							
							console.log("Call scan in API Error !! ");			
						}
					}
				);				
			}

			function saveImageOutData(snapImg, logMessage, dateWithTime) {	
				console.log("call func -> saveImageOutData");		
				$.post("saveimage-out-data.php", {									    
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
						console.log("Call scan out API result >> " + result);
						try {							
							if (result) {
								console.log("Valid scan out result = " + result);								
							} else {								
								console.log("Call scan out API Error !! ");												
							}
						} catch(err) {							
							console.log("Call scan out API Error !! ");			
						}
					}
				);				
			}
			
			function displayTimeScan(Direction, dateWithTime) {
				console.log("func displayTimeScan -> " + Direction + "," + dateWithTime);
				if (dateWithTime) {
					if (Direction === 'IN') {
						$('#tbl_body').html('');
						while (!dateWithTime) {
							$('#tbl_body').html('<tr><th>1</th><td>ระบบกำลังดึงข้อมูลลงเวลาเข้างานล่าสุด !!, กรุณารอสักครู่ ...</td><td>OUT</td></tr>');
						} // Added by Utain Onniam [20/09/2022]

						if (!dateWithTime) {
							$('#tbl_body').html('<tr><th>1</th><td> ไม่พบข้อมูลลงเวลาเข้างาน !!, กรุณาถ่ายรูปลงเวลาเข้างานอีกครั้ง !!</td><td>OUT</td></tr>');
						} else {
							$('#tbl_body').html('<tr><th>1</th><td>' + dateWithTime + '</td><td>IN</td></tr>');
						}	
					} else {
						$('#tbl_body2').html('');
						while (!dateWithTime) {
							$('#tbl_body2').html('<tr><th>1</th><td>ระบบกำลังดึงข้อมูลลงเวลาเลิกงานล่าสุด !!, กรุณารอสักครู่ ...</td><td>OUT</td></tr>');
						} // Added by Utain Onniam [20/09/2022]

						if (!dateWithTime) {
							$('#tbl_body2').html('<tr><th>1</th><td> ไม่พบข้อมูลลงเวลาเลิกงาน !!, กรุณาถ่ายรูปลงเวลาเลิกงานอีกครั้ง !!</td><td>OUT</td></tr>');
						} else {
							$('#tbl_body2').html('<tr><th>1</th><td>' + dateWithTime + '</td><td>OUT</td></tr>');
						}	
					}			
				} else {
					console.log("func displayTimeScan -> Invalid dateWithTime !!");
				}
			}
		</script>	
	</body>

</html>

<!--Validate Form -->
<script>
	function setScanButton(boolval) {
		if (boolval) {
			$('#btnScanIn').html("ลงเวลาเข้างาน <i class='icon-circle-right2 ml-2'></i>").prop('disabled', true);
			$('#btnScanIn').css({'background-color':'#6c757d'});	
			$('#btnScanIn').css({'border-color':'#6c757d'});

			$('#btnScanOut').html("ลงเวลาเลิกงาน <i class='icon-circle-right2 ml-2'></i>").prop('disabled', true);
			$('#btnScanOut').css({'background-color':'#6c757d'});	
			$('#btnScanOut').css({'border-color':'#6c757d'});

		} else {
			$('#btnScanIn').html("ลงเวลาเข้างาน <i class='icon-circle-right2 ml-2'></i>").prop('disabled', false);
			$('#btnScanIn').css({'background-color':'#20c997'});	
			$('#btnScanIn').css({'border-color':'#20c997'});

			$('#btnScanOut').html("ลงเวลาเลิกงาน <i class='icon-circle-right2 ml-2'></i>").prop('disabled', false);
			$('#btnScanOut').css({'background-color':'#dc3545'});	
			$('#btnScanOut').css({'border-color':'#dc3545'});			
		}
	}

	function setemptyControl1() {
		document.getElementById("divUsername").classList = '';
		document.getElementById("username").classList = '';
		document.getElementById("divUsername").classList.add('form-group');
		document.getElementById("username").classList.add('form-control');
	}

	function setemptyControl2() {
		document.getElementById("divUsername2").classList = '';
		document.getElementById("username2").classList = '';
		document.getElementById("divUsername2").classList.add('form-group');
		document.getElementById("username2").classList.add('form-control');
	}

	function setHideAndEmpty() {
		$('#link-manager').hide();
		$('#link-hr').hide();
		$('#link-report').hide();
		$("#username").val("");
		$("#username2").val("");	
		$('#fullname').val("");
		$('#position').val("");
		$('#emp').val("");
	}

	setScanButton(true);
	setHideAndEmpty();
	document.getElementById("divUsername").classList.add("has-warning");
	var input  = document.getElementById('username');
	var input2 = document.getElementById('username2');
	var loc    = document.getElementById("display_loc");	

	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else { 
		loc.innerHTML = "Geolocation is not supported by this browser.";
	}

	function showPosition(position) {
		localStorage.setItem('currentLat', position.coords.latitude); 
		localStorage.setItem('currentLot', position.coords.longitude);
		if (localStorage.getItem('branchName') == null) {			
			window.location.href = 'index.html';	
		} else {
			loc.innerHTML = "<img src='./assets/icon/location.png' width='16px'/>&nbsp;" + localStorage.getItem('branchName');
		}				
	}
	
	input.onkeydown = function() {
		var key = event.keyCode || event.charCode;
		setemptyControl1();
		setemptyControl2();
		document.getElementById("divUsername").classList.add("has-warning");

		if(key == 8 || key == 46) {
			setHideAndEmpty();
			setScanButton(true);
		}
		var dInput = $("#username").val();
		if (key == 13 && dInput.length >= 5) {						
			
			$.post("repository/home/check-employee.php", {
					userid:     dInput,
					currentLat: localStorage.getItem('currentLat'),
					currentLot: localStorage.getItem('currentLot'),
					brn:        localStorage.getItem('branchName'),
					brncode:    localStorage.getItem('branchCode'),
					brnLat:     localStorage.getItem('branchLat'),
					brnLot:     localStorage.getItem('branchLot'),
					camera:     localStorage.getItem('camera')			
				}, 
				function(result) {	
					let response = jQuery.parseJSON(result);
					try {
						$.each(response, function(index) {      
							$status = index ;				
						});
						if ($status == 'success') {

							var str_snapname = response.success[0].EMP_ID + " - " + response.success[0].EMP_FULLNAME_TH;	
							var deptcode = response.success[0].DEPT_CODE;							

							setemptyControl1();
							document.getElementById("divUsername").classList.add("has-success");
							document.getElementById("username").classList.add("form-control-success");

							$('#dsp_snap_name').html(str_snapname).prop('disabled', true);
							$('#dsp_snap_name2').html(str_snapname).prop('disabled', true);
							$('#dsp_snap_summary').html(str_snapname).prop('disabled', true);
							$('#dsp_snap_summary2').html(str_snapname).prop('disabled', true);
						
							$('#fullname').val(response.success[0].EMP_FULLNAME_TH);
							$('#position').val(response.success[0].POS_NAME_TH);
							$("#role").val(response.success[0].ROLE_CODE);
							$("#emp").val(dInput);

							console.log("##### Start check-employee.php #####");
							console.log("[EMP_ID]          = " + response.success[0].EMP_ID);
							console.log("[EMP_FULLNAME_TH] = " + response.success[0].EMP_FULLNAME_TH);
							console.log("[POS_CODE]        = " + response.success[0].POS_CODE);
							console.log("[POS_NAME_TH]     = " + response.success[0].POS_NAME_TH);
							console.log("[DEPT_CODE]       = " + response.success[0].DEPT_CODE);
							console.log("[DEPT_NAME_TH]    = " + response.success[0].DEPT_NAME_TH);
							console.log("[ROLE_CODE]       = " + response.success[0].ROLE_CODE);
							console.log("[ROLE_NAME]       = " + response.success[0].ROLE_NAME);
							console.log("##### End   check-employee.php #####");

							//##### Save data to localStorage #####
							localStorage.setItem('empId' ,       response.success[0].EMP_ID);
							localStorage.setItem('empFullname' , response.success[0].EMP_FULLNAME_TH);
							localStorage.setItem('posCode' ,     response.success[0].POS_CODE);
							localStorage.setItem('posName' ,     response.success[0].POS_NAME_TH);
							localStorage.setItem('deptCode' ,    response.success[0].DEPT_CODE);
							localStorage.setItem('deptName' ,    response.success[0].DEPT_NAME_TH);
							localStorage.setItem('roleCode' ,    response.success[0].ROLE_CODE);
							localStorage.setItem('roleName' ,    response.success[0].ROLE_NAME);

							setemptyControl2();
							document.getElementById("username2").removeAttribute("disabled")
							document.getElementById("divUsername2").classList.add('has-warning');

							$('#username2').focus();
						} else {
							if($status == 'success') {
								Swal.fire({
									title: "รหัสพนักงานไม่ถูกต้อง",
									text: "กรณีพนักงานใหม่ สามารถลงเวลา เข้า-ออกได้ในวันรุ่งขึ้น",
									showConfirmButton: true,
									onClose: () => {}
								});								
							} else {
								Swal.fire({
									title: "พบปัญหาการเชื่อมต่อระบบฐานข้อมูล",
									text: "อีก 5 นาทีให้ทดลองอีกครั้ง หรือ ติดต่อผู้ดูแลระบบ",
									showConfirmButton: true,
									onClose: () => {}
								});
							}						
							document.getElementById("divUsername").classList.add("has-danger");
							document.getElementById("username").classList.add("form-control-danger");
							document.getElementById("username2").setAttribute("disabled", true);
							setScanButton(true);

							$("#username2").val("");	
							$('#username').focus();								
						}
					} catch(err) {						
						document.getElementById("divUsername").classList.add("has-danger");
						document.getElementById("username").classList.add("form-control-danger");
						document.getElementById("username2").setAttribute("disabled", true);
						
						setScanButton(true);					
						$("#username2").val("");	
						$('#username').focus();

						Swal.fire({
							title: "รหัสพนักงานไม่ถูกต้อง",
							text: "กรณีพนักงานใหม่ สามารถลงเวลา เข้า-ออกได้ในวันรุ่งขึ้น",
							showConfirmButton: true,
							onClose: () => {}
						});		
					}
				}
			);//end post			
		}
	};

	input2.onkeydown = function() {
		setemptyControl2();
		document.getElementById("divUsername2").classList.add('has-warning');
				
		var key = event.keyCode || event.charCode;
		if (key == 8 || key == 46) {
			$('#link-manager').hide();
			$('#link-hr').hide();
			$('#link-report').hide();			
			$("#username2").val("");			
			setScanButton(true);
		}
		if (key == 13) {
			var dInput = $(this).val();
			if (dInput == $("#username").val()) {
				setemptyControl2();
				document.getElementById("divUsername2").classList.add("has-success");
				document.getElementById("username2").classList.add("form-control-success");

				$('#dsp_snap_name').show();
				setScanButton(false);

				switch($("#role").val()) {
					case '<?php echo role_manager?>':
						$('#link-manager').show();
						break;
					case '<?php echo role_hr?>':
						$('#link-hr').show();
						break;
					default:
						$('#link-report').show();
				}
			} else {
				document.getElementById("divUsername2").classList.add("has-danger");
				document.getElementById("username2").classList.add("form-control-danger");
			}

			console.log("##### Start log localStorage data #####");
			console.log("[empId]       = " + localStorage.getItem('empId'));
			console.log("[empFullname] = " + localStorage.getItem('empFullname'));
			console.log("[posCode]     = " + localStorage.getItem('posCode'));
			console.log("[posName]     = " + localStorage.getItem('posName'));
			console.log("[deptCode]    = " + localStorage.getItem('deptCode'));
			console.log("[deptName]    = " + localStorage.getItem('deptName'));
			console.log("[currentLat]  = " + localStorage.getItem('currentLat'));
			console.log("[currentLot]  = " + localStorage.getItem('currentLot'));
			console.log("[lastStatus]  = " + localStorage.getItem('lastStatus'));
			console.log("[roleCode]    = " + localStorage.getItem('roleCode'));
			console.log("[roleName]    = " + localStorage.getItem('roleName'));
			console.log("[adActive]    = " + localStorage.getItem('adActive'));
			console.log("[branchCode]  = " + localStorage.getItem('branchCode'));
			console.log("[branchName]  = " + localStorage.getItem('branchName'));
			console.log("[branchLat]   = " + localStorage.getItem('branchLat'));
			console.log("[branchLot]   = " + localStorage.getItem('branchLot'));
			console.log("[camera]      = " + localStorage.getItem('camera'));
			console.log("##### End   log localStorage data #####");
		}
	};
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
		if( !regex.test(key) ) {
			theEvent.returnValue = false;
			if(theEvent.preventDefault) theEvent.preventDefault();
		}
	}
</script>
<!-- End Validate Input -->
<script>
	function scan_in() {		
		if ($("#emp").val() != '') {
			localStorage.setItem('employeeId', $("#emp").val());

			setemptyControl1();
			document.getElementById("divUsername").classList.add("has-success");
			document.getElementById("username").classList.add("form-control-success");

			if ($("#username").val() == $("#username2").val()) {
				setHideAndEmpty();
				setemptyControl1();
				setemptyControl2();
				setScanButton(true);
				$('#capture-image').modal('show');
				$('#take_snapshots').focus();
			} else {
				$('#username2').focus();
				setemptyControl2();
				document.getElementById("divUsername2").classList.add('has-warning');
			}
		} else {
			setemptyControl1();
			document.getElementById("divUsername").classList.add('has-warning');
		}
	}

	function scan_out() {
		if ($("#emp").val() != '') {
			localStorage.setItem('employeeId', $("#emp").val());

			setemptyControl1();
			document.getElementById("divUsername").classList.add("has-success");
			document.getElementById("username").classList.add("form-control-success");

			if ($("#username").val() == $("#username2").val()) {
				setHideAndEmpty();
				setemptyControl1();
				setemptyControl2();
				setScanButton(true);
				$('#capture-image2').modal('show');
				$('#take_snapshots2').focus();
			} else {
				$('#username2').focus();
				setemptyControl2();
				document.getElementById("divUsername2").classList.add('has-warning');
			}
		} else {
			setemptyControl1();
			document.getElementById("divUsername").classList.add('has-warning');
		}	
	}

	function linkHR() {
		var queryStr = '?empId='+localStorage.getItem('empId')+'&empName='+localStorage.getItem('empFullname')+'&posName='+localStorage.getItem('posName')+'&roleCode='+localStorage.getItem('roleCode');
        window.location.href = 'hr/index.php'+queryStr;
	}

	function linkManager() {
		var queryStr = '?empId='+localStorage.getItem('empId')+'&empName='+localStorage.getItem('empFullname')+'&posName='+localStorage.getItem('posName')+'&roleCode='+localStorage.getItem('roleCode');
        window.location.href = 'manager/index.php'+queryStr;
	}

	function linkReport() {
		var queryStr = '?empId='+localStorage.getItem('empId');
        window.location.href = 'report/index.php'+queryStr;
	}
</script>	