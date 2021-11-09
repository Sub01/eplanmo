<?php 
include("php_epm_profile.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$id = $_SESSION['User'];
	$title = $_POST['title'];
	$type = $_POST['type'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$datenow = date("Y-m-d H:i:s");
	if ($end > $datenow ) {
		$sql = "INSERT INTO `events` (`Name`, `Title`, `Type`, `Start`,`End`, `Status`) VALUES('$id','$title','$type','$start','$end','Ongoing')";
   		$result2 = mysqli_query($db, $sql);
   		session_start();
   		$_SESSION['status'] = "success";
   		$_SESSION['message'] = "Event Added Successfully";
   		header("Location: /EPM/epm_calendar.php");
   		exit();
	}
	elseif ($end < $datenow) {
		$sql = "INSERT INTO `events`(`ID`, `Title`, `Type`, `Start`,`End`, `Status`) VALUES('$id','$title','$type','$start','$end','Ended')";
   		$result2 = mysqli_query($db, $sql);
   		session_start();
   		$_SESSION['status'] = "success";
   		$_SESSION['message'] = "Event Added Successfully";
   		header("Location: /EPM/epm_calendar.php");
   		exit();
	}
	else{
		$_SESSION['status'] = "error";
   		$_SESSION['message'] = "There's an error processing your request";
   		header("Location: /EPM/epm_calendar.php");
   		exit();
	}
}
?>