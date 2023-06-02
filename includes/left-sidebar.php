            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!--
                        <li class="active"> <a class="waves-effect waves-dark" href="main.php" aria-expanded="false"><i class="icon-speedometer"></i>
						    <span class="hide-menu">Dashboard</span></a>
						</li>
                        -->
                        <li class="active"> <a class="waves-effect waves-dark" href="javascript:linkMain()" aria-expanded="false"><i class="icon-speedometer"></i>
						    <span class="hide-menu">Dashboard</span></a>
						</li>
                        <!--
                        <li><a class="waves-effect waves-dark" href="tempstaff.php" aria-expanded="false"><i class="ti-layout-accordion-merged"></i>
                        -->
                        <li><a class="waves-effect waves-dark" href="javascript:linkTempStaff()" aria-expanded="false"><i class="ti-layout-accordion-merged"></i>
						<span class="hide-menu">พนักงาน [ ชั่วคราว ]</span></a>
						</li>
                        <li>
							<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false">
							<i class="ti-layout-accordion-merged"></i><spanclass="hide-menu">รายงาน</span>
							</a>
                            <!--							
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="report.php">ลงเวลาพนักงาน</a></li>
								<li><a href="report-activity.php">การเข้าใช้ระบบ</a></li>
								<li><a href="report-nocamera.php">อุปกรณ์กล้องไม่บันทึก</a></li>
                            </ul>
                            -->
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="javascript:linkReport()">ลงเวลาพนักงาน</a></li>
								<li><a href="javascript:linkRptActivity()">การเข้าใช้ระบบ</a></li>
								<li><a href="javascript:linkRptNoCamera()">อุปกรณ์กล้องไม่บันทึก</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <script>
                function linkMain() {
                    var queryStr = '?roleCode='+localStorage.getItem('roleCode')+'&fullName='+localStorage.getItem('empFullname');
                    window.location.href = 'main.php'+queryStr;
                }

                function linkTempStaff() {
                    var queryStr = '?roleCode='+localStorage.getItem('roleCode')+'&fullName='+localStorage.getItem('empFullname');
                    window.location.href = 'tempstaff.php'+queryStr;
                }

                function linkReport() {
                    var queryStr = '?roleCode='+localStorage.getItem('roleCode')+'&fullName='+localStorage.getItem('empFullname');
                    window.location.href = 'report.php'+queryStr;
                }

                function linkRptActivity() {
                    var queryStr = '?roleCode='+localStorage.getItem('roleCode')+'&fullName='+localStorage.getItem('empFullname');
                    window.location.href = 'report-activity.php'+queryStr;
                }

                function linkRptNoCamera() {
                    var queryStr = '?roleCode='+localStorage.getItem('roleCode')+'&fullName='+localStorage.getItem('empFullname');
                    window.location.href = 'report-nocamera.php'+queryStr;
                }
            </script>