<?php
   include("config.php");

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $username = mysqli_real_escape_string($db,$_POST['username']);
      $password = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM `users` WHERE Username = '$username' and Password = '$password'";
      $result = $db-> query($sql);
      if ($result-> num_rows >0) {
         $row = $result-> fetch_assoc();
         $_SESSION['user'] = $row['Username'];
         $_SESSION['status'] = "success";
         $_SESSION['message'] = "Login Sucessful";
         echo "<script>window.location.href='/EPM/epm_admin.php'</script>";
         exit();
      }
      else{
      	$_SESSION['status'] = "error";
         $_SESSION['message'] = "Invalid Username or Password";
         header("Location: /EPM/index.php");
         exit();
      }
   }
?>