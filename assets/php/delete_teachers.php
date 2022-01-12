<?php
include 'config.php';
session_start();
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM Teachers WHERE ID='$id'";
    $result = $db ->query($sql);
    $_SESSION['status'] = "success";
    $_SESSION['message'] = "Teacher Successfully Deleted";
    header("Location: /epm_teachers.php");
    exit();
}
?>