<?php 
inlcude ('config.php');
session_start();
$user = $_SESSION['User'];
$data = array();
$query = "SELECT * FROM events WHERE ID='$user'";
$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
 $data[] = array(
  'title'   => $row["Title"],
  'type'   => $row["Type"],
  'start'   => $row["Start"],
  'end'   => $row["End"],
  'status'   => $row["Status"],
 );
}

echo json_encode($data);

?>
