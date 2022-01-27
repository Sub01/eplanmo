<?php
include 'assets/php/php_epm_profile.php';
include 'assets/php/php_epm_genset.php';

if(!isset($_SESSION['User'])){
	header("Location: index.php");
	exit();
}
else{
	$username = $_SESSION["User"];
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>PROFILE</title>
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

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1739375817606067" crossorigin="anonymous"></script>
</head>
<style>
    .text {
        font-size: 20px;
    }
</style>
<?php echo '<body style="background-image:url(data:image/jpeg;base64,'.base64_encode($gensetbackground).');background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">' ?>
<div class="wrapper d-flex">
    <nav id="sidebar" class="" style="background-color: maroon;">
        <div class="custom-menu">

        </div>
        <div class="img bg-wrap text-center py-4" style="background-image: url(images/bg_1.jpg);">
            E-PLAN MO
        </div>
        <ul class="list-unstyled components mb-5">
            <li>
                <a href="epm_admin.php"><span class="fas fa-home mr-3"></span> Dashboard</a>
            </li>
            <li>
                <a href="epm_calendar.php"><span class="fas fa-calendar-week mr-3"></span> Calendar</a>
            </li>
            <li>
                <a href="epm_agenda.php"><span class="fas fa-calendar-check mr-3"></span> Agenda</a>
            </li>
            <li>
                <a href="epm_teachers.php"><span class="fas fa-chalkboard-teacher mr-3"></span> Teachers</a>
            </li>
            <li>
                <a href="epm_subjects.php"><span class="fas fa-book mr-3"></span> Subjects</a>
            </li>
            <li>
                <a href="epm_grades.php"><span class="fas fa-book-open mr-3"></span> Grades</a>
            </li>
            <li>
                <a href="epm_pomodoro.php"><span class="fas fa-stopwatch mr-3"></span> Pomodoro</a>
            </li>
            <li>
                <a href="epm_downloads.php"><span class="fas fa-download mr-3"></span> Downloads</a>
            </li>
        </ul>
    </nav>
    <div id="content" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <i type="button" id="sidebarCollapse" class="fas fa-bars"></i>
                </button>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <?php 
                                $sql = "SELECT COUNT(ID) as Counter FROM notif WHERE Name='$user' AND Status='0'";
                                $result = $db->query($sql);
                                $row = mysqli_fetch_assoc($result);
                                $counter = $row['Counter'];
                                ?>
                                <span class="badge badge-danger badge-counter"><?php echo $counter ?></span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notifications
                                </h6>
                                <?php 
                                $sql2 = "SELECT * FROM notif WHERE Name='$user' AND Status='0' ORDER BY ID DESC";
                                $result2 = $db->query($sql2);
                                while($row2 = mysqli_fetch_assoc($result2)){
                                ?>
                                <a class="dropdown-item d-flex align-items-center" href="assets/php/update_notif_profile.php?id=<?php echo $row2['ID']?>">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-eye" style="color:white;"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500"><?php echo $row2['Title']?></div>
                                        <span class="font-weight-bold"><?php echo $row2['Description']?></span>
                                    </div>
                                </a>
                                <?}?>
                            </div>
                        </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $names; ?> <?php echo $sname; ?></span>
                            <?php echo '<img class="rounded-circle" height="50" width="50" alt="" loading="lazy" src="data:image/jpeg;base64,'.base64_encode($image).'"/>'; ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="epm_profile.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="index.php" onclick="return confirm('Are you sure you want to Log Out?')">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if(isset($_SESSION['message']) && $_SESSION['status'] == 'error'): ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        <?php elseif (isset($_SESSION['message']) && $_SESSION['status'] == 'success'):?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        <?php endif; ?>
                        <?php unset($_SESSION['message']); ?>
                        <?php unset($_SESSION['status']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-md-12 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Personal Information</a>
                                        <!--
      						<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Teachers</a>
      						<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Subjects</a>
      						<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Grades</a>
-->
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <table class="table">
                                                        <tr>
                                                            <td class="text">Name</td>
                                                            <td class="text">:</td>
                                                            <td class="text"><?php echo $names?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text">Middle Name</td>
                                                            <td class="text">:</td>
                                                            <td class="text"><?php echo $mname?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text">Surname</td>
                                                            <td class="text">:</td>
                                                            <td class="text"><?php echo $sname?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text">Birthday</td>
                                                            <td class="text">:</td>
                                                            <td class="text"><?php echo $birthday?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text">Contact No.</td>
                                                            <td class="text">:</td>
                                                            <td class="text"><?php echo $contact?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text">Email</td>
                                                            <td class="text">:</td>
                                                            <td class="text"><?php echo $email?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-4">
                                                    <center>
                                                        <?php echo '<img style="height:70%; width:70%; border-radius:20%" alt="" loading="lazy" src="data:image/jpeg;base64,'.base64_encode($image).'"/>'; ?>
                                                        <br>
                                                        <br>
                                                        <button class="button btn btn-primary" id="updateButton" data-toggle="modal" data-target="#modalUpdateImage" style="margin-bottom: 3px;">Update Image</button>
                                                        <button class="button btn btn-primary" id="updateButton" data-toggle="modal" data-target="#modalUpdateInfo" style="margin-bottom: 3px;">Update Information</button>
                                                        <button href="#" class="btn btn-primary" id="updateButton" data-toggle="modal" data-target="#modalUpdatePassword" style="margin-bottom: 3px;">Update Password</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <!--
      						<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
								
							</div>
      						<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
						
							</div>
      						<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
							
							</div>
-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--MODAL FOR UPDATE INFORMATION-->
            <!--===============================================================================================-->
            <div id="modalUpdateInfo" class="modal fade" role="dialog">
                <div class="modal-dialog" style="max-width: 60%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Information</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="assets/php/update_info.php" method="POST">
                                <table class="table">
                                    <div class="form-group">
                                        <tr>
                                            <td>Name</td>
                                            <td>:</td>
                                            <td><input style="width: 100%;" type="text" name="name" required="" value="<?php echo $names ?>"></td>
                                            <td>Middle Name</td>
                                            <td>:</td>
                                            <td><input style="width: 100%;" type="text" name="mname" required="" value="<?php echo $mname ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Surname</td>
                                            <td>:</td>
                                            <td><input style="width: 100%;" type="text" name="sname" required="" value="<?php echo $sname ?>"></td>
                                            <td>Birthday</td>
                                            <td>:</td>
                                            <td><input style="width: 100%;" type="date" name="bday" required="" value="<?php echo $birthday ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Contact No.</td>
                                            <td>:</td>
                                            <td><input style="width: 100%;" type="number" name="cno" required="" value="<?php echo $contact ?>"></td>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td><input style="width: 100%;" type="email" name="email" required="" value="<?php echo $email ?>"></td>
                                        </tr>
                                    </div>
                                </table>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" style="margin-left: 80%;">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!--MODAL FOR UPDATE PASSWORD-->
            <!--===============================================================================================-->
            <div id="modalUpdatePassword" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Password</h4>
                            <div>

                            </div>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="assets/php/update_pass.php" method="POST">
                                <div class="form-group">
                                    <label>Enter Old Password</label></td>
                                    <input type="text" class="form-control" name="opw" value="" border="1" style="border: 1px solid #000000 !important" required=""></td>
                                </div>
                                <div class="form-group">
                                    <label>Enter New Password</label>
                                    <input type="text" class="form-control" name="npw" value="" style="border: 1px solid #000000 !important" required="">
                                </div>
                                <div class="form-group">
                                    <label>Confirm New Password</label>
                                    <input type="text" class="form-control" name="cnpw" value="" style="border: 1px solid #000000 !important" required="">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" style="margin-left: 80%;">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!--MODAL FOR UPLOAD PICTURE-->
            <!--===============================================================================================-->
            <div id="modalUpdateImage" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Image</h4>
                            <div>

                            </div>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="assets/php/update_image.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Select Image File:</label>
                                    <input type="file" name="image">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" name="upload" type="submit" style="margin-left: 80%;">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--SCRIPTS-->
            <!--===============================================================================================-->
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="assets/js/linechart.js"></script>
            <!--===============================================================================================-->
            <script src="assets/js/dashboard_main.js"></script>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            <!--===============================================================================================-->
            <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
            <script>
                $("document").ready(function() {
                    setTimeout(function() {
                        $("div.alert").remove();
                    }, <?php echo $gensetmodclose?>);
                });
            </script>
            <!--===============================================================================================-->

            </body>

</html>