<?php
include("php_epm_profile.php");

$username = $_SESSION['User'];

    $img_name = $_FILES['image']['name'];
    if ($img_name!='')
    {
        $ext = pathinfo($img_name, PATHINFO_EXTENSION);
        $allowed = ['png', 'gif', 'jpg', 'jpeg'];
        $img_data = addslashes(file_get_contents($_FILES['image']['tmp_name']));     
        $sql = "UPDATE `users` SET Images='$img_data' WHERE Username='$username'";
        if(mysqli_query($db, $sql)){
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Image Successfully Updated";
            header("Location: /epm_profile.php");
            exit();
        }
        else
        {
            $_SESSION['status'] = "error";
            $_SESSION['message'] = "There's an error processing your request";
            header("Location: /epm_profile.php");
            exit();
        }
    }
?>