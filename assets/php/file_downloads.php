<?php
if(!empty($_GET['path'])){
    $fileName = basename($_GET['path']);
    $filePath = 'assets/uploads/'.$fileName;
    if(!empty($fileName) && file_exists($filePath)){
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Transfer-Encoding: binary");
        readfile($filePath);
        exit;
    }else{
        echo 'The file does not exist.';
    }
}
?>