<?php 
?>

<style>
.hidden{
	display:none;
}
</style>        
		<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
					
                    <ul id="sidebarnav">
                        <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
															<img src="images/avatar/human.png" alt="user-img" class="img-circle">
															<span class="hide-menu"><?php echo  $s_username;?></span>
															<small class="hide-menu"><?php echo  $s_role;?></small>
														</a>
                            <ul aria-expanded="false" class="collapse">    
					<li><a href="teacher.info.php"><i class="ti-settings"></i> Account Setting</a></li>
					<li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </li>
                        <li class="nav-small-cap text-center">--- MENU NAVIGATION ---</li>
					<?php if($s_userid != ""){ ?>
								<li class="<?php echo  $role["home"];?>"> 
									<a class="waves-effect waves-dark" href="home.php"><i class="fas fa-home"></i><span class="hide-menu">Dashboard</span></a>
								</li>
								<li class="<?php echo  $role["configuration"];?>"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-folder-open"></i><span class="hide-menu">Configuration <!--<span class="badge badge-pill badge-cyan ml-auto">4</span>--></span></a>
									<ul aria-expanded="false" class="collapse">																																
										<li class="<?php echo  $role["user_php"];?>" ><a href="user.php">ผู้ใช้ระบบ</a></li>
									</ul>
								</li>																 
								<li class="<?php echo  $role["document"];?>" > <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-folder-open"></i><span class="hide-menu">Document</span></a>
									<ul aria-expanded="false" class="collapse">    
										<li class="<?php echo  $role["payment_php"];?>" ><a href="payment.php">ลงบันทึก</a></li> 								
										<li class="<?php echo  $role["receive_php"];?>" ><a href="receive.php">ชำระเงิน</a></li> 
									</ul>
								</li>			
								<li class="<?php echo  $role["report"];?>" > <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-folder-open"></i><span class="hide-menu">Report <!--<span class="badge badge-pill badge-cyan ml-auto">4</span>--></span></a>
									<ul aria-expanded="false" class="collapse">
										<li ><a href="report.php?mode=dailysum">รายงานสรุปประจำวัน</a></li> 														
									</ul>
								</li>					
					<?php } ?>							
			</ul>
				  
				   
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
