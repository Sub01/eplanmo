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
    <title>EPLAN MO</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/animation.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.0.1/css/all.css">

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1739375817606067" crossorigin="anonymous"></script>
</head>
<style type="text/css">
    .navbar-light .navbar-nav .nav-link .navbar-brand {
        color: #7E9680;
    }

    @font-face {
        font-family: proxima-nova;
        src: url(https://use.typekit.com/af/06b3d8/00000000000000003b9aefb8/27/l?subset_id=2&fvd=n7&v=3) format("woff2"), url(https://use.typekit.com/af/06b3d8/00000000000000003b9aefb8/27/d?subset_id=2&fvd=n7&v=3) format("woff"), url(https://use.typekit.com/af/06b3d8/00000000000000003b9aefb8/27/a?subset_id=2&fvd=n7&v=3) format("opentype");
        font-weight: 700;
        font-style: normal;
        font-display: auto;
    }

    @font-face {
        font-family: proxima-nova;
        src: url(https://use.typekit.com/af/bf2380/00000000000000003b9aefe5/27/l?subset_id=2&fvd=n1&v=3) format("woff2"), url(https://use.typekit.com/af/bf2380/00000000000000003b9aefe5/27/d?subset_id=2&fvd=n1&v=3) format("woff"), url(https://use.typekit.com/af/bf2380/00000000000000003b9aefe5/27/a?subset_id=2&fvd=n1&v=3) format("opentype");
        font-weight: 100;
        font-style: normal;
        font-display: auto;
    }

    @font-face {
        font-family: proxima-nova;
        src: url(https://use.typekit.com/af/c7956e/00000000000000003b9aefc2/27/l?subset_id=2&fvd=n6&v=3) format("woff2"), url(https://use.typekit.com/af/c7956e/00000000000000003b9aefc2/27/d?subset_id=2&fvd=n6&v=3) format("woff"), url(https://use.typekit.com/af/c7956e/00000000000000003b9aefc2/27/a?subset_id=2&fvd=n6&v=3) format("opentype");
        font-weight: 600;
        font-style: normal;
        font-display: auto;
    }

    @font-face {
        font-family: proxima-nova;
        src: url(https://use.typekit.com/af/125f73/00000000000000003b9aefc0/27/l?subset_id=2&fvd=n4&v=3) format("woff2"), url(https://use.typekit.com/af/125f73/00000000000000003b9aefc0/27/d?subset_id=2&fvd=n4&v=3) format("woff"), url(https://use.typekit.com/af/125f73/00000000000000003b9aefc0/27/a?subset_id=2&fvd=n4&v=3) format("opentype");
        font-weight: 400;
        font-style: normal;
        font-display: auto;
    }

    @font-face {
        font-family: proxima-nova;
        src: url(https://use.typekit.com/af/23ba7c/00000000000000003b9aefc1/27/l?subset_id=2&fvd=i4&v=3) format("woff2"), url(https://use.typekit.com/af/23ba7c/00000000000000003b9aefc1/27/d?subset_id=2&fvd=i4&v=3) format("woff"), url(https://use.typekit.com/af/23ba7c/00000000000000003b9aefc1/27/a?subset_id=2&fvd=i4&v=3) format("opentype");
        font-weight: 400;
        font-style: italic;
        font-display: auto;
    }

    @font-face {
        font-family: proxima-nova;
        src: url(https://use.typekit.com/af/08012d/00000000000000003b9aefbc/27/l?subset_id=2&fvd=n3&v=3) format("woff2"), url(https://use.typekit.com/af/08012d/00000000000000003b9aefbc/27/d?subset_id=2&fvd=n3&v=3) format("woff"), url(https://use.typekit.com/af/08012d/00000000000000003b9aefbc/27/a?subset_id=2&fvd=n3&v=3) format("opentype");
        font-weight: 300;
        font-style: normal;
        font-display: auto;
    }
</style>
<?php echo '<body class="page-top" style="background-image:url(data:image/jpeg;base64,'.base64_encode($gensetbackground).');background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">' ?>

<nav class="navbar navbar-expand-lg" style="background-color:maroon">
    <span class="navbar-brand" style="color:white">EPLAN MO</span>
    <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
        </ul>
        <a class="nav-link" href="index.php" style="color:white">Home</a>
        <a class="nav-link" href="#" style="color:white">Blog</a>
        <a class="nav-link" href="#" style="color:white">About</a>
        <a href="epm_login.php"><button class="btn btn-light my-2 my-sm-0">SIGN IN</button></a>
    </div>
</nav>

<div class="wrapper d-flex" style="height:600px;background-size: cover; background-image:url(data:image/jpeg;base64,'.base64_encode($pomo).');">'
    <div class="container" style="margin-top: 2%;">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-1">

            </div>
            <div class="col-lg-10 col-md-10 col-sm-10">
                <div class="row">
                    <h1 style="color: green;text-align:center;font-weight:bolder">Organize your classes, task and exams &amp; never forget a lecture or assignments again </h1>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <p style="color:gray; font-weight:bolder;font-size:15px; text-align:justify; text-align-last:center;line-height: 1.5;">It's time to say goodbye to your paper planner. EPLAN MO is everything your paper planner is and more. Schedules, grades, teachers, subjects ? EPLAN MO has it covered on all your devices. Oh, and did we mention it's free ?</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                    </div>
                </div>
                <div class="row">
                    <?php 
                        $img = "SELECT * FROM images WHERE Name='School'";
                        $res = $db->query($img);
                        $gim = mysqli_fetch_assoc($res);
                        $pomo = $gim['Images'];
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($pomo).'" style="width:100%;height:auto">' 
                    ?>
                </div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1">

            </div>
        </div>
    </div>
</div>
<section id="services" style="background-color:white;">
    <div class="container">
        <div class="section-header">
            <h2 style="color:green; margin-top: 5%">Make your study life easier to manages</h2>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="box wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                    <div class="icon"><i class="fas fa-calendar"></i></div>
                    <h4 class="title"><a href="">SCHEDULING</a></h4>
                    <p class="description">Written from the ground up for schools, EPLAN Mo supports management of your time by sorting out whats need to be done earlier.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="icon"><i class="fas fa-tasks"></i></div>
                    <h4 class="title"><a href="">TASK</a></h4>
                    <p class="description">Not just another todo list. Bespoke for schools, EPLAN MO knows you need to keep track of more than just homework.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box wow fadeInLeft" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                    <div class="icon"><i class="fas fa-bell"></i></div>
                    <h4 class="title"><a href="">REMINDERS</a></h4>
                    <p class="description">Get notified about incomplete tasks and upcoming classes and exams with our mobile apps.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box wow fadeInRight" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInRight;">
                    <div class="icon"><i class="fas fa-sync-alt"></i></div>
                    <h4 class="title"><a href="">SYNC</a></h4>
                    <p class="description">Cross platform awesomeness. Your data seamlessly syncs across all of your devices and is accessible anytime anywhere , just connect to any active wifi or data</p>
                </div>
            </div>

        </div>

    </div>
</section>
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