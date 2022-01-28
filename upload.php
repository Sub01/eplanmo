<?php 
include 'config.php';
if (isset($_POST['save'])) {
	$location = "assets/uploads/";
	$file_new_name = date("dmy") . time() . $_FILES["file"]["name"];
	$file_name = $_FILES['file']["name"];
	$file_temp = $_FILES['file']["tmp_name"];
	$file_size = $_FILES['file']['size'];
	if ($file_size > 10485760) {
		echo "<script>alert('Woops! File is too big. Maximum file size allowed for upload 10 MB.')</script>";
	} 
    else{
		$sql = "INSERT INTO uploads (Name, New_Name, Size,Downloads)VALUES ('$file_name','$file_new_name','$file_size','0')";
		$result = mysqli_query($db, $sql);
		if ($result) {
			move_uploaded_file($file_temp, $location . $file_new_name);
			echo "<script>alert('Wow! File uploaded successfully.')</script>";
		} 
        else{
			echo "<script>alert('Woops! Something wong went.')</script>";
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>FILE UPLOADS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="assets/css/dashboard_main.css">
    <link rel="stylesheet" href="assets/css/animation.css">
    <link rel="stylesheet" href="assets/css/summary.css">
    <link rel="stylesheet" href="assets/css/chart.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/general.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
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
<header id="header" class="d-flex align-items-center" style="background-color:maroon">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <span>
                <h1 class="logo" style="color:white;">EPLAN MO</h1>
            </span>
            <button class="navbar-toggler btn btn-light" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation" style="color: maroon !important">
                <span class="navbar-toggler-icon" style="color: white;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                </ul>
                <a class="nav-link" href="#hero" style="color:white">HOME</a>
                <a class="nav-link" href="#featured-services" style="color:white">SERVICES</a>
                <a class="nav-link" href="#about" style="color:white">ABOUT</a>
                <a class="nav-link" href="#contact" style="color:white">CONTACT</a>
                <a href="epm_login.php"><button class="btn btn-light my-2 my-sm-0">SIGN IN</button></a>
            </div>
        </nav>
    </div>
</header>
    <div class="container">
      <div class="row">
        <form action="" method="post" enctype="multipart/form-data" >
          <h3>Upload File</h3>
          <input type="file" name="file"> <br>
          <button type="submit" name="save">upload</button>
        </form>
      </div>
    </div>
  </body>
</html>