<?php
$sql = "SELECT * FROM `general_settings`";
$result = $db-> query($sql);
if ($result-> num_rows >0) {
        $row = $result-> fetch_assoc();
        $gensetid = $row['ID'];
		$gensetbackground = $row['Background'];
		$gensetmodclose = $row['Modal_Close'];
		$gensetchart = $row['Chart'];
      }
?>