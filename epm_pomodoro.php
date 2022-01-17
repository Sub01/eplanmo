<?php
include ("assets/php/php_epm_profile.php");
include ("assets/php/php_epm_genset.php");
include ("assets/php/summary.php");

if(!isset($_SESSION['User'])){
	header("Location: index.php");
	exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
   <title>POMODORO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link rel="stylesheet" href="assets/css/animation.css">
	<link rel="stylesheet" href="assets/css/summary.css">
	<link rel="stylesheet" href="assets/css/chart.css">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/general.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/pomodoro.css">


  </head>
  
<?php echo '<body class="page-top" style="background-image:url(data:image/jpeg;base64,'.base64_encode($gensetbackground).');background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">' ?>    
<div class="wrapper d-flex">
	<nav id="sidebar" class="" style="background-color: maroon;">
		<div class="custom-menu">
			
        </div>
	  	<div class="img bg-wrap text-center py-4">
			E-PLAN MO
	  	</div>
        <ul class="list-unstyled components mb-5">
        	<li class="active">
            	<a href="epm_admin.php"><span class="fas fa-home mr-3"></span> Dashboard</a>
          	</li>
          	<li>
              <a href="epm_calendar.php"><span class="fas fa-calendar-week mr-3"></span> Calendar</a>
          	</li>
          	<li>
            	<a href="epm_agenda.php"><span class="fas fa-calendar-check mr-3"></span> Agenda</a>
          	</li>
            <li>
            	<a href="epm_teachers.php"><span class="fas fa-chalkboard-teacher mr-3"></span> Teachers</a>
          	</li>
            <li>
            	<a href="epm_subjects.php"><span class="fas fa-book mr-3"></span> Subjects</a>
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
                        <div class="col-lg-1 col-md-1 col-sm-1">
                        
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <div class="row">
                                <div id="timer">
                                    <div id="time">
                                        <span id="minutes">25</span>
                                        <span id="colon">:</span>
                                        <span id="seconds">00</span>
                                    </div>
                                    <div id="filler"></div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-sm- btn-primary">Start</button>
                                <button class="btn btn-sm- btn-success">Short Break</button>
                                <button class="btn btn-sm- btn-success">Long Break</button>
                                <button class="btn btn-sm- btn-danger">Stop</button>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1">
                        
                        </div>
                    </div>
                </div>
			</div>
<footer class="fixed-bottom" style="color:white; background-color: black;">
	<p>&copy; Gino Toralba & The rest of DS04 EST 2021</p>
</footer>
</div>


	  



<!--MODAL FOR UPDATE EVENT-->  
<!--===============================================================================================--> 
<div class="modal fade" id="updateEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="assets/php/update_event.php">
         <div class="form-group">
            <label>Event Title</label>
            <input hidden="" name="ID" id="ID" value="">
            <input type="text" name="title" id="title" value="">
         </div>
         <div class="form-group">
            <label>Event Type</label>
            <input type="text" name="type" id="type" value="">
         </div>
         <div class="form-group">
            <label>Event Start</label>
            <input type="datetime-local" name="start" id="start" value="">
         </div>
         <div class="form-group">
            <label>Event End</label>
            <input type="datetime-local" name="end" id="end" value="">
         </div>
		<div class="form-group">
        	<button type="submit" class="btn btn-primary">Save changes</button>
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
<!--===============================================================================================-->
<script src="assets/js/dashboard_main.js"></script>
<!--===============================================================================================-->

<script>
$(document).ready( function () {
    $('#table1').DataTable({
      "autoWidth": true
    });
} );
$(document).ready( function () {
    $('#table2').DataTable({
      "autoWidth": true
    });
} );
$("document").ready(function(){
    setTimeout(function(){
       $("div.alert").remove();
		
    }, <?php echo $gensetmodclose ?> ); 

});
</script>
  </body>
</html>