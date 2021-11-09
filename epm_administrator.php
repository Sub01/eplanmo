<?php
session_start();
include ("config.php");
include ("assets/php/php_epm_genset.php");
?>
<!doctype html>
<html>
<head>

	<title>ADMINISTRATOR</title>
	
<!--==================================================================================================================================-->	
	
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
<!--==================================================================================================================================-->
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link rel="stylesheet" href="assets/css/dashboard_main.css">
	<link rel="stylesheet" href="assets/css/animation.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
	
<!--==================================================================================================================================-->	
	
</head>
<?php echo '<body style="background-image:url(data:image/jpeg;base64,'.base64_encode($gensetbackground).');background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">' ?>
	
<!--==================================================================================================================================-->	
	
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  	<div class="container-fluid">
    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    	<a class="navbar-brand mt-2 mt-lg-0" href="#">
        	<h2 style="font-family: Courier">EPM</h2>
      	</a>
     	<ul class="navbar-nav me-auto mb-2 mb-lg-0">
        	<li class="nav-item">
         		<a class="nav-link" href="#">DASHBOARD</a>
        	</li>
      	</ul>
    </div>
    <div class="dropdown d-flex align-items-center">
      <a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      	<img src="https://mdbootstrap.com/img/new/avatars/2.jpg" class="rounded-circle" height="25" alt="" loading="lazy"/>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Admin Settings</a>
    <a class="dropdown-item" href="assets/php/session_logout.php" onclick="return confirm('Are you sure you want to Log Out?')">Log Out</a>
  </div>
    </div>
  </div>
</nav>
	
<!--==================================================================================================================================-->	
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<br>
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
		<div class="col-xl-8 col-md-8 mb-4">
        	<div class="card border-left-primary shadow h-100 py-2">
            	<div class="card-body">
					<div class="legend">
						<legend>List of Users</legend>
					</div>
					<table class="table" id="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Username</th>
							<th>Last Name</th>
							<th>Middle Name</th>
							<th>First Name</th>
							<th>Birthday</th>
							<th>Contact #</th>
							<th>Email</th>
							<th>Status</th>
							<th>Functions</th>
						</tr>
					</thead>
					<tbody>
					<?php
                        $sql = "SELECT * FROM users";
                        $result =$db->query($sql);
                        while ($row = mysqli_fetch_array($result)) {?>
						<tr>
							<td><?php echo $row['ID'] ?></td>
							<td><?php echo $row['Username'] ?></td>
							<td><?php echo $row['Surname'] ?></td>
							<td><?php echo $row['Middle_Name'] ?></td>
							<td><?php echo $row['Name'] ?></td>
							<td><?php echo $row['Birthday'] ?></td>
							<td><?php echo $row['Contact_No'] ?></td>
							<td><?php echo $row['Email'] ?></td>
							<td><?php echo $row['Status'] ?></td>
							<td>
							<!--<button type="button" class="btn btn-primary editbutton" data-toggle="modal" data-target="#updateUser"><i class="fas fa-edit"></i></button>-->
                              <a name="delete" href="assets/php/admin_user_delete.php?id=<?php echo $row['ID']?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to Delete this User? This cannot be undone.')"><i class="fas fa-archive"></i></a>
							</td>
						</tr>
					 <?php  } ?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-md-4 mb-4">
        	<div class="card border-left-primary shadow h-100 py-2">
            	<div class="card-body">
					<div class="legend">
						<legend>GENERAL SETTINGS</legend>
					</div>
					<div class="settings">
						<form action="assets/php/admin_genset_update.php" method="POST" enctype="multipart/form-data">
						<table class="table">
							<tr>
								<td width="200"> <h6>Alert Auto Close</h6> </td>
								<td> : </td>
								<td> <select name="modclose" style="width:100%">
										<option disabled>(*) <?php echo $gensetmodclose ?> Milisec</option>
										<option value="2000">2 Seconds</option>
										<option value="3000">3 Seconds</option>
										<option value="4000">4 Seconds</option>
										<option value="5000">5 Seconds</option>
									</select>
								</td>
							</tr>
							<tr>
								<td width="200"> <h6>Chart Type</h6> </td>
								<td> : </td>
								<td> <select name="chart" style="width:100%">
										<option disabled>(*) <?php echo $gensetchart ?></option>
										<option value="area">Area</option>
										<option value="column">Column</option>
										<option value="line">Line</option>
										<option value="scatter">Scatter</option>
										<option value="spline">Spline</option>
									</select>
								</td>
							</tr>
							<tr>
								<td width="200"><h6>System Background</h6></td>
								<td>:</td>
								<td><input type="file" name="image" style="width: 90%"></td>
							</tr>
						</table>
						<table class="table">
							<tr>
								<td> <button type="submit" class="btn btn-success" style="width: 100%">SAVE SETTINGS</button></td>
								<td> <button class="btn btn-success" style="width: 100%">RESTORE DEFAULT</button></td>
							</tr>
						</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
<!--==================================================================================================================================-->	
	
<div class="modal fade" id="updateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 60%;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update User Information</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="assets/php/update_info.php" method="POST">
            <table class="table">
              <div class="form-group">
				<input type="hidden" name="id" id="id" value="">
                <tr>
					<td>Name</td>
                    <td>:</td>
                    <td><input style="width: 100%;" type="text" id="name" name="name" required="" value=""></td>
                    <td>Middle Name</td>
                    <td>:</td>
                    <td><input style="width: 100%;" type="text" id="mname" name="mname" required="" value=""></td>
                  </tr>
                  <tr>
                    <td>Surname</td>
                    <td>:</td>
                    <td><input style="width: 100%;" type="text" id="sname" name="sname" required="" value=""></td>
                    <td>Birthday</td>
                    <td>:</td>
                    <td><input style="width: 100%;" type="date" id="bday" name="bday" required="" value=""></td>
                  </tr>
                  <tr>
                    <td>Contact No.</td>
                    <td>:</td>
                    <td><input style="width: 100%;" type="number" id="cno" name="cno" required="" value=""></td>
                    <td>Email</td>
                    <td>:</td>
                    <td><input style="width: 100%;" type="email" id="email" name="email" required="" value=""></td>
                  </tr>
              </div>
              </table>
            <div class="form-group">
              <button class="btn btn-primary" type="submit" style="margin-left: 80%;">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
	
<!--==================================================================================================================================-->	
	
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	
<!--==================================================================================================================================-->	
	
<script>
$(document).ready(function(){
   $('.editbutton').on('click', function(){
      $('#updateUser').modal('show');
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function(){
         return $(this).text();
      }).get();

      console.log(data);
	   
	  $('#id').val(data[0]);
      $('#name').val(data[4]);
      $('#mname').val(data[3]);
      $('#sname').val(data[2]);
      $('#bday').val(data[5]);
	  $('#cno').val(data[6]);
	  $('#email').val(data[7]);
   });
});
	
$("document").ready(function(){
    setTimeout(function(){
       $("div.alert").remove();
    }, <?php echo $gensetmodclose ?> ); 

});

$(document).ready( function () {
    $('#table').DataTable({
      "autoWidth": true
    });
} );
	
</script>
</body>
</html>