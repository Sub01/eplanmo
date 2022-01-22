<?php
include "config.php";
include 'assets/php/php_epm_genset.php';
require 'assets/mailer/Exception.php';
require 'assets/mailer/PHPMailer.php';
require 'assets/mailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
elseif(isset($_POST['forgot'])){
	$username = $_POST['username2'];
	$email = $_POST['email2'];
	$sql1 = "SELECT * FROM `users` WHERE `Username`='$username' AND `Email`='$email'";
	$result = $db-> query($sql1);
	if($result-> num_rows>0){
		$row = $result-> fetch_assoc();
		$code = rand(999999, 111111);
			
			$mail = new PHPMailer(true);
			$mail->isHTML(true);
			$mail->isSMTP();
			$mail->CharSet = "utf-8";
			//==========================  GOOGLE ACCOUNT CREDENTIALS
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = "true";
			$mail->Username = "mh.tokio@gmail.com";
			$mail->Password = "cwovxtcdrzoxjmmp";
			$mail->SMTPSecure = "ssl";
			$mail->Port = "465";
		
			//==========================  EMAIL INFORMATIONS
			$mail->setFrom("mh.tokio@gmail.com","Gino Toralba/EPM DEV");
			$mail->addAddress("$email", $name);
		
			$email_template = 'epm_mail_template2.html';
			$message = file_get_contents($email_template);
			$message = str_replace('%username%', $username, $message);
			$message = str_replace('%code%', $code, $message);
			$message = str_replace('%email%', $email, $message);
		
			$mail->msgHTML($message);
			
			if($mail->send()){
				$sql2 = "UPDATE users SET Code='$code' WHERE Username='$username'";
				$result2 = mysqli_query($db,$sql2);
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
<style>
.navbar-light .navbar-nav .nav-link .navbar-brand{
    color: white;
} 
</style>
	<?php echo '<body class="page-top" style="background-image:url(data:image/jpeg;base64,'.base64_encode($gensetbackground).');background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">' ?>
    
<nav class="navbar navbar-expand-lg" style="background-color:maroon">
    <span class="navbar-brand" style="color:white">EPLAN MO</span>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto"> 
    </ul>
    <a class="nav-link" href="#" style="color:white">Tour</a>
    <a class="nav-link" href="#" style="color:white">Blog</a>
    <a class="nav-link" href="#" style="color:white">About</a>
    <a href="epm_login.php"><button class="btn btn-light my-2 my-sm-0">SIGN IN</button></a>
  </div>
</nav>
<div class="wrapper d-flex">
    <div class="container" style="margin-top: 2%;">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-1">
            
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10">
                <div class="row">
                    <h1 style="color: green;text-align:center;font-weight:bolder">Organize your classes, task and exams &amp; never forget a lecture or assignments again </h1>
                </div>
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-1">
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10">
                         <p style="color:gray; font-weight:bolder;font-size:15px; text-align:justify; text-aling-last:center;letter-spacing:5px;">It's time to say goodbye to your paper planner. EPLAN MO is everything your paper planner is and more. Schedules, grades, teachers, subjects ? EPLAN MO has it covered on all your devices. Oh, and did we mention it's free ?</p>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1">
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1">
            
            </div>
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
				<div class="form-group">
						<h5>Username</h5>
						<input type="text" class="form-control" name="username2" required=""  maxlength="20">
				</div>
				<div class="form-group">
						<h5>Email Address</h5>
						<input type="email" class="form-control" name="email2" required=""  maxlength="50">
				</div>
			</div>
              <button class="btn btn-primary" name="forgot" type="submit" style="width: 100%">CONFIRM</button>
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