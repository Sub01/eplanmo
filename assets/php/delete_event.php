<?php
include('config.php');
session_start();

if (isset($_GET['id'])){
	$id = $_GET['id'];
	$sql = "DELETE FROM events WHERE ID= '$id'";
	$result = $db-> query($sql);	
	if($result){
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Event Successfully Deleted";
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
