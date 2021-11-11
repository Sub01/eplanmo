<?php
session_start();
$connect = new PDO("mysql:host='mysql-57012-0.cloudclusters.net'; dbname='eplanmo'", 'admin', 'izju8Wk1');
$id = $_SESSION['User'];
$data = array();
$query = "SELECT * FROM events WHERE Name='$id'";
$statement = $connect->prepare($query);
$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
    $data[] = array(
        'id'=> $row['ID'],
        'title'=> $row["Title"],
        'start'=> $row["Start"],
        'end'=> $row["End"]
    );
}

echo json_encode($data);

?>