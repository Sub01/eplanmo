<?php
session_start();
$_SESSION['status'] = "success";
$_SESSION['message'] = "Logout Sucessful";
echo "<script>window.location.href='/index.php'</script>";
?>