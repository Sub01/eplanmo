<?php
include "config.php";
if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM uploads WHERE ID='$id'";
        $result = mysqli_query($db, $sql);

        $row = mysqli_fetch_assoc($result);
        $filepath = '/assets/uploads/' . $row['Name'];

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('/assets/uploads/' . $row['Name']));
            readfile('/assets/uploads/' . $row['Name']);
            $newCount = $row['Downloads'] + 1;
            $updateQuery = "UPDATE uploads SET Downloads='$newCount' WHERE ID='$id'";
            mysqli_query($db, $updateQuery);
            header("Location : /epm_downloads.php");
            exit;
        }

    }

?>