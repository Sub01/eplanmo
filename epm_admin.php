<?php
include ("assets/php/php_epm_profile.php");
include ("assets/php/php_epm_genset.php");
include ("assets/php/summary.php");

if(!isset($_SESSION['User'])){
	header("Location: index.php");
	exit();
}
else{
    $user = $_SESSION['User'];
    $data1 = '';
    $data2 = '';
    $sql = "SELECT  DATE_FORMAT(`Timestamp`,'%m-%d-%y') AS `Current`, COUNT(`ID`) AS `Total` FROM `events`  WHERE Name ='sample' GROUP BY `Current`";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result)) {

        $data1 = $data1 . '"'. $row['Current'].'",';
        $data2 = $data2 . '"'. $row['Total'] .'",';
    }
    $data1 = trim($data1,",");
    $data2 = trim($data2,",");
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>DASHBOARD</title>
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

<?php echo '<body class="page-top" style="background-image:url(data:image/jpeg;base64,'.base64_encode($gensetbackground).');background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">' ?>
<div class="wrapper d-flex">
    <nav id="sidebar" class="" style="background-color: maroon;">
        <div class="custom-menu">

        </div>
        <div class="img bg-wrap text-center py-4" style="background-image: url(images/bg_1.jpg);">
            E-PLAN MO
        </div>
        <ul class="list-unstyled components mb-5">
            <li class="active">
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
        </ul>
    </nav>
    <div id="content" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <i type="button" id="sidebarCollapse" class="fas fa-bars"></i>
                </button>
                <ul class="navbar-nav ml-auto">
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
                <!-- Content Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-xl-2 col-md-2 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2" style="border-left-style: solid; border-left-width: thick; border-left-color:rgb(0, 123, 255) ">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    TOTAL ACTIVITIES
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo $all ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-2 mb-4">
                                <div class="card border-left-secondary shadow h-100 py-2" style="border-left-style: solid; border-left-width: thick; border-left-color:rgb(108, 117, 125)">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                    ONGOING ACTIVITIES
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo $ongoing ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-2 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2" style="border-left-style: solid; border-left-width: thick; border-left-color:rgb(220, 53, 69)">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                    ENDED
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo $ended ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-8 col-md-8 mb-4">
                        <div class="card shadow h-100 py-2">
                            <div class="card-header">
                                <strong>ONGOING EVENTS</strong>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-bordered" id="table1" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden="">ID</th>
                                            <th>Event Name</th>
                                            <th>Event Type</th>
                                            <th>Mode</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Functions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                				$sql = "SELECT * FROM events WHERE Name='$username' AND Status='Ongoing'";
                				$result =$db->query($sql);
                				while ($row = mysqli_fetch_array($result)) {?>
                                        <tr>
                                            <td hidden=""><?php echo $row['ID'] ?></td>
                                            <td><?php echo $row['Title'] ?></td>
                                            <td><?php echo $row['Type'] ?></td>
                                            <td><?php echo $row['Mode'] ?></td>
                                            <td><?php echo $row['Start'] ?></td>
                                            <td><?php echo $row['End'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary editbutton" data-bs-toggle="modal" data-bs-target="#updateEvent"><i class="fas fa-edit"></i></button>
                                                <a name="archived" href="assets/php/delete_event.php?id=<?php echo $row['ID']?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this event?')"><i class="fas fa-archive"></i></a>
                                            </td>
                                        </tr>
                                        <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 mb-4">
                                <div class="card shadow h-100 py-2">
                                    <div class="card-body">
                                        <canvas id="mychart" style="width: 100%;">
                                        </canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="fixed-bottom" style="color:white; background-color: black;">
            <p>&copy; Gino Toralba & The rest of DS04 EST 2021</p>
        </footer>
    </div>






    <!--MODAL FOR UPDATE EVENT-->
    <!--===============================================================================================-->
    <div class="modal fade" id="updateEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="assets/php/update_event.php">
                        <div class="form-group">
                            <label>Event Title</label>
                            <input hidden="" name="id" id="id" value="">
                            <input type="text" name="title" id="title" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Event Type</label>
                            <input type="text" name="type" id="type" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>MODE</label>
                            <select class="form-control" name="mode" id="mode" required="" style="width:100%">
                                <option hidden>SELECT MODE</option>
                                <option value="Not School Related">Not School Related</option>
                                <option value="Asynchronous">Asynchronous</option>
                                <option value="Synchronous">Synchronous</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Event Start</label>
                            <input type="datetime-local" name="start" id="start" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Event End</label>
                            <input type="datetime-local" name="end" id="end" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="upev">Save changes</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0-rc.1/Chart.bundle.js"></script>
    <!--===============================================================================================-->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table1').DataTable({
                "autoWidth": true
            });
        });
        $(document).ready(function() {
            $('#table2').DataTable({
                "autoWidth": true
            });
        });
        $("document").ready(function() {
            setTimeout(function() {
                $("div.alert").remove();

            }, <?php echo $gensetmodclose ?>);

        });


        $(document).ready(function() {
            $('.editbutton').on('click', function() {
                $('#updateEvent').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                var dateVal = new Date(data[4]);
                var day = dateVal.getDate().toString().padStart(2, "0");
                var month = (1 + dateVal.getMonth()).toString().padStart(2, "0");
                var hour = dateVal.getHours().toString().padStart(2, "0");
                var minute = dateVal.getMinutes().toString().padStart(2, "0");
                var sec = dateVal.getSeconds().toString().padStart(2, "0");
                var ms = dateVal.getMilliseconds().toString().padStart(3, "0");
                var inputDate = dateVal.getFullYear() + "-" + (month) + "-" + (day) + "T" + (hour) + ":" + (minute) + ":" + (sec) + "." + (ms);

                var dateVal2 = new Date(data[5]);
                var day2 = dateVal2.getDate().toString().padStart(2, "0");
                var month2 = (1 + dateVal2.getMonth()).toString().padStart(2, "0");
                var hour2 = dateVal2.getHours().toString().padStart(2, "0");
                var minute2 = dateVal2.getMinutes().toString().padStart(2, "0");
                var sec2 = dateVal2.getSeconds().toString().padStart(2, "0");
                var ms2 = dateVal2.getMilliseconds().toString().padStart(3, "0");
                var inputDate2 = dateVal2.getFullYear() + "-" + (month2) + "-" + (day2) + "T" + (hour2) + ":" + (minute2) + ":" + (sec2) + "." + (ms2);

                $('#id').val(data[0]);
                $('#title').val(data[1]);
                $('#type').val(data[2]);
                $('#mode').val(data[3]);
                $('#start').val(inputDate);
                $('#end').val(inputDate2);

            });
        });
        var ctx = document.getElementById("mychart").getContext('2d');
                var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [<?php echo $data1; ?> ],
                    datasets: 
                    [{
                        label: 'Date',
                        data: [<?php echo $data1; ?>],
                        backgroundColor: 'transparent',
                        borderColor:'rgba(255,99,132)',
                        borderWidth: 3
                    },

                    {
                        label: 'Activities',
                        data: [<?php echo $data2; ?>, ],
                        backgroundColor: 'transparent',
                        borderColor:'rgba(0,255,255)',
                        borderWidth: 3  
                    }]
                },

                options: {
                    scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                    tooltips:{mode: 'index'},
                    legend:{display: false, position: 'top', labels: {fontColor: 'rgb(0,0,0)', fontSize: 16}}
                }
            });
    </script>
    </body>

</html>