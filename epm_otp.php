<?php
include "config.php";
include ("assets/php/php_epm_genset.php");
session_start();

if(isset($_POST['submit'])) {
$email = $_SESSION['email'];
$otp = $_POST['otp'];
$sql = "SELECT * FROM users WHERE Code='$otp' AND Email='$email'";
$result =$db->query($sql);
	if($result-> num_rows>0){
		$fetch = mysqli_fetch_assoc($result);
		$email = $fetch['Email'];
		$sql2 = "UPDATE `users` SET Code='0', Status='Verified' WHERE Email='$email'";
		$result2 = $db-> query($sql2);
		if($result2){
			$_SESSION['status'] = "success";
			$_SESSION['message'] = "EMAIL VERIFICATION COMPLETE";
			header('Location: index.php');
			exit();
		}
		else{
			$_SESSION['status'] = "error";
			$_SESSION['message'] = "There's a problem processing your request";
			header('Location: epm_otp.php');
			exit();
		}
	}
	else{
		$_SESSION['status'] = "error";
		$_SESSION['message'] = "YOU'VE ENTERED A WRONG OTP";
		header('Location: epm_otp.php');
		exit();
	}
}

if(isset($_POST['resend'])) {
$email = $_SESSION['email'];
$otp = $_POST['otp'];
$sql = "SELECT * FROM users WHERE Code='$otp' AND Email='$email'";
$result =$db->query($sql);
	if($result-> num_rows>0){
		$fetch = mysqli_fetch_assoc($result);
		$email = $fetch['Email'];
		$sql2 = "UPDATE `users` SET Code='0', Status='Verified' WHERE Email='$email'";
		$result2 = $db-> query($sql2);
		if($result2){
			$_SESSION['status'] = "success";
			$_SESSION['message'] = "EMAIL VERIFICATION COMPLETE";
			header('Location: index.php');
			exit();
		}
		else{
			$_SESSION['status'] = "error";
			$_SESSION['message'] = "There's a problem processing your request";
			header('Location: epm_otp.php');
			exit();
		}
	}
	else{
		$_SESSION['status'] = "error";
		$_SESSION['message'] = "YOU'VE ENTERED A WRONG OTP";
		header('Location: epm_otp.php');
		exit();
	}
}

if(isset($_POST['back'])){
	unset($_SESSION['email']);
	header('Location: index.php');
	exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
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
</head>
<?php echo '<body style="background-image:url(data:image/jpeg;base64,'.base64_encode($gensetbackground).');background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">' ?>
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				
			</div>
			<div class="col-xl-8 col-md-2 mb-4" style="margin-top: 15%">
        		<div class="card border-left-primary shadow h-100 py-2">
            		<div class="card-body">
						<div>
							<center><img src="assets/images/Communication-email-green-icon.png" style="width: 30%; height: 30%;"></center>
						</div>
						<div class="login-content" style="padding-top: 5%;">
							<form method="POST" action="">
							<center><h2 class="title">EMAIL VERIFICATION</h2></center>
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
						<div class="row form-group">								
							<i class="fas fa-key fa-2x" style="padding: 5px;"></i>
							<span style="width: 90%"><input class="form-control" type="text" name="otp" placeholder="ENTER OTP"></span>
						</div>
						<div class="row">
							<div class="col-md-4">
								<button type="button" onclick="window.location.href='index.php'" class="btn" style="width: 100%"><i class="fas fa-hand-point-left"></i> BACK</button>
							</div>
							<div class="col-md-4">
								<button type="button" class="btn" style="width: 100%" name="resend"><i class="fas fa-envelope"></i> RESEND EMAIL</button>
							</div>
							<div class="col-md-4">
								<button class="btn btn-secondary fa-pull-right" name="submit" type="submit" style="width: 100%"><i class="fas fa-check"></i> SUBMIT</button>
							</div>
							</form>	
						</div>		
					</div>
				</div>
			</div>
			<div class="col-md-2">
				
			</div>
		</div>
	</div>
<script>
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
<body>
</body>
</html>