<?php
include 'config.php';
session_start();
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM subjects WHERE ID='$id'";
    $result = $db ->query($sql);
    $_SESSION['status'] = "success";
    $_SESSION['message'] = "Subject Successfully Deleted";
    header("Location: /epm_subjects.php");
    exit();
}
?>  