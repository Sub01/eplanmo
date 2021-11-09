<?php
include ("session_login.php");

$username = $_SESSION['User'];
$datenow = date("Y-m-d H:i:s");
$all = '0';
$ongoing = '0';
$ended = '0';

$sql = "SELECT * FROM `users` WHERE Username = '$username'";
$result = $db-> query($sql);
if ($result-> num_rows >0) {
        $row = $result-> fetch_assoc();
		$uname = $row['Username'];
        $image = $row['Images'];
		$password = $row['Password'];
		$names = $row['Name'];
		$mname = $row['Middle_Name'];
		$sname = $row['Surname'];
		$birthday = $row['Birthday'];
		$contact = $row['Contact_No'];
		$email = $row['Email'];
      }
?>