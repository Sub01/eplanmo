<?php
include ("assets/php/php_epm_profile.php");
include ("assets/php/php_epm_genset.php");
include ("assets/php/summary.php");
?>
<!doctype html>
<html lang="en">
  <head>
   <title>DASHBOARD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link rel="stylesheet" href="assets/css/dashboard_main.css">
	<link rel="stylesheet" href="assets/css/animation.css">
	<link rel="stylesheet" href="assets/css/summary.css">
	<link rel="stylesheet" href="assets/css/chart.css">
<!--===============================================================================================-->
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
	  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


  </head>
  
  <?php echo '<body style="background-image:url(data:image/jpeg;base64,'.base64_encode($gensetbackground).');background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">' ?>    
	  
	
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
		<div class="col-lg-12">
			<div class="row">
				<div class="col-xl-2 col-md-2 mb-4">
                	<div class="card border-left-primary shadow h-100 py-2" style="border-left-style: solid; border-left-width: thick; border-left-color:rgb(0, 123, 255) ">
                    	<div class="card-body">
                        	<div class="row no-gutters align-items-center">
                            	<div class="col mr-2">
                                	<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    	TOTAL ACTIVITIES
									</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
										<?php echo $all ?>
									</div>
                               	</div>
                            	<div class="col-auto">
                                	<i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                          	</div>
                      	</div>
                  	</div>
               	</div>
				<div class="col-xl-2 col-md-2 mb-4">
            		<div class="card border-left-success shadow h-100 py-2" style="border-left-style: solid; border-left-width: thick; border-left-color:rgb(108, 117, 125)">
                		<div class="card-body">
                    		<div class="row no-gutters align-items-center">
                        		<div class="col mr-2">
                            		<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                		ONGOING ACTIVITIES
                            		</div>
                            		<div class="h5 mb-0 font-weight-bold text-gray-800">
                                		<?php echo $ongoing ?>
                            		</div>
                        		</div>
                        		<div class="col-auto">
                            		<i class="fas fa-calendar fa-2x text-gray-300"></i>
                        		</div>
                    		</div>
                		</div>
            		</div>
        		</div>
				<div class="col-xl-2 col-md-2 mb-4">
            		<div class="card border-left-info shadow h-100 py-2" style="border-left-style: solid; border-left-width: thick; border-left-color:rgb(40, 167, 69)">
                		<div class="card-body">
                    		<div class="row no-gutters align-items-center">
                        		<div class="col mr-2">
                            		<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                		ENDED ACTIVITIES
                            		</div>
                            		<div class="h5 mb-0 font-weight-bold text-gray-800">
                                		<?php echo $ended ?>
                            		</div>
                        		</div>
                        		<div class="col-auto">
                            		<i class="fas fa-calendar fa-2x text-gray-300"></i>
                        		</div>
                    		</div>
                		</div>
            		</div>
        		</div>
				<div class="col-xl-2 col-md-2 mb-4">
            		<div class="card border-left-warning shadow h-100 py-2" style="border-left-style: solid; border-left-width: thick; border-left-color:rgb(220, 53, 69)">
                		<div class="card-body">
                    		<div class="row no-gutters align-items-center">
                        		<div class="col mr-2">
                            		<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                		ARCHIVED
                            		</div>
                            		<div class="h5 mb-0 font-weight-bold text-gray-800">
                                		<?php echo $archived ?>
                            		</div>
                        		</div>
                        		<div class="col-auto">
                            		<i class="fas fa-calendar fa-2x text-gray-300"></i>
                        		</div>
                    		</div>
                		</div>
            		</div>
        		</div>
				<div class="col-xl-2 col-md-2 mb-4">
            		<div class="card border-left-warning shadow h-100 py-2" style="border-left-style: solid; border-left-width: thick; border-left-color:rgb(255, 193, 7)">
                		<div class="card-body">
                    		<div class="row no-gutters align-items-center">
                        		<div class="col mr-2">
                            		<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                		TEACHERS
                            		</div>
                            		<div class="h5 mb-0 font-weight-bold text-gray-800">
                                		<?php echo $archived ?>
                            		</div>
                        		</div>
                        		<div class="col-auto">
                            		<i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        		</div>
                    		</div>
                		</div>
            		</div>
        		</div>
				<div class="col-xl-2 col-md-2 mb-4">
            		<div class="card border-left-warning shadow h-100 py-2" style="border-left-style: solid; border-left-width: thick; border-left-color:rgb(23, 162, 184)">
                		<div class="card-body">
                    		<div class="row no-gutters align-items-center">
                        		<div class="col mr-2">
                            		<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                		SUBJECTS
                            		</div>
                            		<div class="h5 mb-0 font-weight-bold text-gray-800">
                                		<?php echo $archived ?>
                            		</div>
                        		</div>
                        		<div class="col-auto">
                            		<i class="fas fa-book-open fa-2x text-gray-300"></i>
                        		</div>
                    		</div>
                		</div>
            		</div>
        		</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-6 col-md-6 mb-4">
			 <div class="card border-left-warning shadow h-100 py-2">
				<div class="card-header">
					<strong>ONGOING EVENTS</strong>
				</div>
				<div class="card-body" style="overflow-x:auto;">
				<table class="table display" id="table1">
                	<thead>
                		<tr>
                    		<th hidden="">ID</th>
                      		<th>Event Name</th>
                      		<th>Event Type</th>
                      		<th>Start Date</th>
                      		<th>End Date</th>
                      		<th>Functions</th>
                   		</tr>
                	</thead>
                	<tbody>
                	<?php
                	$sql = "SELECT * FROM events WHERE Name='$username' AND Status='Ongoing'";
                	$result =$db->query($sql);
                	while ($row = mysqli_fetch_array($result)) {?>
                		<tr>
                			<td hidden=""><?php echo $row['ID'] ?></td>
                        	<td><?php echo $row['Title'] ?></td>
                       	 	<td><?php echo $row['Type'] ?></td>
                        	<td><?php echo $row['Start'] ?></td>
                        	<td><?php echo $row['End'] ?></td>
                        	<td>
                        		<button type="button" class="btn btn-primary editbutton" data-bs-toggle="modal" data-bs-target="#updateEvent"><i class="fas fa-edit"></i></button>
                            	<a name="archived" href="assets/php/event_archived.php?id=<?php echo $row['ID']?>" class="btn btn-warning" onclick="return confirm('Are you sure you want to archive this event?')"><i class="fas fa-archive"></i></a>
                        	</td>
                  		</tr>
                    <?php  } ?>
              		</tbody>
           		</table>
				</div>
			</div>
      	</div>
		<div class="col-lg-6">
			<div class="row">
				<div class="col-xl-12 col-md-12 mb-4">
					<div class="card border-left-warning shadow h-100 py-2">
            			<div class="card-body">
							<div id="chartContainer" style="height: 300px; width: 100%;">
  							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	  
	  
