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
			header("Location: https://eplanmo.herokuapp.com/epm_otp.php?email=$email");
         	exit();
		 }
		 else{
			$_SESSION['User'] = $row['Username'];
         	$_SESSION['status'] = "success";
         	$_SESSION['message'] = "Login Sucessful";
         	header("Location: https://eplanmo.herokuapp.com/epm_admin.php");
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
			
			//==========================  INSTANTIATE MAILER
		$mail = new PHPMailer(true);
		$mail->isHTML(true);
		$mail->isSMTP();
		$mail->CharSet = "utf-8";
		
		//==========================  GOOGLE ACCOUNT CREDENTIALS
		$mail->Host = 'smtp.mail.yahoo.com';
		$mail->SMTPAuth = "true";
		$mail->Username = "kirigayakazuto03@rocketmail.com";
		$mail->Password = "mzjggsaolizjxfdu";
		$mail->SMTPSecure = "ssl";
		$mail->Port = "465";
		
		//==========================  EMAIL INFORMATIONS
		$mail->setFrom("kirigayakazuto03@rocketmail.com","Gino Toralba/EPM DEV");
			$mail->addAddress("$email", $name);
		
			$email_template = 'epm_mail_template2.html';
			$message = file_get_contents($email_template);
			$message = str_replace('%user%', $username, $message);
			$message = str_replace('%code%', $code, $message);
			$message = str_replace('%email%', $email, $message);
		
			$mail->msgHTML($message);
			
			if($mail->send()){
				$sql2 = "UPDATE users SET Code='$code', Code_Status='Valid', Timer='600' WHERE Username='$username'";
				$result2 = mysqli_query($db,$sql2);
  				$script = "<script> $(document).ready(function(){ $('#modalSuccess').modal('show'); }); </script>";
            }
			else{
                $script = "<script> $(document).ready(function(){ $('#modalEmailError').modal('show'); }); </script>";
            }
		}
		else{
			$script = "<script> $(document).ready(function(){ $('#modalUserError ').modal('show'); }); </script>";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>LOGIN</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animation.css">
    <!--===============================================================================================-->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1739375817606067" crossorigin="anonymous"></script>
    <link href="assets/css/index.css" rel="stylesheet">
</head>
<style>
   
</style>
<?php echo '<body class="page-top" style="background-image:url(data:image/jpeg;base64,'.base64_encode($gensetbackground).');background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">' ?>
<header id="header" class="d-flex align-items-center" style="background-color:maroon">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <span>
                <h1 class="logo" style="color:white;">EPLAN MO</h1>
            </span>
            <button class="navbar-toggler btn btn-light" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation" style="color: maroon !important">
                <span class="navbar-toggler-icon" style="color: white;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                </ul>
                <a class="nav-link" href="https://eplanmo.herokuapp.com/index.php#hero" style="color:white">HOME</a>
                <a class="nav-link" href="https://eplanmo.herokuapp.com/index.php#featured-services" style="color:white">SERVICES</a>
                <a class="nav-link" href="https://eplanmo.herokuapp.com/index.php#about" style="color:white">ABOUT</a>
                <a class="nav-link" href="https://eplanmo.herokuapp.com/index.php#contact" style="color:white">CONTACT</a>
                <a href="https://eplanmo.herokuapp.com/epm_login.php"><button class="btn btn-light my-2 my-sm-0">SIGN IN</button></a>
            </div>
        </nav>
    </div>
</header>
<div class="wrapper d-flex">
    <div class="container-fluid" style="margin-top: 2%;">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-xl-4 col-md-8 mb-4">
                <div class="card">
                    <div class="card-header" style="background: #7A313E; height: 120px; color: #fff;">
                        <center><i class="fas fa-angle-down" style="margin-top:80px; font-size: 40px; background: #7A313E; height: 50px; width: 50px;border-radius: 60px; padding-top:10px"></i></center>
                    </div>
                    <form action="" method="POST">
                        <div class="card-body">

                            <h2 class="title" style="color: #7A313E; text-align: center; padding: 20px 0 30px 0">SIGN IN</h2>
                            <div class="form-group">
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
                                <input type="text" class="form-control" name="username" required="" placeholder="Username" maxlength="20">
                            </div>

                            <div class="form-group">
                                <input type="password" id="password" class="form-control" name="password" placeholder="Password" required="" maxlength="20">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="checkbox" onClick="myFunction();"> Show Password
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="padding: 20px;">
                                    <a href="" data-toggle="modal" data-target="#modalforgotpass">Forgot Password</a>
                                    <span style="float: right"><a href="epm_register.php">Create an account?</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12" style="padding: 20px 80px 0 80px">
                                <button type="submit" name="login" class="btn btn-block" style="background: #7A313E; border-radius: 30px"><i class="fas fa-sign-in-alt mr-2" style="color: #fff"></i><label style="color: #fff;">Sign In</label></button>
                                <?php if(isset($script)){ echo $script; } ?>
                                <?php unset($script); ?>
                                <br>
                                <br>
                            </div>
                            <div class="col-lg 6">

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
                        <div class="form-group">
                            <h5>Username</h5>
                            <input type="text" class="form-control" name="username2" required="" maxlength="20">
                        </div>
                        <div class="form-group">
                            <h5>Email Address</h5>
                            <input type="email" class="form-control" name="email2" required="" maxlength="50">
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
    $("document").ready(function() {
        setTimeout(function() {
            $("div.alert").remove();
        }, <?php echo $gensetmodclose ?>);

    });

    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    const inputs = document.querySelectorAll(".input");

    function addcl() {
        let parent = this.parentNode.parentNode;
        parent.classList.add("focus");
    }

    function remcl() {
        let parent = this.parentNode.parentNode;
        if (this.value == "") {
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