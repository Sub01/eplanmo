<?php
include ("assets/php/php_epm_profile.php");
include ("assets/php/php_epm_genset.php");
include ("assets/php/summary.php");

if(!isset($_SESSION["User"])){
	header("Location: https://eplanmo.herokuapp.com/epm_login.php");
	exit();
}	
else{
    
}

?>
<!doctype html>
<html>

<head>
    <title>AGENDA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="assets/css/dashboard_main.css">
    <link rel="stylesheet" href="assets/css/animation.css">
    <link rel="stylesheet" href="assets/css/summary.css">
    <link rel="stylesheet" href="assets/css/chart.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/general.min.css">
    <!--===============================================================================================-->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1739375817606067" crossorigin="anonymous"></script>
</head>

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
                <a href="https://eplanmo.herokuapp.com/epm_admin.php"><span class="fas fa-home mr-3"></span> Dashboard</a>
            </li>
            <li>
                <a href="https://eplanmo.herokuapp.com/epm_calendar.php"><span class="fas fa-calendar-week mr-3"></span> Calendar</a>
            </li>
            <li class="active">
                <a href="https://eplanmo.herokuapp.com/epm_agenda.php"><span class="fas fa-calendar-check mr-3"></span> Agenda</a>
            </li>
            <li>
                <a href="https://eplanmo.herokuapp.com/epm_teachers.php"><span class="fas fa-chalkboard-teacher mr-3"></span> Teachers</a>
            </li>
            <li>
                <a href="https://eplanmo.herokuapp.com/epm_subjects.php"><span class="fas fa-book mr-3"></span> Subjects</a>
            </li>
            <li>
                <a href="https://eplanmo.herokuapp.com/epm_grades.php"><span class="fas fa-book-open mr-3"></span> Grades</a>
            </li>
            <li>
                <a href="https://eplanmo.herokuapp.com/epm_pomodoro.php"><span class="fas fa-stopwatch mr-3"></span> Pomodoro</a>
            </li>
            <li>
                <a href="https://eplanmo.herokuapp.com/epm_downloads.php"><span class="fas fa-download mr-3"></span> Downloads</a>
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
                                <a class="dropdown-item d-flex align-items-center" href="assets/php/update_notif_agenda.php?id=<?php echo $row2['ID']?>">
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
                            <a class="dropdown-item" href="https://eplanmo.herokuapp.com/epm_profile.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="https://eplanmo.herokuapp.com/assets/php/session_logout.php" onclick="return confirm('Are you sure you want to Log Out?')">
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
                    <div class="col-md-3 col-lg-3 col-sm-3">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 mb-4">
                                <div class="card shadow py-2">
                                    <div class="card-header">
                                        <span style="text-align: center; color: black; font-weight: bold"><i class="fas fa-calendar"></i> TODAY</span>
                                    </div>
                                    <div class="card-body" style="flex: 0 1 auto; overflow-y: auto; height:350px; max-height: calc(350px - 20px - 20px);">
                                        <div class="row overflow-auto">
                                            <?php 
							$sql = "SELECT * FROM events WHERE Name='$uname' AND (DATEDIFF(Start,NOW()) = 0)";
                			$result =$db->query($sql);
							while ($row = mysqli_fetch_array($result)) {?>
                                            <div class="col-xl-6 col-md-6 mb-4">
                                                <div class="card border-top-primary shadow" style="border-left-style: solid; border-top-width: thick; border-top-color:rgb(0, 123, 255)">
                                                    <div class="card-header">
                                                        <span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $row['Title'] ?></span><br>
                                                        <span class="text-gray text-uppercase mb-1">END : <?php echo $row['End'] ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <?php  } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-3">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 mb-4">
                                <div class="card shadow py-2">
                                    <div class="card-header">
                                        <span style="text-align: center; color: black; font-weight: bold"><i class="fas fa-calendar"></i> TOMMOROW</span>
                                    </div>
                                    <div class="card-body" style="flex: 0 1 auto; overflow-y: auto;  height:350px;max-height: calc(350px - 20px - 20px);">
                                        <div class="row">
                                            <?php 
							$sql = "SELECT * FROM events WHERE Name='$uname' AND  (DATEDIFF(Start,NOW()) = 1)";
                			$result =$db->query($sql);
							while ($row = mysqli_fetch_array($result)) {?>
                                            <div class="col-xl-6 col-md-6 mb-4">
                                                <div class="card border-top-primary shadow" style="border-left-style: solid; border-top-width: thick; border-top-color:rgb(0, 123, 255)">
                                                    <div class="card-header">
                                                        <span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $row['Title'] ?></span><br>
                                                        <span class="text-gray text-uppercase mb-1">END : <?php echo $row['End'] ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <?php  } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-3">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 mb-4">
                                <div class="card shadow py-2">
                                    <div class="card-header">
                                        <span style="text-align: center; color: black; font-weight: bold"><i class="fas fa-calendar"></i> WITHIN 7 DAYS</span>
                                    </div>
                                    <div class="card-body" style="flex: 0 1 auto; overflow-y: auto; height:350px; max-height: calc(350px - 20px - 20px);">
                                        <div class="row">
                                            <?php 
							$sql = "SELECT * FROM events WHERE  Name='$uname' AND (DATEDIFF(Start,NOW()) BETWEEN 2 AND 7)";
                			$result =$db->query($sql);
							while ($row = mysqli_fetch_array($result)) {?>
                                            <div class="col-xl-6 col-md-6 mb-4">
                                                <div class="card border-top-primary shadow" style="border-left-style: solid; border-top-width: thick; border-top-color:rgb(0, 123, 255)">
                                                    <div class="card-header">
                                                        <span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $row['Title'] ?></span><br>
                                                        <span class="text-gray text-uppercase mb-1">END : <?php echo $row['End'] ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <?php  } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-3">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 mb-4">
                                <div class="card shadow py-2">
                                    <div class="card-header">
                                        <span style="text-align: center; color: black; font-weight: bold"><i class="fas fa-calendar"></i> WITHIN 14 DAYS</span>
                                    </div>
                                    <div class="card-body" style="flex: 0 1 auto; overflow-y: auto;  height:350px;max-height: calc(350px - 20px - 20px);">
                                        <div class="row">
                                            <?php 
							$sql = "SELECT * FROM events WHERE Name='$uname' AND  (DATEDIFF(Start,NOW()) BETWEEN 8 AND 14)";
                			$result =$db->query($sql);
							while ($row = mysqli_fetch_array($result)) {?>
                                            <div class="col-xl-6 col-md-6 mb-4">
                                                <div class="card border-top-primary shadow" style="border-left-style: solid; border-top-width: thick; border-top-color:rgb(0, 123, 255)">
                                                    <div class="card-header">
                                                        <span class="font-weight-bold text-dark text-uppercase mb-1"><?php echo $row['Title'] ?></span><br>
                                                        <span class="text-gray text-uppercase mb-1">END : <?php echo $row['End'] ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <?php  } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        $(document).ready(function() {
            $('.editteacher').on('click', function() {
                $('#updateTeacher').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                console.log(data);
                $('#tid').val(data[0]);
                $('#tname').val(data[1]);
                $('#tsname').val(data[2]);
                $('#temail').val(data[3]);
            });
        });
    </script>
    </body>

</html>