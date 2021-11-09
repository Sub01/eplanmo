<?php
include("php_epm_profile.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

	$username = $_SESSION['User'];
	$name2 = $_POST['name'];
	$mname2 = $_POST['mname'];
	$sname2 = $_POST['sname'];
	$bday2 = $_POST['bday'];
	$email2 = $_POST['email'];
	$cno2 = $_POST['cno'];

	$sql = "UPDATE `users` SET Name='$name2', Middle_Name='$mname2', Surname='$sname2', Birthday='$bday2', Email='$email2', Contact_No='$cno2'  WHERE Username = '$username'";
		if(mysqli_query($db,$sql)){
			$_SESSION['status'] = "success";
			$_SESSION['message'] = "Information Successfully Updated";
			header("Location: /EPM/epm_profile.php");
			exit();
		}
		else{
			$_SESSION['status'] = "error";
			$_SESSION['message'] = "There's an error processing your request";
			header("Location: /EPM/epm_profile.php");
			exit();
		}
}



?>