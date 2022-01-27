<?php
include("config.php");
include ("assets/php/php_epm_genset.php");
session_start();

if(isset($_GET['Code']) && isset($_GET['User']) && isset($_GET['Email'])){
	if(isset($_POST['submit'])){
		$code = $_GET['Code'];
		$user = $_GET['User'];
		$email = $_GET['Email'];
		$password = $_POST['pword1'];
		$query = "SELECT * FROM users WHERE Email='$email' AND Code='$code'";
		$result1 = mysqli_query($db,$query);
		if($result1->num_rows>0){
			$sql = "UPDATE `users` SET Password='$password' WHERE Email='$email'";
			$result = mysqli_query($db,$sql);
			if($result){
			$new_code = '0';
			$sql2 = "UPDATE `users` SET Code='$new_code' WHERE Email='$email'";
			$result = $db-> query($sql2);
			$script = "<script> $(document).ready(function(){ $('#modalResetSuccess').modal('show'); }); </script>";
			}
		}else{
			$script = "<script> $(document).ready(function(){ $('#modalResetExpired').modal('show'); }); </script>";
		}
	}
}
else{
	header("Location: /epm_login.php");
	exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>RESET PASSWORD</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!--===============================================================================================-->	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
<!--===============================================================================================-->	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<!--===============================================================================================-->	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!--===============================================================================================-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link rel="stylesheet" href="assets/css/login.css">
	<link rel="stylesheet" href="assets/css/animation.css">
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
			<div class="col-xl-8 col-md-8 mb-4" style="margin-top: 15%">
        		<div class="card border-left-primary shadow h-100 py-2">
            		<div class="card-body">
						<div class="login-content" style="padding-top: 5%;">
							<form method="POST" action="">
							<center><h2 class="title">RESET PASSWORD</h2></center>	
							<div class="input-div one">
								<div class="i">
									<i class="fas fa-lock"></i>
								</div>
								<div class="div">
									<h5>Password</h5>
									<input class="input" id="pword1" type="password" name="pword1" required="" maxlength="20" style="width: 90%">
								</div>
							</div>
							<div style="margin-top: -20px;">
								<input type="checkbox" class="fa-pull-left" style="margin-top: 4px; margin-right: 4px;" onClick="showPassword1();"><p style="text-align: left">Show Password</p>
							</div>
							<div class="input-div one">
								<div class="i">
									<i class="fas fa-lock"></i>
								</div>
								<div class="div">
									<h5>Repeat Password</h5>
									<input class="input" id="pword2" type="password" name="pword2" required="" maxlength="20" style="width: 90%">
								</div>
							</div>
							<div style="margin-top: -20px;">
								<input type="checkbox" class="fa-pull-left" style="margin-top: 4px; margin-right: 4px;" onClick="showPassword2();"><p style="text-align: left">Show Password</p>
								<label id="message">
							</div>
							<div class="row">
								<div class="col-md-6">
									<button type="button" onclick="window.location.href='epm_login.php'" class="btn" style="width: 50%"><i class="fas fa-hand-point-left"></i> BACK</button>
								</div>
								<div class="col-md-6">
									<button name="submit" class="btn btn-secondary fa-pull-right" id="submit" type="submit" style="width: 50%"><i class="fas fa-check"></i> SUBMIT</button>
									<?php if(isset($script)){ echo $script; } ?>
									<?php unset($script); ?>
								</div>
							</div>
							</form>	
						</div>
					</div>
				<div>
			</div>
			<div class="col-md-2">
				
			</div>
		</div>
	</div>
		
<div id="modalResetSuccess" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
			<img src="assets/images/congrats.png" style="width: 10%;height: 10%">
          	<h2 class="modal-title">Password Reset Successfuly</h2>
          <button type="button" class="close" data-dismiss="modal" onclick="window.location.href='index.php'">&times;</button>
        </div>
        <div class="modal-body">
          <p>You can now logged in your account using your new password.</p>
        </div>
      </div>
    </div>
  </div>
<div id="modalResetExpired" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
			<img src="assets/images/error.png" style="width: 10%;height: 10%">
          	<h2 class="modal-title">OTP has been already used</h2>
          <button type="button" class="close" data-dismiss="modal" onclick="window.location.href='index.php'">&times;</button>
        </div>
        <div class="modal-body">
          <p>Link or Session you have used has been expired. please request another Request in Forgot Password in Login Page.</p>
        </div>
      </div>
    </div>
  </div>
<script>
$('#pword1, #pword2').on('keyup', function () {
  		if ($('#pword1').val() == $('#pword2').val()) {
    		$('#message').html('Password Match').css('color', 'green');
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
$('#modalReset').modal({
    backdrop: 'static',
    keyboard: false
})
</script>
<body>
</body>
</html>