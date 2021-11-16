<?php
	$name = $_SESSION['User'];
	$ssql = "SELECT * FROM `teachers` WHERE `Name`='$name'";
	$sresult = $sdb-> query($sql1);
?>