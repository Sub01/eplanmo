<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['User'];
   
   $ses_sql = mysqli_query($db,"SELECT * FROM users WHERE Username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $_SESSION['User'];
   
   if(isset($_SESSION['Users'])){
      header("location:epm_admin.php");
      exit();
   }
?>