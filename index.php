<?php
	include "config.php";
	include ("assets/php/php_epm_genset.php");
   	session_start();
 
if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password']; 
	
    $sql = "SELECT * FROM `users` WHERE Username = '$username' and Password = '$password'";
	
    $result = $db-> query($sql);
	
    if ($result-> num_rows >0) {
    	$row = $result-> fetch_assoc();
		$email = $row['Email'];
		if($row['Account_Status'] == 'Unverified'){
			$_SESSION['email'] = $row['Email'];
			$_SESSION['status'] = "error";
         	$_SESSION['message'] = "It appears that your account is not verified yet, please check your email and enter the OTP below to activate your account!";  
			header("Location: epm_otp.php?email=$email");
         	exit();
		 }
		 else{
			$_SESSION['User'] = $row['Username'];
         	$_SESSION['status'] = "success";
         	$_SESSION['message'] = "Login Sucessful";
         	header("Location: epm_admin.php");
         	exit(); 
		  }
      }
      else{
      		$_SESSION['status'] = "error";
         	$_SESSION['message'] = "Your Login Name or Password is invalid";
      }
   }
if(isset($_POST['forgot'])){
	$username = $_POST['username2'];
	$email = $_POST['email2'];
	$sql1 = "SELECT * FROM `users` WHERE `Username`='$username' AND `Email`='$email'";
	$result = $db-> query($sql1);
	if($result-> num_rows>0){
		$row = $result-> fetch_assoc();
		$code = rand(999999, 111111);
		$sql2 = "UPDATE users SET Code='$code' WHERE Username='$username'";
		$result2 = mysqli_query($db,$sql2);
		if($result2){
			$subject = "Request for Reset Password";  
	   		$message = '<html><body>';
	   		$message .= '<h3 style="font-family: Verdana;"> HELLO ' .strip_tags($_POST['username2']). ' !</h3>';
		    $message .= '<h5>We have successfuly tracked your account and your request in now available.';
		    $message .= '<h5>Please click the link below to proceed in reset password page.<br>';
		    $message .= "<a href='https://eplanmo.herokuapp.com/epm_resetpass.php?Code=$code&User=$username&Email=$email'>https://localhost/EPM/epm_resetpass.php?Code=$code&User=$username&Email=$email</a>";
		    $headers = "From: eplanmo@noreply.com\r\n";
		    $headers .= "MIME-Version: 1.0\r\n";
		    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			if(mail($email, $subject, $message, $headers)){
  				$script = "<script> $(document).ready(function(){ $('#modalSuccess').modal('show'); }); </script>";
            }
			else{
                $script = "<script> $(document).ready(function(){ $('#modalEmailError').modal('show'); }); </script>";
            }
		}
		else{
			$script = "<script> $(document).ready(function(){ $('#modalEmailError').modal('show'); }); </script>";
		}
	}
	else{
		$script = "<script> $(document).ready(function(){ $('#modalUserError').modal('show'); }); </script>";
		
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>EPM LOGIN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="assets/css/animation.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	
</head>
<?php echo '<body style="background-image:url(data:image/jpeg;base64,'.base64_encode($gensetbackground).');background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">' ?>
<div class="container-fluid" style="margin-top: 10%;">
	<div class="row">
		<div class="col-md-3">
				
		</div>
		<div class="col-xl-6 col-md-8 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 50px;">
				<div class="card-header">
					<center>
					<img src="assets/images/logo_calendar.png" style="height: 100px; width: 100px;">
					<h2 class="title">WELCOME</h2>
					</center>
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
					<?php unset($_SESSION['email']); ?>
				</div>
            	<div class="card-body">
				    <form action="" method="POST">
						<div class="form-group">
							<h5>USERNAME</h5>
							</span><input type="text" class="form-control" name="username" required=""  maxlength="20">
						</div>

				      	<div class="form-group">
							<h5>Password</h5>
							<input type="password" id="password" class="form-control" name="password" required="" maxlength="20">
						</div>
						<div class="row">
							<div class="col-md-6">
								<input type="checkbox" class="fa-pull-left" style="margin-top: 4px; margin-right: 4px;" onClick="myFunction();"><p style="text-align: left">Show Password</p>
							</div>
							<div class="col-md-6">
								<a href="" data-toggle="modal" data-target="#modalforgotpass">Forgot Password</a>
							</div>
						</div>
						<div class="row">
				            <div class="col-lg-6">
				                <button type="submit" name="login" class="btn btn-primary btn-block my-2"><i class="fas fa-sign-in-alt mr-2"></i>Login</button>
								<?php if(isset($script)){ echo $script; } ?>
								<?php unset($script); ?>
				            </div>
							<div class="col-lg 6">
								<button type="button" onclick="window.location.href='epm_register.php'" class="button btn btn-primary btn-block my-2"><i class="fas fa-pencil-alt mr-2"></i>Register</button>
							</div>
				        </div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
		</div>
	</div>
</div>
							
						
						
				 


<!--MODAL FOR FORGOT PASSWORD-->
<!--===============================================================================================-->
<div id="modalforgotpass" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Forgot Password</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
			<div class="login-content" style="padding-top: 5%;">
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>Username</h5>
						<input type="text" class="input" name="username2" required=""  maxlength="20">
					</div>
				</div>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>Email Address</h5>
						<input type="email" class="input" name="email2" required=""  maxlength="50">
					</div>
				</div>
			</div>
              <button class="btn btn-primary" name="forgot" type="submit">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>

	<div id="modalSuccess" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
			<img src="assets/images/congrats.png" style="width: 10%;height: 10%">
          	<h2 class="modal-title">Email Successfuly Sent</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>Please check your email inbox for the reset password link.</p>
        </div>
      </div>
    </div>
  </div>

	<div id="modalEmailError" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
			<img src="assets/images/error.png" style="width: 10%;height: 10%">
          	<h2 class="modal-title">Email has failed to send !</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>It looks like there's and error parsing your request. Try reloading the page and check if it solved the issue.</p>
        </div>
      </div>
    </div>
  </div>
	
	<div id="modalUserError" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
			<img src="assets/images/error.png" style="width: 10%;height: 10%">
          	<h2 class="modal-title">User/Email not found!</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>The user or email does not exist or username and email does not match the database.</p>
        </div>
      </div>
    </div>
  </div>

	
	
  <script>
$("document").ready(function(){
    setTimeout(function(){
       $("div.alert").remove();
    }, <?php echo $gensetmodclose ?>);

});
function myFunction() {
	var x = document.getElementById("password");
	if(x.type === "password") {
		x.type = "text";
	} 
	else{
    	x.type = "password";
  	}
}	  
const inputs = document.querySelectorAll(".input");
function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}
function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}
inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});


  </script>
<!--===============================================================================================-->
</body>
</html>