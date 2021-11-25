<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$sql = "UPDATE `teachers` SET `T_Name`='$tname', `T_Surname`='$tsname', `T_Email`='$temail' WHERE `ID`='$tid'";
	$result = $db->query($sql);
	if($result){
		$_SESSION['status'] = "success";
   		$_SESSION['message'] = "Teacher's Information Successfuly Updated";
		header("Location: epm_agenda.php");
		exit();
	}
	else{
		$_SESSION['status'] = "error";
   		$_SESSION['message'] = "Failed to Update Teacher's Information";
		header("Location: epm_agenda.php");
		exit();
	}
}
?>