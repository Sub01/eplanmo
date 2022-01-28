<?php
if(isset($_GET['link']))
{
    $var_1 = $_GET['link'];

$dir = "assets/uploads/";
$file = $dir . $var_1;

if (file_exists($file))
    {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    header("Location:https://eplanmo.herokuapp.com/epm_downloads.php")
    exit;
    }
}
?>