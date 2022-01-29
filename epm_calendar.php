<?php
include ("assets/php/php_epm_profile.php");
include ("assets/php/php_epm_genset.php");
if(!isset($_SESSION['User'])){
	header("Location: https://eplanmo.herokuapp.com/index.php");
   	exit();
}
else{
	$id = $_SESSION['User'];
	if(isset($_POST["event"])) {
		$title = $_POST['title'];
		$type = $_POST['type'];
        $mode = $_POST['mode'];
		$start = $_POST['start'];
		$end = $_POST['end'];
		$datenow = date("Y-m-d H:i:s");
		if ($end > $datenow ) {
            $sql = "INSERT INTO `events`(`Name`, `Title`, `Type`, `Mode`,`Start`, `End`, `Status`, `Timestamp`, `Contact`, `SMS_Code`) VALUES ('$id','$title','$type','$mode','$start','$end','Ongoing','$datenow','$contact','0')";
   			$result2 = mysqli_query($db, $sql);
   			$_SESSION['status'] = "success";
   			$_SESSION['message'] = "Event Added Successfully";
   			header("Location: https://eplanmo.herokuapp.com/epm_calendar.php");
   			exit();
		}
		elseif ($end < $datenow) {
			$sql = "INSERT INTO `events`(`Name`, `Title`, `Type`,`Mode` ,`Start`, `End`, `Status`, `Timestamp`, `Contact`, `SMS_Code`) VALUES ('$id','$title','$type','$mode','$start','$end','Ended','$datenow','$contact','0')";
   			$result2 = mysqli_query($db, $sql);
   			$_SESSION['status'] = "success";
   			$_SESSION['message'] = "Event Added Successfully";
   			header("Location: https://eplanmo.herokuapp.com/epm_calendar.php");
   			exit();
		}
		else{
			$_SESSION['status'] = "error";
   			$_SESSION['message'] = "There's an error processing your request";
   			header("Location: https://eplanmo.herokuapp.com/epm_calendar.php");
   			exit();
		}
	}
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>CALENDAR</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">



    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1739375817606067" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next,today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                navLinks: true, // can click day/week names to navigate views
                dayMaxEvents: true, // allow "more" link when too many events
                events: 'load.php',
            });
            calendar.render();
        });
    </script>

</head>
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    @media screen and (max-width:767px) {
        .fc-toolbar.fc-header-toolbar {
            font-size: 60%
        }
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
                <a href="https://eplanmo.herokuapp.com/epm_admin.php"><span class="fas fa-home mr-3"></span> Dashboard</a>
            </li>
            <li class="active">
                <a href="https://eplanmo.herokuapp.com/epm_calendar.php"><span class="fas fa-calendar-week mr-3"></span> Calendar</a>
            </li>
            <li>
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
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <?php 
                                $sql = "SELECT COUNT(ID) as Counter FROM notif WHERE Name='$user' AND Status='0'";
                                $result = $db->query($sql);
                                $row = mysqli_fetch_assoc($result);
                                $counter = $row['Counter'];
                                ?>
                            <span class="badge badge-danger badge-counter"><?php echo $counter ?></span>
                        </a>
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Notifications
                            </h6>
                            <?php 
                                $sql2 = "SELECT * FROM notif WHERE Name='$user' AND Status='0' ORDER BY ID DESC";
                                $result2 = $db->query($sql2);
                                while($row2 = mysqli_fetch_assoc($result2)){
                                ?>
                            <a class="dropdown-item d-flex align-items-center" href="assets/php/update_notif_calendar.php?id=<?php echo $row2['ID']?>">
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
                    <div class="col-lg-5 col-md-5 col-sm-5">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 mb-4">
                                <div class="card shadow h-100">
                                    <div class="card-header">
                                        ADD EVENTS
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>TITLE</label>
                                                <button type="button" class="btn btn-dark btn-sm btn-start"><i class="fas fa-play"></i></button>
                                                <button type="button" class="btn btn-dark btn-sm btn-stop"><i class="fas fa-stop"></i></button>
                                                <input class="myInput title form-control" type="text" name="title" required="" style="width:100%">
                                            </div>
                                            <div class="form-group">
                                                <label>TYPE</label>
                                                <button type="button" class="btn btn-dark btn-sm btn-start-2"><i class="fas fa-play"></i></button>
                                                <button type="button" class="btn btn-dark btn-sm btn-stop-2"><i class="fas fa-stop"></i></button>
                                                <input class="myInput type form-control" type="text" name="type" required="" style="width:100%">
                                            </div>
                                            <div class="form-group">
                                                <label>MODE</label>
                                                <select class="myInput type form-control" name="mode" required="" style="width:100%">
                                                    <option hidden>SELECT MODE</option>
                                                    <option value="Not School Related">Not School Related</option>
                                                    <option value="Asynchronous">Asynchronous</option>
                                                    <option value="Synchronous">Synchronous</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>START</label>
                                                <input class="myInput form-control" type="datetime-local" name="start" required="" style="width:100%" value="" id="date1">
                                            </div>
                                            <div class="form-group">
                                                <label>END</label>
                                                <input class="myInput form-control" type="datetime-local" name="end" required="" style="width:100%" value="">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-sm" name="event" type="submit" style="width:100%">ADD EVENT</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-md-7 col-sm-7 mb-4">
                        <div class="card shadow h-100 py-2" style="max-height: 1000px;">
                            <div class="card-header" id="calendar" style="overflow-x:auto;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--SCRIPTS-->
            <!--===============================================================================================-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
            <!--===============================================================================================-->
            <script src="assets/js/dashboard_main.js"></script>
            <script src="assets/js/calendar_voice.js"></script>
            <script src="assets/js/calendar_voice2.js"></script>

            <!--===============================================================================================-->
            <script>
                $("document").ready(function() {
                    setTimeout(function() {
                        $("div.alert").remove();
                    }, <?php echo $gensetmodclose ?>);
                });
                flatpickr("input[type=datetime-local]", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    minDate: "today"
                });
                
            </script>
            </body>

</html>