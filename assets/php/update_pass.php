<?php
include("php_Epm_profile.php");

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = $_SESSION['User'];
	$old = $_POST['opw'];
	$new = $_POST['npw'];
	$cnew = $_POST['cnpw'];

	$sql = "SELECT * FROM `users` WHERE Username='$username' AND Password='$old'";
	$result = $db-> query($sql);
	if ($result-> num_rows >0) 
	{
		$row = $result-> fetch_assoc();
		if ($new != $cnew) {
			$_SESSION['status'] = 'error';
			$_SESSION['message'] = 'New Password Do Not Match';
			header("Location: /EPM/epm_profile.php");
			exit();
		}
		else{
			$sql2 = "UPDATE `users` SET Password='$new' WHERE Username = '$username'";
			$result = $db-> query($sql2);
			$_SESSION['status'] = "success";
			$_SESSION['message'] = "Password Successfully Updated";
			header("Location: /EPM/epm_profile.php");
			exit();
			}
		
	}
	else{
		$_SESSION['status'] = 'error';
		$_SESSION['message'] = 'Incorrect Old Password';
		header("Location: /EPM/epm_profile.php");
		exit();
	}
}
?>