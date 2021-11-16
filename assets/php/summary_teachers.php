<?php
	$name = $_SESSION['User'];
	$sql1 = "SELECT * FROM `teachers` WHERE `Name`='$name'";
	$result1 = $db-> query($sql1);
	$row1 = $result1-> fetch_assoc();
?>