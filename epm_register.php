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

if($_SERVER["REQUEST_METHOD"] == "POST") {

$name = $_POST['name'];
$middle = $_POST['mname'];
$surname = $_POST['sname'];
$bday = $_POST['bday'];
$email = $_POST['email'];
$contact = $_POST['cno'];
$uname = $_POST['uname'];
$pword1 = $_POST['pword1'];
$pword2 = $_POST['pword2'];
$img_name = $_FILES['image']['name'];

$sql1 = "SELECT Username FROM users Where Username = '$uname' OR Email = '$email' LIMIT 1";
$result = mysqli_query($db,$sql1);
$fetch = mysqli_fetch_assoc($result);
if($fetch){
   $_SESSION['status'] = "error";
   $_SESSION['message'] = "Username / Email Already Exist";
}
else
{
   	if($img_name!=''){
	  	$ext = pathinfo($img_name, PATHINFO_EXTENSION);
      	$allowed = ['png', 'gif', 'jpg', 'jpeg'];
      	$img_data = addslashes(file_get_contents($_FILES['image']['tmp_name']));
	  	$code = rand(999999, 111111);
      	$account_status = "Unverified";
		$code_status = "Valid";
		$timer = 120;
	  	$_SESSION['email'] = $email;
		
	  	
		//==========================  INSTANTIATE MAILER
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
		$newname = $name. " " .$surname;
		$mail->addAddress("$email", $name);
		
		$email_template = 'epm_mail_template.html';
		$message = file_get_contents($email_template);
		$message = str_replace('%user%', $newname, $message);
		$message = str_replace('%code%', $code, $message);
		
		$mail->msgHTML($message);
		
	   	if($mail->send()){
			$sql2 = "INSERT INTO `users`(`Images`,`Username`,`Password`,`Name`,`Middle_Name`,`Surname`,`Birthday`,`Contact_No`,`Email`,`Code`,`Code_Status`, `Timer`, `Account_Status`) VALUES('$img_data','$uname','$pword1','$name','$middle','$surname','$bday','$contact','$email','$code','$code_status','$timer','$account_status')";
		   	$result2 = mysqli_query($db, $sql2);
		   	$script = "<script> $(document).ready(function(){ $('#modalRegSuccess').modal('show'); }); </script>";
       	}else{
            $_SESSION['status'] = "error";
   			$_SESSION['message'] = $mail->ErrorInfo;;
       	}
	}
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>EPM Registration</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

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
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/animation.css">
<!--===============================================================================================-->

</head>
	<style>
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
 		-webkit-appearance: none;
  		margin: 0;
	}
	input[type="date"]:in-range::-webkit-datetime-edit-year-field, input[type="date"]:in-range::-webkit-datetime-edit-month-field, input[type="date"]:in-range::-webkit-datetime-edit-day-field, input[type="date"]:in-range::-webkit-datetime-edit-text { 	color: black; 
	}
	</style>
<?php echo '<body style="overflow-y:auto; background-image:url(data:image/jpeg;base64,'.base64_encode($gensetbackground).');background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">' ?>
	
<div class="container-fluid" style="margin-top: 5%;">
	<div class="row">
		<div class="col-md-2">
			
		</div>
		<div class="col-md-8" style="background-color: transparent;">
        	<div class="row">
				<div class="col-xl-12 col-md-12 mb-4">
					<div class="card border-left-primary shadow h-100 py-2" style="border:2px dashed black">
						<div class="card-header">
							<form action="" method="POST" enctype="multipart/form-data">
							<center><h2>REGISTRATION</h2></center>
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
                    	<div class="card-body">
							<div class="row">
								<div class="col-xl-6 col-md-6 mb-4">
									<legend>Personal Information</legend>
									<div class="form-group">
										<h5>Name</h5>
										<input class="form-control" type="text" name="name" required="" maxlength="25" style="width: 100%">
									</div>
									<div class="form-group">
										<h5>Middle Name</h5>
										<input class="form-control" type="text" name="mname" required="" maxlength="25">
									</div>
									<div class="form-group">
										<h5>Surname</h5>
										<input class="form-control" type="text" name="sname" required="" maxlength="25" style="width: 100%">
									</div>
									<div class="form-group">
										<h5>Birthday</h5>
										<input class="form-control" type="date" name="bday" required="" maxlength="25" style="width: 100%">
									</div>
									<div class="form-group">
										<h5>Contact Number</h5>
										<input class="form-control" type="number" name="cno" required="" onKeyPress="if(this.value.length==14) return false;" style="width: 100%">
									</div>
									<div class="form-group">
										<h5>Email</h5>
										<input class="form-control" type="email" name="email" required="" maxlength="50" style="width: 100%">
									</div>
									<div class="form-group">
										
									</div>
								</div>
								<div class="col-xl-6 col-md-6 mb-4">
									<legend>Account Information</legend>
									<div class="form-group">
										<h5>Username</h5>
										<input type="text" class="form-control" name="uname" required="" maxlength="20" style="width: 100%">
									</div>
									<div class="form-group">
										<h5>Password</h5>
										<input class="form-control" id="pword1" type="password" name="pword1" required="" maxlength="20" style="width: 90%"><br>
										<input type="checkbox" class="fa-pull-left" style="margin-top: 4px; margin-right: 4px;" onClick="showPassword1();"><p style="text-align: left">Show Password</p>
									</div>
									<div class="form-group">
										<h5>Repeat Password</h5>
										<input class="form-control" id="pword2" type="password" name="pword2" required="" maxlength="20" style="width: 90%"><br>
										<input type="checkbox" class="fa-pull-left" style="margin-top: 4px; margin-right: 4px;" onClick="showPassword2();"><p style="text-align: left">Show Password</p>
										<center><label id="message"></label></center>
									</div>
									<div class="form-group">
										<h5>Select Profile Picture (Required)</h5>
										<input type="file" name="image" required="" style="width: 90%">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-12 col-md-6 mb-4">
									<button type="button" onclick="window.location.href='index.php'" class="btn btn-primary" style="width: 20%; float: left">BACK</button>
									<button type="submit" class="btn btn-primary" id="submit" style="width: 30%; float: right"></i>Register</a>
								</div>
							</div>
							<div class="row">
								<?php if(isset($script)){ echo $script; } ?>
								<?php unset($script); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
					
								
							 
							</form>
						</div>
						</div>
						</div>
					</div>
        		</div>
			</div>           
		</div>
	</div>
</div>
<div id="modalRegSuccess" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
			<img src="assets/images/congrats.png" style="width: 10%;height: 10%">
          	<h2 class="modal-title">Congratulations</h2>
          <button type="button" class="close" data-dismiss="modal" onclick="window.location.href='epm_otp.php?email=<?php echo $email?>'">&times;</button>
        </div>
        <div class="modal-body">
          <p>Congratulations on successfuly creating your account. Please check your email for the One Time Pin Code.</p>
        </div>
      </div>
    </div>
  </div>
<div id="modalEmailError" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
			<img src="assets/images/error.png" style="width: 10%;height: 10%">
          	<h2 class="modal-title">Email failed to send !</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p></p>
        </div>
      </div>
    </div>
  </div>
<script>
	$('#pword1, #pword2').on('keyup', function () {
  		if ($('#pword1').val() == $('#pword2').val()) {
    		$('#message').html('').css('color', 'green');
			document.getElementById('submit').disabled = false;
			
  		}
		else{
			$('#message').html('Password Do Not Match').css('color', 'red');
			document.getElementById('submit').disabled = true;
		} 	
	});
	function showPassword1() {
		  var x = document.getElementById("pword1");
		  if (x.type === "password") {
			  x.type = "text";
		  } 
		  else {
    		x.type = "password";
  			}
	  }
	function showPassword2() {
		  var x = document.getElementById("pword2");
		  if (x.type === "password") {
			  x.type = "text";
		  } 
		  else {
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
$("document").ready(function(){
    setTimeout(function(){
       $("div.alert").remove();
    }, <?php echo $gensetmodclose ?> ); 

});
</script>
</body>
</html>