<?php
include 'config.php'
    session_start();
    $data1 = '';
    $data2 = '';

    //query to get data from the table
    $sql = "SELECT  DATE_FORMAT(`Timestamp`,'%m-%d-%y') AS `Current`, COUNT(`ID`) AS `Total` FROM `events` GROUP BY `Current`";

    $result = mysqli_query($mysqli, $sql);

    //loop through the returned data
    while ($row = mysqli_fetch_array($result)) {

        $data1 = $data1 . '"'. $row['Current'].'",';
        $data2 = $data2 . '"'. $row['Total'] .'",';
    }

    $data1 = trim($data1,",");
    $data2 = trim($data2,",");
?>