<footer class="fixed-bottom" style="color:white; background-color: black;">
	<p>&copy; Gino Toralba & The rest of DS04 EST 2021</p>
</footer>


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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="assets/js/linechart.js"></script>
<!--===============================================================================================-->
<script src="assets/js/dashboard_main.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<!--===============================================================================================-->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

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
	
	
$(document).ready(function(){
   $('.editbutton').on('click', function(){
      $('#updateEvent').modal('show');
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function(){
         return $(this).text();
      }).get();

      console.log(data);

      var dateVal = new Date(data[3]);
      var day = dateVal.getDate().toString().padStart(2, "0");
      var month = (1 + dateVal.getMonth()).toString().padStart(2, "0");
      var hour = dateVal.getHours().toString().padStart(2, "0");
      var minute = dateVal.getMinutes().toString().padStart(2, "0");
      var sec = dateVal.getSeconds().toString().padStart(2, "0");
      var ms = dateVal.getMilliseconds().toString().padStart(3, "0");
      var inputDate = dateVal.getFullYear() + "-" + (month) + "-" + (day) + "T" + (hour) + ":" + (minute) + ":" + (sec) + "." + (ms);

      var dateVal2 = new Date(data[4]);
      var day2 = dateVal2.getDate().toString().padStart(2, "0");
      var month2 = (1 + dateVal2.getMonth()).toString().padStart(2, "0");
      var hour2 = dateVal2.getHours().toString().padStart(2, "0");
      var minute2 = dateVal2.getMinutes().toString().padStart(2, "0");
      var sec2 = dateVal2.getSeconds().toString().padStart(2, "0");
      var ms2 = dateVal2.getMilliseconds().toString().padStart(3, "0");
      var inputDate2 = dateVal2.getFullYear() + "-" + (month2) + "-" + (day2) + "T" + (hour2) + ":" + (minute2) + ":" + (sec2) + "." + (ms2);

      $('#id').val(data[0]);
      $('#title').val(data[1]);
      $('#type').val(data[2]);
      $('#start').val(inputDate);
      $('#end').val(inputDate2);

   });
});
 window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {

      title:{
      text: "ACTIVITY LOG PER DAY"
      },
       data: [
      {
        type: "<?php echo $gensetchart ?>",

        dataPoints: [
			<?php 
			$user = $_SESSION['User'];
			$sql2 = "SELECT DAY(Timestamp),COUNT(*) FROM `events` WHERE Name='$user' GROUP BY DAY(Timestamp) ";
			$result2 =$db->query($sql2);
            while ($row = mysqli_fetch_array($result2)) {?>
        	{ x: <?php echo $row['DAY(Timestamp)'] ?>, y: <?php echo $row['COUNT(*)'] ?>},
			<?php } ?>
        ]
      }
      ]
    });

    chart.render();
  }
</script>
  </body>
</html>