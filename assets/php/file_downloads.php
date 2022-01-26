<?php
define('DB_SERVER', 'mysql-57012-0.cloudclusters.net');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'izju8Wk1');
define('DB_DATABASE', 'eplanmo');
define('DB_PORT','15418');

$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
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