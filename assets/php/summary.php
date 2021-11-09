<?php
	$name = $_SESSION['User'];
	$datenow = date("Y-m-d H:i:s");
	$all = '0';
	$ongoing = '0';
	$ended = '0';
	$archived = '0';
	$sql1 = "SELECT Count(`Name`) AS total FROM `events` WHERE `Name`='$name'";
	$sql2 = "SELECT Count(`Name`) AS total2 FROM `events` WHERE `Name`='$name' AND `Status`='Ongoing'";
	$sql3 = "SELECT Count(`Name`) AS total3 FROM `events` WHERE `Name`='$name' AND `Status`='Ended'";
	$sql4 = "SELECT Count(`Name`) AS total4 FROM `events` WHERE `Name`='$name' AND `Status`='Archived'";
	$result1 = $db-> query($sql1);
	$result2 = $db-> query($sql2);
	$result3 = $db-> query($sql3);
	$result4 = $db-> query($sql4);
    $row1 = $result1-> fetch_assoc();
    $row2 = $result2-> fetch_assoc();
    $row3 = $result3-> fetch_assoc();
	$row4 = $result4-> fetch_assoc();
    $all = $row1["total"];
    $ongoing = $row2["total2"];
    $ended = $row3["total3"];
	$archived = $row4["total4"]
?>	