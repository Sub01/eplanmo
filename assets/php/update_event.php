<?php
include('config.php');
session_start();
	if(isset($_POST['upev']){
		$id = $_POST['id'];
		$title = $_POST['title'];
		$type = $_POST['type'];
		$start = $_POST['start'];
		$end = $_POST['end'];
		
		$sql = "UPDATE `events` SET `Title` = '$title', `Type`='$type', `Start`='$start', `End`='$end' WHERE `ID`='$id'";
		if(mysqli_query($db, $sql)){
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Event Successfully Updated";
            header("Location: /epm_admin.php");
            exit();
        }
        else
        {
            $_SESSION['status'] = "error";
            $_SESSION['message'] = "There's an error processing your request";
            header("Location: /epm_admin.php");
            exit();
        }
	}
?>