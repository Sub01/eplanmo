<?php
include 'config.php';
session_start();
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM grades WHERE ID='$id'";
    $result = $db ->query($sql);
    $_SESSION['status'] = "success";
    $_SESSION['message'] = "Grades Successfully Deleted";
    header("Location: /epm_grades.php");
    exit();
}
?>  