<?php
include('config.php');
session_start();

if (isset($_GET['id'])){
	$id = $_GET['id'];
	$sql = "INSERT INTO archived SELECT * FROM events WHERE ID= '$id'";
	$result = $db-> query($sql);	
	if($result){
			$sql2 = "DELETE FROM events WHERE ID='$id'";
			$result2 = $db-> query($sql2);
			$sql3 = "UPDATE archived SET Status='Archived' WHERE ID='$id'";
			$result3 = $db-> query($sql3);
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Event Successfully Archived";
            header("Location: /EPM/epm_admin.php");
            exit();
    }
    else
    {
            $_SESSION['status'] = "error";
            $_SESSION['message'] = "There's an error processing your request";
            header("Location: /EPM/epm_admin.php");
            exit();
    }
}
?>
