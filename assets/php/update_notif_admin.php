<?php
session_start();

if(isset($_GET['id'])){
    $sql = "UPDATE `notif` SET `Status`='1' WHERE ID='$id'";
    $result = $db->query($sql);
    if($result){
   			exit();
    }
    else{
   			exit();
		}
}
?>