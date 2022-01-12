<?php
include ("assets/php/php_epm_profile.php");
include ("assets/php/php_epm_genset.php");
include ("assets/php/summary.php");

if(!isset($_SESSION["User"])){
	header("Location: index.php");
	exit();
}	
else{
    $id = $_SESSION['User'];
    if(isset($_POST['sub'])){
        $sql = "UPDATE `subjects` SET `S_Code`='$scode', `S_Description`='$sdes' WHERE `ID`='$sid'";
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
    elseif(isset($_POST['adds'])){
		$scode= $_POST['scode'];
		$sdes= $_POST['sdes'];
		$sql = "INSERT INTO subjects (`S_Code`,`S_Description`,`User`) VALUES ('$scode','$sdes','$id')";
		$result = mysqli_query($db, $sql);
		if($result){
			$_SESSION['status'] = "success";
   			$_SESSION['message'] = "Subject Added Successfully";
   			header("Location: /epm_calendar.php");
   			exit();
		}
		else{
			$_SESSION['status'] = "error";
   			$_SESSION['message'] = "Failed to add subject!";
   			header("Location: /epm_calendar.php");
   			exit();
		}
	}
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Subjects</title>
	
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
          	<li>
            	<a href="epm_agenda.php"><span class="fa fa-calendar-check mr-3"></span> Agenda</a>
          	</li>
            <li>
            	<a href="epm_teachers.php"><span class="fa fa-school mr-3"></span> Teachers</a>
          	</li>
             <li class="active">
            	<a href="epm_subjects.php"><span class="fa fa-chalkboard-teacher mr-3"></span> Subjects</a>
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
        <div class="col-xl-12 col-md-12 mb-4">
            		<div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-header">
                            <button class="btn btn-primary btn-sm" style="margin:5px;" data-toggle="modal" data-target="#addSubject"><i class="fas fa-plus"></i> ADD SUBJECT</button>
                        </div>
                		<div class="card-body" style="overflow-x:auto;">
                    		<table class="table table-bordered">
								<thead>
									<tr>
										<th hidden="">ID</th>
										<th>SUBJECT CODE</th>
										<th>DESCRIPTION</th>
										<th>ACTION </th>
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
											<button class="btn btn-warning btn-sm editsubject" data-bs-toggle="modal" data-bs-target="#updateSubject"><i class="fas fa-edit"></i></button>
											<a href="assets/php/delete_subjects.php?id=<?php echo $row['ID'] ?>" onclick="return confirm('Are you sure you want to delete this subject?')"><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></a>
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
		
<div class="modal fade" id="addSubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Teacher Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
            <div class="form-group">
                <label>Subject Code</label>
                <input class="form-control" type="text" name="scode" id="scode" value="">
            </div>
            <div class="form-group">
                <label>Subject Description</label>
                <input class="form-control" type="text" name="sdes" id="sdes" value="">
            </div>
            <div class="form-group">
        	   <button class="form-control" type="submit" class="btn btn-primary" name="adds">ADD SUBJECT</button>
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
$("document").ready(function(){
    setTimeout(function(){
       $("div.alert").remove();
		
    }, <?php echo $gensetmodclose ?> ); 

});
</script>
</body>
</html>