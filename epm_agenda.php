<?php
include ("assets/php/php_epm_profile.php");
include ("assets/php/php_epm_genset.php");
include ("assets/php/summary.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Agenda</title>
	
	<!--===============================================================================================-->
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link rel="stylesheet" href="assets/css/dashboard_main.css">
	<link rel="stylesheet" href="assets/css/animation.css">
	<link rel="stylesheet" href="assets/css/summary.css">
	<link rel="stylesheet" href="assets/css/chart.css">
   	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<!--===============================================================================================-->
</head>

<?php echo '<body style="background-image:url(data:image/jpeg;base64,'.base64_encode($gensetbackground).');background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">' ?> 
<div class="wrapper d-flex">
	<nav id="sidebar" class="" style="background-color: maroon;">
		<div class="custom-menu">
			
        </div>
	  	<div class="img bg-wrap text-center py-4" style="background-image: url(images/bg_1.jpg);">
			E-PLAN MO
	  	</div>
        <ul class="list-unstyled components mb-5">
        	<li>
            	<a href="epm_admin.php"><span class="fa fa-home mr-3"></span> Dashboard</a>
          	</li>
          	<li>
              <a href="epm_calendar.php"><span class="fa fa-calendar-week mr-3"></span> Calendar</a>
          	</li>
          	<li class="active">
            	<a href="epm_agenda.php"><span class="fa fa-calendar-check mr-3"></span> Agenda</a>
          	</li>
<!--
			<li>
            	<a href="https://mega.nz/file/T3AhzCgZ#BfyRpaYACNhw8AceTwl76YdSw__jPAN70wuRHQUk9-8g"><span><i class="fab fa-android mr-3"></i></span> Android Version</a>
          	</li>
-->
        </ul>
    </nav>
    <div id="content" class="d-flex flex-column">
    	<div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <i type="button" id="sidebarCollapse" class="fas fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $names; ?> <?php echo $sname; ?></span>
                                <?php echo '<img class="rounded-circle" height="50" width="50" alt="" loading="lazy" src="data:image/jpeg;base64,'.base64_encode($image).'"/>'; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="epm_profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.php" onclick="return confirm('Are you sure you want to Log Out?')">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
						<div class="col-lg-12">
							<?php if(isset($_SESSION['message']) && $_SESSION['status'] == 'error'): ?>
    						<div class="alert alert-danger">
    						<?php echo $_SESSION['message']; ?>
    						</div>
    						<?php elseif (isset($_SESSION['message']) && $_SESSION['status'] == 'success'):?>
    						<div class="alert alert-success">
    						<?php echo $_SESSION['message']; ?>
    						</div>     
    						<?php endif; ?>
    						<?php unset($_SESSION['message']); ?>
    						<?php unset($_SESSION['status']); ?>
						</div>
                      </div>
	<div class="row">
		<div class="col-md-3">
			<div class="row">
				<div class="col-xl-12 col-md-12 mb-4">
					<div class="card border-left-primary shadow py-2">
						<div class="card-header">
							<span style="text-align: center; color: black">TODAY</span>
						</div>
                    	<div class="card-body" style="flex: 0 1 auto; overflow-y: auto; max-height: calc(350px - 20px - 20px);">
							<div class="row overflow-auto">
							<?php 
							$sql = "SELECT * FROM events WHERE Name='$uname' AND (DATEDIFF(Start,NOW()) = 0)";
                			$result =$db->query($sql);
							while ($row = mysqli_fetch_array($result)) {?>
							<div class="col-xl-6 col-md-6 mb-4">
                				<div class="card border-top-primary shadow" style="border-left-style: solid; border-top-width: thick; border-top-color:rgb(0, 123, 255)">
                    				<div class="card-header">
										<span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $row['Title'] ?></span><br>
										<span class="text-gray text-uppercase mb-1">END : <?php echo $row['End'] ?></span>
									</div>
                  				</div>
							</div>
							<br>
							<?php  } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="row">
				<div class="col-xl-12 col-md-12 mb-4">
					<div class="card border-left-primary shadow py-2">
						<div class="card-header">
							<span style="text-align: center; color: black">TOMMOROW</span>
						</div>
                    	<div class="card-body" style="flex: 0 1 auto; overflow-y: auto; max-height: calc(350px - 20px - 20px);">
							<div class="row">
							<?php 
							$sql = "SELECT * FROM events WHERE Name='$uname' AND  (DATEDIFF(Start,NOW()) = 1)";
                			$result =$db->query($sql);
							while ($row = mysqli_fetch_array($result)) {?>
							<div class="col-xl-6 col-md-6 mb-4">
                				<div class="card border-top-primary shadow" style="border-left-style: solid; border-top-width: thick; border-top-color:rgb(0, 123, 255)">
                    				<div class="card-header">
										<span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $row['Title'] ?></span><br>
										<span class="text-gray text-uppercase mb-1">END : <?php echo $row['End'] ?></span>
									</div>
                  				</div>
							</div>
							<br>
							<?php  } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="row">
				<div class="col-xl-12 col-md-12 mb-4">
					<div class="card border-left-primary shadow py-2">
						<div class="card-header">
							<span style="text-align: center; color: black">WITHIN 7 DAYS</span>
						</div>
                    	<div class="card-body" style="flex: 0 1 auto; overflow-y: auto; max-height: calc(350px - 20px - 20px);">
							<div class="row">
							<?php 
							$sql = "SELECT * FROM events WHERE  Name='$uname' AND (DATEDIFF(Start,NOW()) BETWEEN 2 AND 7)";
                			$result =$db->query($sql);
							while ($row = mysqli_fetch_array($result)) {?>
							<div class="col-xl-6 col-md-6 mb-4">
                				<div class="card border-top-primary shadow" style="border-left-style: solid; border-top-width: thick; border-top-color:rgb(0, 123, 255)">
                    				<div class="card-header">
										<span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $row['Title'] ?></span><br>
										<span class="text-gray text-uppercase mb-1">END : <?php echo $row['End'] ?></span>
									</div>
                  				</div>
							</div>
							<br>
							<?php  } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="row">
				<div class="col-xl-12 col-md-12 mb-4">
					<div class="card border-left-primary shadow py-2">
						<div class="card-header">
							<span style="text-align: center; color: black">WITHIN 14 DAYS</span>
						</div>
                    	<div class="card-body" style="flex: 0 1 auto; overflow-y: auto; max-height: calc(350px - 20px - 20px);">
							<div class="row">
							<?php 
							$sql = "SELECT * FROM events WHERE Name='$uname' AND  (DATEDIFF(Start,NOW()) BETWEEN 8 AND 14)";
                			$result =$db->query($sql);
							while ($row = mysqli_fetch_array($result)) {?>
							<div class="col-xl-6 col-md-6 mb-4">
                				<div class="card border-top-primary shadow" style="border-left-style: solid; border-top-width: thick; border-top-color:rgb(0, 123, 255)">
                    				<div class="card-header">
										<span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $row['Title'] ?></span><br>
										<span class="text-gray text-uppercase mb-1">END : <?php echo $row['End'] ?></span>
									</div>
                  				</div>
							</div>
							<br>
							<?php  } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
	<div class="col-md-6">
			<div class="row">
				<div class="col-xl-12 col-md-12 mb-4">
					<div class="card border-left-primary shadow py-2">
						<div class="card-header">
							<center>
							<span style="text-align: center; color: black">MY GRADES</span>
								</center>
						</div>
                    	<div class="card-body" style="flex: 0 1 auto; overflow-y: auto; max-height: calc(350px - 20px - 20px);">
							<div class="row">
							<?php 
								$id = $_SESSION['User'];
								$sql = "SELECT * FROM grades WHERE User='$id'";
    							$result =$db->query($sql);
								while ($row = mysqli_fetch_array($result)) {
									$score = $row['Score'];
									$over = $row['Over'];
									$scode = $row['Subject_Code'];
									$percentage = (($score/$over) * 100);
									if($percentage >= 75){ ?>
										<div class="col-xl-4 col-md-4 mb-4">
                						<div class="card border-top-primary shadow" style="border-left-style: solid; border-top-width: thick; border-top-color:greenyellow">
                    						<div class="card-header">
												<div class="row">
													<div class="col-sm-12">
														<div>
															<span style="float: left">
															<span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $scode ?></span><br>
															<span class="text-gray text-uppercase mb-1"><?php echo $score ?>/<?php echo $over ?></span>
															</span>
															
															<span style="float: right">
															<span class="font-weight-bold text-dark text-uppercase mb-1" style="font-size: 20"><?php echo $percentage ?>% </span><br>
															<span>FAILED</span>
															</span>
														</div>
													</div>
												</div>
											</div>
                  						</div>
									</div>
								<?php }
								else{ ?>
									<div class="col-xl-4 col-md-4 mb-4">
                						<div class="card border-top-primary shadow" style="border-left-style: solid; border-top-width: thick; border-top-color:red">
                    						<div class="card-header">
												<div class="row">
													<div class="col-sm-12">
														<div>
															<span style="float: left">
															<span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $scode ?></span><br>
															<span class="text-gray text-uppercase mb-1"><?php echo $score ?>/<?php echo $over ?></span>
															</span>
															
															<span style="float: right">
															<span class="font-weight-bold text-dark text-uppercase mb-1" style="font-size: 20"><?php echo $percentage ?>% </span><br>
															<span>FAILED</span>
															</span>
														</div>
													</div>
												</div>
											</div>
                  						</div>
									</div>
								<?php 
									}
								}
								?>
							<br>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
<!--SCRIPTS-->  
<!--===============================================================================================-->  
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="assets/js/linechart.js"></script>
<!--===============================================================================================-->
<script src="assets/js/dashboard_main.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<!--===============================================================================================-->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
</body>
</html>