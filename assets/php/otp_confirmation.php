<?php
include("config.php");
session_start();
if($_SERVER['REQUEST_METHOD'] =='POST'){
	$otp = $_POST['otp'];
	$sql = "SELECT * FROM `users` WHERE `Code`='$otp'";
	$result = $db-> query($sql);
	if($result-> num_rows >0){
	$row = $result-> fetch_assoc();
	$email = $row['Email'];
    $sql2 = "UPDATE `users` SET Code='0', Status='Verified' WHERE Email='$email'";
   	$result2 = $db-> query($sql2);
    if($result2){
    	$_SESSION['status'] = "success";
        $_SESSION['message'] = "EMAIL VERIFICATION COMPLETE";
        header('Location: /EPM/index.php');
        exit();
    }
	else{
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "There's a problem processing your request";
        header('Location: /EPM/user-oto.php');
        exit();
    }
}
else{
    $_SESSION['status'] = "error";
    $_SESSION['message'] = "YOU'VE ENTERED A WRONG OTP";
    header('Location: /EPM/user-oto.php');
    exit();
}
}


?>