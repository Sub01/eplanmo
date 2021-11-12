<?php

$connect = new PDO('mysql:host=mysql-57012-0.cloudclusters.net;port=15418; dbname=eplanmo', 'admin', 'izju8Wk1');

if(isset($_POST["id"]))
{
 $query = "UPDATE `events` SET `Title`=:title, `Start`=:start_event, `End`=:end_event WHERE `ID`=:id";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':id'   => $_POST['id']
  )
 );
}
?>
