<?php 
	$id = $_SESSION['User'];
	$sql = "SELECT * FROM grades WHERE Name='$id'";
    $result =$db->query($sql);
	while ($row = mysqli_fetch_array($result)) {
		$score = $row['Score'];
		$over = $row['Over'];
		$scode = $row['Subject_Code'];
		$percentage = (($score/$over) * 100);
	}
?>