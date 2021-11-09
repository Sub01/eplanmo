<?php
include('config.php');
session_start();

if (isset($_GET['id'])){
	$id = $_GET['id'];
	$sql = "DELETE FROM users WHERE ID= '$id'";
	$result = $db-> query($sql);	
	if($result){
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "User Successfully Deleted";
            header("Location: /EPM/epm_administrator.php");
            exit();
    }
    else
    {
            $_SESSION['status'] = "error";
            $_SESSION['message'] = "There's an error processing your request";
            header("Location: /EPM/epm_administrator.php");
            exit();
    }
}
?>
