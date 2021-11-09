<?php
include 'config.php';
	$modclose = $_POST['modclose'];
	$chart = $_POST['chart'];
	$background = $_FILES['image']['name'];
	if($background!=''){
		$ext = pathinfo($img_name, PATHINFO_EXTENSION);
      	$allowed = ['png', 'gif', 'jpg', 'jpeg'];
      	$img_data = addslashes(file_get_contents($_FILES['image']['tmp_name']));
		$sql = "UPDATE `general_settings` SET Modal_close='$modclose', Background='$img_data', Chart='$chart' WHERE ID='1'";
		if(mysqli_query($db,$sql)){
			$_SESSION['status'] = "success";
			$_SESSION['message'] = "Information Successfully Updated";
			header("Location: /EPM/epm_administrator.php");
			exit();
		}
		else{
			$_SESSION['status'] = "error";
			$_SESSION['message'] = "There's an error processing your request";
			header("Location: /EPM/epm_administrator.php");
			exit();
		}
	}
	else{
		$sql = "UPDATE `general_settings` SET Modal_close='$modclose', Chart='$chart' WHERE ID='1'";
		if(mysqli_query($db,$sql)){
			$_SESSION['status'] = "success";
			$_SESSION['message'] = "Information Successfully Updated";
			header("Location: /EPM/epm_administrator.php");
			exit();
		}
		else{
			$_SESSION['status'] = "error";
			$_SESSION['message'] = "There's an error processing your request";
			header("Location: /EPM/epm_administrator.php");
			exit();
		}
	}
	
?>