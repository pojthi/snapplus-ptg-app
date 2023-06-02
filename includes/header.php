            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                <!--
                    <a class="navbar-brand" href="main.php">
                -->    
                    <a class="navbar-brand" href="javascript:headerLinkMain()">	
                        <b>
                            <img src="../assets/images/ptg_logo.png" width="50px" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
						<span>SNAP PLUS ++</span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
							<a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a>
						</li>
                        <li class="nav-item">
							<a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a>
						</li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- User Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icon-user"></i>								
                                <!--
                                 <span class="hidden-md-down"><?php echo $_GET["fullName"]; ?>&nbsp;<i class="fa fa-angle-down"></i></span>
                                -->    
                                <span id="fullNameSpan" class="hidden-md-down"><?php echo $_GET["fullName"]; ?>&nbsp;<i class="fa fa-angle-down"></i></span>
							</a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <!-- text-->
                                <div class="dropdown-divider"></div>
                                <!-- text-->
                                <a href="../logout.php" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                                <!-- text-->
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End User Profile -->
                        <!-- ============================================================== -->
                    </ul>
                    <script src="../assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
                    <script>

                        var fullNameLocal = localStorage.getItem('empFullname');
                        var spanHtml = fullNameLocal + '&nbsp;' + '<i class="fa fa-angle-down"></i>';
                        $("#fullNameSpan").html(spanHtml);

                        function headerLinkMain() {
                            var queryStr = '?roleCode='+localStorage.getItem('roleCode')+'&fullName='+localStorage.getItem('empFullname');
                            window.location.href = 'main.php'+queryStr;
                        }
                    </script>
                </div>
            </nav>