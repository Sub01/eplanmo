<?php 
include 'config.php';
if (isset($_POST['save'])) {
    
    $filename = $_FILES['myfile']['name'];

    $destination = 'assets/uploads' . $filename;

    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['apk'])) {
        echo "You file extension must be .apk";
    } elseif ($_FILES['myfile']['size'] > 10000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO uploads (Name, Size, Downloads) VALUES ('$filename', $size, 0)";
            if (mysqli_query($db, $sql)) {
                echo "File uploaded successfully";
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>UPLOAD APK FILE</title>
</head>
<style>
form {
    width: 30%;
    margin: 100px auto;
    padding: 30px;
    border: 1px solid #555;
}
input {
    width: 100%;
    border: 1px solid #f1e1e1;
    display: block;
    padding: 5px 10px;
}
button {
  border: none;
  padding: 10px;
  border-radius: 5px;
}
table {
  width: 60%;
  border-collapse: collapse;
  margin: 100px auto;
}
th,
td {
  height: 50px;
  vertical-align: center;
  border: 1px solid black;
}
    </style>
  <body>
    <div class="container">
      <div class="row">
        <form action="" method="post" enctype="multipart/form-data" >
          <h3>Upload File</h3>
          <input type="file" name="myfile"> <br>
          <button type="submit" name="save">upload</button>
        </form>
      </div>
    </div>
  </body>
</html>