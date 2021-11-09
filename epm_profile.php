<?php
include 'assets/php/php_epm_profile.php';
include 'assets/php/php_epm_genset.php';
?>
<!doctype html>
<html lang="en">
  <head>
   <title>EPM PROFILE</title>
    <meta charset="utf-8">
	<link rel="stylesheet" href="assets/css/animation.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--===============================================================================================-->
   <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<!--===============================================================================================-->     
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!--===============================================================================================-->  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!--===============================================================================================-->  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<!--===============================================================================================-->  
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!--===============================================================================================-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
<!--===============================================================================================-->
   <link rel="stylesheet" href="assets/css/dashboard_main.css">
  </head>
	<style>
		.text{
			font-size: 20px;
		}
	</style>
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
	  
<div class="container" style="margin-top:20px;">
	<div class="row">
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
    <div class="row">
		<div class="col-xl-12 col-md-12 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="row">
  					<div class="col-3">
    					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      						<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Personal Information</a>
      						<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
      						<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
      						<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
    					</div>
  					</div>
  					<div class="col-9">
    					<div class="tab-content" id="v-pills-tabContent">
      						<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
								<div class="row">
									<div class="col-8">
									<table class="table">
              						<tr>
                						<td class="text">Name</td>
                						<td class="text">:</td>
                						<td class="text"><?php echo $names?></td>
              						</tr>
              						<tr>
                						<td class="text">Middle Name</td>
                						<td class="text">:</td>
                						<td class="text"><?php echo $mname?></td>
              						</tr>
              						<tr>
                						<td class="text">Surname</td>
                						<td class="text">:</td>
                						<td class="text"><?php echo $sname?></td>
              						</tr>
             						<tr>
                						<td class="text">Birthday</td>
                						<td class="text">:</td>
                						<td class="text"><?php echo $birthday?></td>
              						</tr>
              						<tr>
                						<td class="text">Contact No.</td>
                						<td class="text">:</td>
                						<td class="text"><?php echo $contact?></td>
              						</tr>
              						<tr>
                						<td class="text">Email</td>
                						<td class="text">:</td>
                						<td class="text"><?php echo $email?></td>
              						</tr>
            						</table>
								</div>
								<div class="col-4">
									<center>
									<?php echo '<img style="height:50%; width:50%; border-radius:20%" alt="" loading="lazy" src="data:image/jpeg;base64,'.base64_encode($image).'"/>'; ?>
									<br>
									<br>
									<button class="button btn btn-primary" id="updateButton" data-toggle="modal" data-target="#modalUpdateImage" style="margin-bottom: 3px;">Update Image</button>
									<button class="button btn btn-primary" id="updateButton" data-toggle="modal" data-target="#modalUpdateInfo" style="margin-bottom: 3px;">Update Information</button>
									<button href="#" class="btn btn-primary" id="updateButton" data-toggle="modal" data-target="#modalUpdatePassword" style="margin-bottom: 3px;">Update Password</button>
									</center>
								</div>
								</div>
							</div>
      						<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"></div>
      						<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
      						<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
    					</div>
  					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	

<!--MODAL FOR UPDATE INFORMATION-->
<!--===============================================================================================-->
<div id="modalUpdateInfo" class="modal fade" role="dialog">
    <div class="modal-dialog" style="max-width: 60%;">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Information</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="assets/php/update_info.php" method="POST">
            <table class="table">
              <div class="form-group">
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td><input style="width: 100%;" type="text" name="name" required="" value="<?php echo $names ?>"></td>
                    <td>Middle Name</td>
                    <td>:</td>
                    <td><input style="width: 100%;" type="text" name="mname" required="" value="<?php echo $mname ?>"></td>
                  </tr>
                  <tr>
                    <td>Surname</td>
                    <td>:</td>
                    <td><input style="width: 100%;" type="text" name="sname" required="" value="<?php echo $sname ?>"></td>
                    <td>Birthday</td>
                    <td>:</td>
                    <td><input style="width: 100%;" type="date" name="bday" required="" value="<?php echo $birthday ?>"></td>
                  </tr>
                  <tr>
                    <td>Contact No.</td>
                    <td>:</td>
                    <td><input style="width: 100%;" type="number" name="cno" required="" value="<?php echo $contact ?>"></td>
                    <td>Email</td>
                    <td>:</td>
                    <td><input style="width: 100%;" type="email" name="email" required="" value="<?php echo $email ?>"></td>
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


<!--MODAL FOR UPDATE PASSWORD-->
<!--===============================================================================================-->
<div id="modalUpdatePassword" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Password</h4>
          <div>

          </div>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="assets/php/update_pass.php" method="POST">
            <div class="form-group">
              <label>Enter Old Password</label></td>
              <input type="text" class="form-control" name="opw" value="" border="1" style="border: 1px solid #000000 !important" required=""></td>
            </div>
            <div class="form-group">
              <label>Enter New Password</label>
              <input type="text" class="form-control" name="npw" value="" style="border: 1px solid #000000 !important" required="">
            </div>
            <div class="form-group">
              <label>Confirm New Password</label>
              <input type="text" class="form-control" name="cnpw" value="" style="border: 1px solid #000000 !important" required="">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit" style="margin-left: 80%;">Update</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


<!--MODAL FOR UPLOAD PICTURE-->
<!--===============================================================================================-->
<div id="modalUpdateImage" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Image</h4>
          <div>
            
          </div>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="assets/php/update_image.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label>Select Image File:</label>
              <input type="file" name="image">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" name="upload" type="submit" style="margin-left: 80%;">Update</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
<!--SCRIPTS-->  
   <script src="assets/js/dashboard_main.js"></script>
     <script>
    $("document").ready(function(){
    setTimeout(function(){
       $("div.alert").remove();
    }, <?php echo $gensetmodclose?> );
});
  </script>
<!--===============================================================================================-->
  </body>
</html>