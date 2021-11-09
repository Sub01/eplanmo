<?php
include('config.php');
if(isset($_POST['forgot'])){
	$username = $_POST['username2'];
	$email = $_POST['email2'];
	$sql1 = "SELECT * FROM `users` WHERE `Username`='$username' AND `Email`='$email'";
	$result = mysqli_query($db,$sql1);
	$fetch = mysqli_fetch_assoc($result);
	if($result){
		$sql2 = "UPDATE Code FROM `users` SET Code=''";
		$script = "<script> $(document).ready(function(){ $('#modalUserError').modal('show'); }); </script>";
		header("Location: /EPM/index.php");
		exit();
	}
	else{
		$script = "<script> $(document).ready(function(){ $('#modalUserError').modal('show'); }); </script>";
		header("Location: /EPM/index.php");
		exit();
	}
}
?>