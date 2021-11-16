<?php
	$name = $_SESSION['User'];
	$ssql = "SELECT * FROM `teachers` WHERE `User`='$name'";
	$sresult = $sdb-> query($sql1);
?>