<?php
if(isset($_GET['path'])){
    $file = $_GET['path'];
    $fileName = basename($file);
    $filePath = '../assets/uploads/'.$fileName;
    if(file_exists($filePath)){
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Transfer-Encoding: binary");
        readfile($filePath);
        exit;
    }
    else{
        echo 'The file does not exist.';
    }
}

?>