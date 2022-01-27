<?php
include "config.php";
include ("assets/php/php_epm_genset.php");

require 'assets/mailer/Exception.php';
require 'assets/mailer/PHPMailer.php';
require 'assets/mailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();


if(!isset($_GET['email'])){
	header('Location: index.php');
	exit();
}
else{
	$email = $_GET['email'];
	$sql = "SELECT * FROM users WHERE Email='$email'";
	$result =$db->query($sql);
	$fetch = mysqli_fetch_assoc($result);
	if(!$result){
		$_SESSION['status'] = "error";
		$_SESSION['message'] = "SESSION EXPIRED";
		header('Location: /epm_login.php');
		exit();
	}
	else{
		
		$cstts = $fetch['Code_Status'];
		$otp = $fetch['Code'];
		$time = $fetch['Timer'];
		if(isset($_POST['submit'])) {
			if($cstts =="Invalid"){
				$_SESSION['status'] = "error";
				$_SESSION['message'] = "YOU'VE ENTERED AN EXPIRED OTP. CLICK RESEND TO GENERATE ANOTHER OTP";
				header("Location: /epm_otp.php?email=$email");
				exit();
			}
			elseif($otp != $_POST['otp']){
				$_SESSION['status'] = "error";
				$_SESSION['message'] = "OTP DO NOT MATCH";
				header("Location: /epm_otp.php?email=$email");
				exit();
			}
			else{
				$sql2 = "UPDATE `users` SET Code='0', Account_Status='Verified' WHERE Email='$email'";
				$result2 = $db-> query($sql2);
				if($result2){
					$_SESSION['status'] = "success";
					$_SESSION['message'] = "Account Successfuly Activated";
					header("Location: /epm_login.php");
					exit();
				}
				else{
					$_SESSION['status'] = "error";
					$_SESSION['message'] = "ERROR PASRSING REQUEST. PLEASE RELOAD THE PAGE";
					header("Location: /epm_otp.php?email=$email");
					exit();
				}
			}
			
		}
	if(isset($_POST['resend'])) {
		$sql = "SELECT * FROM users WHERE Email='$email'";
		$result = $db-> query($sql);
		if ($result-> num_rows >0) {
    		$row = mysqli_fetch_assoc($result);
			$code = rand(999999, 111111);
      		$status = "Unverified";
			$name = $row['Name'];
			$surname = $row['Surname'];
			$code_status = "Valid";
			$timer = 120;
		
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
			$mail->setFrom("mh.tokio@gmail.com","E-Plan Mo");
			$newname = $name. " " .$surname;
			$mail->addAddress("$email", $name);
		
			$email_template = 'epm_mail_template.html';
			$message = file_get_contents($email_template);
			$message = str_replace('%user%', $newname, $message);
			$message = str_replace('%code%', $code, $message);
		
			$mail->msgHTML($message);
		
			if($mail->send()){
				$sql = "UPDATE users SET Code='$code', Code_Status='$code_status', Timer='$timer' WHERE email='$email'";
				$result = $db-> query($sql);
				if($result){
					$script = "<script> $(document).ready(function(){ $('#modalResendSuccess').modal('show'); }); </script>";
				}
				else{
					$script = "<script> $(document).ready(function(){ $('#modalRegSuccess').modal('show'); }); </script>";
				}
			}else{
				$script = "<script> $(document).ready(function(){ $('#modalRegSuccess').modal('show'); }); </script>";
			}
		}
	}
	if(isset($_POST['back'])){
		unset($_SESSION['email']);
		header('Location: /epm_login.php');
		exit();
	}
	}
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>OTP</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
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
<?php echo '<body style="background-image:url(data:image/jpeg;base64,'.base64_encode($gensetbackground).');background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">' ?>
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
                <a class="nav-link" href="#hero" style="color:white">HOME</a>
                <a class="nav-link" href="#featured-services" style="color:white">SERVICES</a>
                <a class="nav-link" href="#about" style="color:white">ABOUT</a>
                <a class="nav-link" href="#contact" style="color:white">CONTACT</a>
                <a href="epm_login.php"><button class="btn btn-light my-2 my-sm-0">SIGN IN</button></a>
            </div>
        </nav>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            
        </div>
        <div class="col-xl-8 col-md-2 mb-4" style="margin-top: 5%">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div>
                        <center><img src="assets/images/Communication-email-green-icon.png" style="width: 30%; height: 30%;"></center>
                    </div>
                    <form method="POST" action="">
                    <div class="login-content" style="padding-top: 5%;">
                        
                            <center>
                                <h2 class="title">EMAIL VERIFICATION</h2>
                            </center>
                        <center>
                            <span id="timer"><?php echo $time?> seconds remaining before otp expiration.</span>
                            </center>
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
                    <div class="row">
        <?php if(isset($script)){ echo $script; } ?>
        <?php unset($script); ?>
    </div>
                    <div class="row form-group">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="container">
                                <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
  </div>
  <input type="text" class="form-control" placeholder="Enter OTP" aria-label="Username" aria-describedby="basic-addon1" name="otp">
</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="epm_login.php"><button type="button" class="btn" style="width: 100%; background-color:maroon; color: white;"><i class="fas fa-hand-point-left"></i> BACK</button></a>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn" style="width: 100%; background-color:maroon; color: white;" name="resend"><i class="fas fa-envelope"></i> RESEND EMAIL</button>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-secondary fa-pull-right" name="submit" type="submit" style="width: 100%; background-color:maroon; color: white;"><i class="fas fa-check"></i> SUBMIT</button>
                        </div>
                    </div>
                        </form>
                </div>
            </div>
        </div>
        <div class="col-md-2">

        </div>
    </div>
</div>




<div id="modalResendSuccess" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="assets/images/congrats.png" style="width: 10%;height: 10%">
                <h2 class="modal-title">Email Sent</h2>
                <button type="button" class="close" data-dismiss="modal" onclick="window.location.href='/epm_otp.php?email=<?php echo $email?>'">&times;</button>
            </div>
            <div class="modal-body">
                <p>Email has been successfuly resent. If you still can't find the email, try checking your spam folder.</p>
            </div>
        </div>
    </div>
</div>

<div id="modalResendError" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="assets/images/error.png" style="width: 10%;height: 10%">
                <h2 class="modal-title">Email failed to resend !</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
        </div>
    </div>
</div>
<script>
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
    $("document").ready(function() {
        setTimeout(function() {
            $("div.alert").remove();
        }, <?php echo $gensetmodclose ?>);

    });
    var timeleft = <?php echo $time?> - 1;
    var downloadTimer = setInterval(function() {
        if (timeleft <= 0) {
            clearInterval(downloadTimer);
            document.getElementById("timer").innerHTML = "";
        } else {
            document.getElementById("timer").innerHTML = timeleft + " seconds remaining before otp expiration.";
        }
        timeleft -= 1;
    }, 1000);
</script>

<body>
</body>

</html>