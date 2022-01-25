<?php
include("config.php");
session_start();
$name = $_SESSION['User'];
if(isset($_POST["view"]))
{
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE notif SET Status='1' WHERE Status='0' AND Name='$name'";
  mysqli_query($db, $update_query);
 }
 $query = "SELECT * FROM notif ORDER BY ID DESC LIMIT 5";
 $result = mysqli_query($db, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <li>
    <a href="#">
     <strong>'.$row["Title"].'</strong><br />
     <small><em>'.$row["Description"].'</em></small>
    </a>
   </li>
   <li class="divider"></li>
   ';
  }
 }
 else
 {
  $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 }
 
 $query_1 = "SELECT * FROM notif WHERE Status='0' AND Name='$name'";
 $result_1 = mysqli_query($db, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>