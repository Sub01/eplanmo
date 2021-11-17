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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
	
<!--NAVIGATION BAR-->
<!--=====================================================================================================================================-->	
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="#"><h2 style="font-family: Courier">EPM</h2></a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
         		<a class="nav-link" href="epm_admin.php">DASHBOARD</a>
        	</li>
			<li class="nav-item">
         		<a class="nav-link" href="epm_calendar.php">CALENDAR</a>
        	</li>
			<li class="nav-item">
         		<a class="nav-link" href="epm_agenda.php">AGENDA</a>
        	</li>
    </ul>
    <div class="dropdown d-flex align-items-center">
		
      	<a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  <?php echo '<img class="rounded-circle" height="50" width="50" alt="" loading="lazy" src="data:image/jpeg;base64,'.base64_encode($image).'"/>'; ?>
      	</a>
      	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
			<h6 class="dropdown-item disabled"><span class="text-gray-600 large"><?php echo $names; ?> <?php echo $sname; ?></span></h6> 
    		<a class="dropdown-item" href="epm_profile.php"><i class="far fa-id-card"></i> Profile</a>
    		<a class="dropdown-item" href="assets/php/session_logout.php" onclick="return confirm('Are you sure you want to Log Out?')"><i class="fas fa-sign-out-alt"></i> Log Out</a>
  		</div>
    </div>
  </div>
</nav>

	
	
<!--ALERT MESSAGES-->
<!--=====================================================================================================================================-->		
<div class="container-fluid" style="margin-top:20px;">
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

	
	
	
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<div class="row">
				<div class="col-xl-12 col-md-12 mb-4">
					<div class="card border-left-primary shadow py-2">
						<div class="card-header">
							EVENTS FOR TODAY
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
							EVENTS FOR TOMMOROW
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
							WITHIN 7 DAYS
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
							WITHIN 14 DAYS
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
							MY GRADES
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
										<div class="col-xl-6 col-md-6 mb-4">
                							<div class="card border-top-primary shadow" style="border-left-style: solid; border-top-width: thick; border-top-color:green">
                    							<div class="card-header">
													<div class="col-lg-8">
														<span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $scode ?></span><br>
														<span class="text-gray text-uppercase mb-1"><?php echo $score ?>/<?php echo $over ?></span>
													</div>
													<div class="col-lg-4">
														<span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $percentage ?>% - PASS</span><br>
													</div>
												</div>
                  							</div>
										</div>
								<?php }
								else{ ?>
									<div class="col-xl-6 col-md-6 mb-4">
                						<div class="card border-top-primary shadow" style="border-left-style: solid; border-top-width: thick; border-top-color:red">
                    						<div class="card-header">
												<div class="col-lg-8">
													<span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $scode ?></span><br>
													<span class="text-gray text-uppercase mb-1"><?php echo $score ?>/<?php echo $over ?></span>
												</div>
												<div class="col-lg-4">
													<span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $percentage ?>% - FAILED</span><br>
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
</body>
</html>