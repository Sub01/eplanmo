<?php
include "config.php";
session_start();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "UPDATE `notif` SET `Status`='1' WHERE ID='$id'";
    $result = $db->query($sql); 
    if($result){
        header("Location: /epm_calendar.php");
   	    exit();
    }
    else{
        header("Location: /epm_calendar.php");
   	    exit();
    }
}
?>