<?php
include ("assets/php/php_epm_profile.php");
include ("assets/php/php_epm_genset.php");
include ("assets/php/summary.php");

if(!isset($_SESSION["User"])){
	header("Location: https://eplanmo.herokuapp.com/epm_login.php");
	exit();
}	
else{
    $id = $_SESSION['User'];
    if(isset($_POST['update'])){
		$teacher = $_POST['gteacher'];
		$subject = $_POST['gsubject'];
		$score = $_POST['gscore'];
		$over = $_POST['gover'];
		$type = $_POST['gtype'];
        if($score>$over){
            $_SESSION['status'] = "error";
   			$_SESSION['message'] = "Score should not be higher than the number of items";
   			header("Location: https://eplanmo.herokuapp.com/epm_grades.php");
   			exit();
        }
        else{
            $sql = "INSERT INTO grades (`User`,`Subject_Code`,`Teacher`,`Score`,`Over`,`Type`) VALUES ('$id','$subject','$teacher','$score','$over','$type')";
            $result = mysqli_query($db, $sql);
            if($result){
                $_SESSION['status'] = "success";
   	            $_SESSION['message'] = "Grade Added Successfully";
   	            header("Location: https://eplanmo.herokuapp.com/epm_grades.php");
   	            exit();
            }
            else{
                $_SESSION['status'] = "error";
   	            $_SESSION['message'] = "Failed to add grade!";
   	            header("Location: https://eplanmo.herokuapp.com/epm_grades.php");
   	            exit();
            }
        }
	}
}
?>
<!doctype html>
<html>

<head>
    <title>GRADES</title>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
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
            <li>
                <a href="https://eplanmo.herokuapp.com/epm_agenda.php"><span class="fas fa-calendar-check mr-3"></span> Agenda</a>
            </li>
            <li>
                <a href="https://eplanmo.herokuapp.com/epm_teachers.php"><span class="fas fa-chalkboard-teacher mr-3"></span> Teachers</a>
            </li>
            <li>
                <a href="https://eplanmo.herokuapp.com/epm_subjects.php"><span class="fas fa-book mr-3"></span> Subjects</a>
            </li>
            <li class="active">
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
                                <a class="dropdown-item d-flex align-items-center" href="assets/php/update_notif_grades.php?id=<?php echo $row2['ID']?>">
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
                    <div class="col-xl-12 col-md-12 mb-4">
                        <div class="card shadow h-100 py-2">
                            <div class="card-header">
                                <button class="btn btn-primary btn-sm" style="margin:5px;" data-toggle="modal" data-target="#addGrade"><i class="fas fa-plus"></i> ADD GRADES</button>
                            </div>
                            <div class="card-body" style="overflow-x:auto;">
                                <table class="table table-bordered" id="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th hidden>ID</th>
                                            <th>SUBJECT CODE</th>
                                            <th>TEACHER</th>
                                            <th>TYPE</th>
                                            <th>SCORE</th>
                                            <th>ITEMS</th>
                                            <th>GRADE</th>
                                            <th>STATUS</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $sql = "SELECT * FROM grades WHERE User='$username'";
                                    $result =$db->query($sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                    $score = $row['Score'];
		                            $over = $row['Over'];
                                    $percentage = (($row['Score']/$row['Over']) * 50 + 50);
                                    ?>
                                        <tr>
                                            <td hidden><?php echo $row['ID'] ?></td>
                                            <td><?php echo $row['Subject_Code'] ?></td>
                                            <td><?php echo $row['Teacher'] ?></td>
                                            <td><?php echo $row['Type'] ?></td>
                                            <td><?php echo $row['Score'] ?></td>
                                            <td><?php echo $row['Over'] ?></td>
                                            <td><?php echo  round($percentage,1) ?>%</td>
                                            <td>
                                                <?php if($percentage >= 75): ?>
                                                <h6 class="bg-success" style="border-radius:10px; text-align:center; color:white;">PASS</h6>
                                                <?php elseif ($percentage <= 74):?>
                                                <h6 class="bg-danger" style="border-radius:10px; text-align:center; color:white;">FAILED</h6>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="assets/php/delete_grades.php?id=<?php echo $row['ID'] ?>" onclick="return confirm('Are you sure you want to delete this grade?')"><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></a>
                                            </td>
                                        </tr>
                                        <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="addGrade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Teacher</label>
                                <select class="form-control" name="gteacher">
                                    <option hidden> </option>
                                    <?php
				 $name = $_SESSION['User'];
				 $ssql = "SELECT * FROM `teachers` WHERE `User`='$name'";
				 $sresult = $db-> query($ssql);
				 while($srow = mysqli_fetch_array($sresult)){ ?>
                                    <option value="<?php echo $srow['T_Name']?> <?php echo $srow['T_Surname']?>"><?php echo $srow['T_Name']?> <?php echo $srow['T_Surname']?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Subject</label>
                                <select class="form-control" name="gsubject">
                                    <option hidden> </option>
                                    <?php
				$name = $_SESSION['User'];
				$ssql = "SELECT * FROM `subjects` WHERE `User`='$name'";
				$sresult = $db-> query($ssql);
				while($srow = mysqli_fetch_array($sresult)){ ?>
                                    <option value="<?php echo $srow['S_Code']?>"><?php echo $srow['S_Code']?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Scores</label>
                                        <input class="form-control" type="number" name="gscore" value="" required="">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Items</label>
                                        <input class="form-control" type="number" name="gover" value="" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select name="gtype" class="form-control">
                                    <option hidden> </option>
                                    <option value="Written">Written</option>
                                    <option value="Oral">Oral</option>
                                    <option value="Practical">Practical</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="form-control" type="submit" class="btn btn-primary" name="update" style="background-color: blue; color:white;">ADD</button>
                            </div>

                        </div>
                    </form>
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
        <!--===============================================================================================-->
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#table').DataTable({
                    "autoWidth": true
                });
            });
            $(document).ready(function() {
                $('.editgrade').on('click', function() {
                    $('#updateGrades').modal('show');
                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();
                    console.log(data);
                    $('#nid').val(data[0]);
                    $('#nteacher').val(data[2]);
                    $('#nsubject').val(data[1]);
                    $('#nscore').val(data[4]);
                    $('#nover').val(data[5]);
                    $('#ntype').val(data[3]);
                });
            });
            $("document").ready(function() {
                setTimeout(function() {
                    $("div.alert").remove();
                }, <?php echo $gensetmodclose ?>);
            });

        </script>




        </body>

</html>
