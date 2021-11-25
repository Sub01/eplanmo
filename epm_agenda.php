<?php
include ("assets/php/php_epm_profile.php");
include ("assets/php/php_epm_genset.php");
include ("assets/php/summary.php");
session_start();

if(!isset($_SESSION["User"])){
	header("Location: index.php");
	exit();
}	
elseif(isset($_POST['sub'])){
	$scode = $_POST['scode'];
	$sdes = $_POST['sdes'];
	$sid = $_POST['$sid'];
	$sql = "UPDATE subjects SET S_Code='$scode' AND S_Description='$sdes' WHERE ID='$sid'";
	$result = $db->query($sql);
		if($result){
			$_SESSION['status'] = "success";
   			$_SESSION['message'] = "Subject's Information Successfuly Updated";
			header("Location: epm_agenda.php");
			exit();
		}
		else{
			$_SESSION['status'] = "error";
   			$_SESSION['message'] = "Failed to Update Subject's Information";
			header("Location: epm_agenda.php");
			exit();
		}
}
elseif(isset($_POST['teacher'])){
		$tname = $_POST['tname'];
		$tsname = $_POST['tsname'];
		$temail = $_POST['temail'];
		$tid = $_POST['tid'];
		$sql = "UPDATE `teachers` SET `T_Name`='$tname', `T_Surname`='$tsname', `T_Email`='$temail' WHERE `ID`='$tid'";
		$result = $db->query($sql);
		if($result){
			$_SESSION['status'] = "success";
   			$_SESSION['message'] = "Teacher's Information Successfuly Updated";
			header("Location: epm_agenda.php");
			exit();
		}
		else{
			$_SESSION['status'] = "error";
   			$_SESSION['message'] = "Failed to Update Teacher's Information";
			header("Location: epm_agenda.php");
			exit();
		}
	}

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
			<li>
				<a href="http://www.tomatotimers.com/"><span class="fa fa-calendar-check mr-3"></span> Pomodoro Technique</a>
			</li>
          	<li>
            	<a href="https://mega.nz/file/T3AhzCgZ#BfyRpaYACNhw8AceTwl76YdSw__jPAN70wuRHQUk9-8"><span><i class="fab fa-android mr-3"></i></span> Android Version</a>
          	</li>
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
							<span style="text-align: center; color: black; font-weight: bold">TODAY</span>
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
							<span style="text-align: center; color: black; font-weight: bold">TOMMOROW</span>
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
							<span style="text-align: center; color: black; font-weight: bold">WITHIN 7 DAYS</span>
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
							<span style="text-align: center; color: black; font-weight: bold">WITHIN 14 DAYS</span>
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
	<div class="col-md-7">
			<div class="row">
				<div class="col-xl-12 col-md-12 mb-4">
					<div class="card border-left-primary shadow py-2">
						<div class="card-header">
							<span style="text-align: center; color: black; font-weight: bold">MY TEACHERS</span>
						</div>
                    	<div class="card-body" style="flex: 0 1 auto; overflow-y: auto; max-height: calc(350px - 20px - 20px);">
							<table class="table">
								<thead>
									<tr>
										<th hidden="">ID</th>
										<th>NAME </th>
										<th>LAST NAME </th>
										<th>EMAIL </th>
										<th>FUNTION </th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$id = $_SESSION['User'];
									$sql = "SELECT * FROM teachers WHERE User='$id'";
    								$result =$db->query($sql);
									while ($row = mysqli_fetch_array($result)) {?>
									<tr>
										<td hidden=""><?php echo $row['ID']?>  </td>
										<td><?php echo $row['T_Name']?></td>
										<td><?php echo $row['T_Surname']?></td>
										<td><?php echo $row['T_Email']?></td>
										<td>
											<button class="btn btn-warning editteacher" data-bs-toggle="modal" data-bs-target="#updateTeacher"><i class="fas fa-edit"></i></button>
											<button class="btn btn-danger"><i class="fas fa-trash"></i></button>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="row">
				<div class="col-xl-12 col-md-12 mb-4">
					<div class="card border-left-primary shadow py-2">
						<div class="card-header">
							<span style="text-align: center; color: black; font-weight: bold">MY SUBJECTS</span>
						</div>
                    	<div class="card-body" style="flex: 0 1 auto; overflow-y: auto; max-height: calc(350px - 20px - 20px);">
							<table class="table">
								<thead>
									<tr>
										<th hidden="">ID</th>
										<th>Subject Code </th>
										<th>Subject Description</th>
										<th>FUNTION </th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$id = $_SESSION['User'];
									$sql = "SELECT * FROM subjects WHERE User='$id'";
    								$result =$db->query($sql);
									while ($row = mysqli_fetch_array($result)) {?>
									<tr>
										<td hidden=""><?php echo $row['ID']?>  </td>
										<td><?php echo $row['S_Code']?></td>
										<td><?php echo $row['S_Description']?></td>
										<td>
											<button class="btn btn-warning editsubject" data-bs-toggle="modal" data-bs-target="#updateSubject"><i class="fas fa-edit"></i></button>
											<button class="btn btn-danger"><i class="fas fa-trash"></i></button>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
	<div class="col-md-12">
			<div class="row">
				<div class="col-xl-12 col-md-12 mb-4">
					<div class="card border-left-primary shadow py-2">
						<div class="card-header">
							<center>
							<span style="text-align: center; color: black; font-weight: bold">MY GRADES</span>
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
									$stype = $row['Type'];
									$percentage = (($score/$over) * 100);
									if($percentage >= 75){ ?>
										<div class="col-xl-4 col-md-4 mb-4">
                						<div class="card border-top-primary shadow" style="border-left-style: solid; border-top-width: thick; border-top-color:green">
											<div class="card-header">
												<center>
													<span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $scode ?> | <?php echo $stype ?></span>
													<span style="float: right"><button type="button" class="close" data-dismiss="modal" aria-label="Close"></span>
												</center>
											</div>
                    						<div class="card-body">
												<div class="row">
													<div class="col-sm-12">
														<div>
															<span style="float: left">
															<span class="font-weight-bold text-dark text-uppercase mb-1">SCORE</span><br>
															<span class="text-gray text-uppercase mb-1"><?php echo $score ?>/<?php echo $over ?></span>
															</span>
															
															<span style="float: right">
															<span class="font-weight-bold text-dark text-uppercase mb-1" style="font-size: 20"><?php echo $percentage ?>% </span><br>
															<span>PASS</span>
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
												<center>
													<span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $scode ?> | <?php echo $stype ?></span>
													<span style="float:right"><button type="button" class="close" data-dismiss="modal" aria-label="Close"></span>
												</center>
											</div>
                    						<div class="card-body">
												<div class="row">
													<div class="col-sm-12">
														<div>
															<span style="float: left">
															<span class="font-weight-bold text-dark text-uppercase mb-1">SCORE</span><br>
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
		
		
<div class="modal fade" id="updateTeacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Teacher Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
         <div class="form-group">
            <label>Name</label>
            <input  hidden="" name="tid" id="tid" value="">
            <input class="form-control" type="text" name="tname" id="tname" value="">
         </div>
         <div class="form-group">
            <label>Last Name</label>
            <input class="form-control" type="text" name="tsname" id="tsname" value="">
         </div>
         <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" name="temail" id="temail" value="">
         </div>
		<div class="form-group">
        	<button class="form-control" type="submit" class="btn btn-primary" name="teacher">Save changes</button>
      	</div>
        </form>
      </div>
      
    </div>
  </div>
</div>		

<div class="modal fade" id="updateSubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Subject Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
         <div class="form-group">
            <label>Subject Code</label>
            <input  hidden="" name="sid" id="sid" value="">
            <input class="form-control" type="text" name="scode" id="scode" value="">
         </div>
         <div class="form-group">
            <label>Subject Description</label>
            <input class="form-control" type="text" name="sdes" id="sdes" value="">
         </div>
		<div class="form-group">
        	<button class="form-control" type="submit" class="btn btn-primary" name="sub">Save changes</button>
      	</div>
        </form>
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
<script>
		
$(document).ready(function(){
   $('.editteacher').on('click', function(){
      $('#updateTeacher').modal('show');
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function(){
         return $(this).text();
      }).get();
      console.log(data);
      $('#tid').val(data[0]);
      $('#tname').val(data[1]);
      $('#tsname').val(data[2]);
      $('#temail').val(data[3]);
   });
});	

$(document).ready(function(){
   $('.editsubject').on('click', function(){
      $('#updateSubject').modal('show');
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function(){
         return $(this).text();
      }).get();
      console.log(data);
      $('#sid').val(data[0]);
      $('#scode').val(data[1]);
      $('#sdes').val(data[2]);
   });
});	
</script>
</body>
</html>