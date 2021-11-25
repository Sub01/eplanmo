<?php 
	$sql = "UPDATE `subjects` SET `S_Code`='$scode', `S_Description`='$sdes' WHERE `ID`='$sid'";
	$result = $db->query($sql);
	if($result){
		$_SESSION['status'] = "success";
   		$_SESSION['message'] = "Subject's Information Successfuly Updated";
		header("Location: epm_agenda.php");
		exit();
	}
	else{
		$_SESSION['status'] = "error";
   		$_SESSION['message'] = "Failed to Update Subject's Information";
		header("Location: epm_agenda.php");
		exit();
	}
?>