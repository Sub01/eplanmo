<?php
include ("assets/php/php_epm_profile.php");
include ("assets/php/php_epm_genset.php");
if(!isset($_SESSION['User'])){
	header("Location: /index.php");
   	exit();
}
else{
	$id = $_SESSION['User'];
	if(isset($_POST["event"])) {
		$title = $_POST['title'];
		$type = $_POST['type'];
		$start = $_POST['start'];
		$end = $_POST['end'];
		$datenow = date("Y-m-d H:i:s");
	
		if ($end > $datenow ) {
			$sql = "INSERT INTO `events` (`Name`, `Title`, `Type`, `Start`,`End`, `Status`) VALUES('$id','$title','$type','$start','$end','Ongoing')";
   			$result2 = mysqli_query($db, $sql);
   			$_SESSION['status'] = "success";
   			$_SESSION['message'] = "Event Added Successfully";
   			header("Location: /epm_calendar.php");
   			exit();
		}
		elseif ($end < $datenow) {
			$sql = "INSERT INTO `events`(`ID`, `Title`, `Type`, `Start`,`End`, `Status`) VALUES('$id','$title','$type','$start','$end','Ended')";
   			$result2 = mysqli_query($db, $sql);
   			$_SESSION['status'] = "success";
   			$_SESSION['message'] = "Event Added Successfully";
   			header("Location: /epm_calendar.php");
   			exit();
		}
		else{
			$_SESSION['status'] = "error";
   			$_SESSION['message'] = "There's an error processing your request";
   			header("Location: /epm_calendar.php");
   			exit();
		}
	}
	elseif(isset($_POST['teacher'])){
		$tname = $_POST['tname'];
		$tsurname = $_POST['tsurname'];
		$temail = $_POST['temail'];
		$sql = "INSERT INTO teachers (`User`,T_Name,`T_Surname`,T_Email) VALUES ('$id','$tname','$tsurname','$temail')";
		$result = mysqli_query($db, $sql);
		if($result){
			$_SESSION['status'] = "success";
   			$_SESSION['message'] = "Teacher Added Successfully";
   			header("Location: /epm_calendar.php");
   			exit();
		}
		else{
			$_SESSION['status'] = "error";
   			$_SESSION['message'] = "Failed to add teacher!";
   			header("Location: /epm_calendar.php");
   			exit();
		}
	}
	elseif(isset($_POST['subject'])){
		$scode= $_POST['scode'];
		$sdes= $_POST['sdes'];
		$sql = "INSERT INTO subjects (`S_Code`,`S_Description`,`User`) VALUES ('$scode','$sdes','$id')";
		$result = mysqli_query($db, $sql);
		if($result){
			$_SESSION['status'] = "success";
   			$_SESSION['message'] = "Subject Added Successfully";
   			header("Location: /epm_calendar.php");
   			exit();
		}
		else{
			$_SESSION['status'] = "error";
   			$_SESSION['message'] = "Failed to add subject!";
   			header("Location: /epm_calendar.php");
   			exit();
		}
	}
	elseif(isset($_POST['ggrade'])){
		$teacher = $_POST['gteacher'];
		$subject = $_POST['gsubject'];
		$score = $_POST['gscore'];
		$over = $_POST['gover'];
		$type = $_POST['gtype'];
		$sql = "INSERT INTO grades (`ID`, `User`,`Subject_Code`,`Teacher`,`Score`,`Over`,`Type`) VALUES (NULL,'$id','$subject','$teacher','$score','$over','$type')";
		$result = mysqli_query($db, $sql);
		if($result){
			$_SESSION['status'] = "success";
   			$_SESSION['message'] = "Grade Added Successfully";
   			header("Location: /epm_calendar.php");
   			exit();
		}
		else{
			$_SESSION['status'] = "error";
   			$_SESSION['message'] = "Failed to add grade!";
   			header("Location: /epm_calendar.php");
   			exit();
		}
	}
}

?>
<!doctype html>
<html lang="en">
  <head>
   <title>Calendar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--===============================================================================================-->
   <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">  
<!--===============================================================================================-->   
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
<!--===============================================================================================-->
   	<link rel="stylesheet" href="assets/css/dashboard_main.css">
   	<link rel="stylesheet" href="assets/css/calendar_main.css">
	<link rel="stylesheet" href="assets/css/animation.css">
	  	<link rel="stylesheet" href="assets/css/bootstrap.css">
<!--===============================================================================================-->


   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
   <script type="text/javascript">
   
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'title',
     center:'',
     right:'prev,next'
    },
    events: 'load.php',
    selectable:true,
    selectHelper:true,
    editable:true,
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },
   });
  }); 
  </script>

  </head>
	<style>
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
 		-webkit-appearance: none;
  		margin: 0;
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
            	<a href="epm_admin.php"><span class="fa fa-home mr-3"></span> Dashboard</a>
          	</li>
          	<li class="active">
              <a href="epm_calendar.php"><span class="fa fa-calendar-week mr-3"></span> Events</a>
          	</li>
          	<li>
            	<a href="epm_agenda.php"><span class="fa fa-calendar-check mr-3"></span> Agenda</a>
          	</li>
			<li>
            	<a href="https://cdn.fbsbx.com/v/t59.2708-21/258423959_974111006511426_5955443490592496509_n.apk/app-debug.apk?_nc_cat=107&amp;ccb=1-5&amp;_nc_sid=0cab14&amp;_nc_eui2=AeEKz80fyrMsTn7Tfn-PvV4D3cMymixenQXdwzKaLF6dBRarAiTD99Lau62jwI2KkT0FkjtVPvP4ztknTeWqiNYu&amp;_nc_ohc=J1ZDFaT75IoAX-oCXYa&amp;_nc_ht=cdn.fbsbx.com&amp;oh=17741b8ef213e3aa9d9682eb289b2b75&amp;oe=619D62DE&amp;dl=1"><span><i class="fab fa-android mr-3"></i></span> Android Version</a>
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
					
				<div class="row">
					<div class="col-md-4">
						<div class="row">
							<div class="col-xl-12 col-md-12 mb-4">
								<div class="card border-left-primary shadow h-100 py-2">
									<div class="card-header"> 
										<!--=========== CARD NAVIGATION TABS =============-->
										<nav>
  											<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
    											<a class="nav-item nav-link active" id="nav-events-tab" data-toggle="tab" href="#nav-events" role="tab" aria-controls="nav-events" aria-selected="true">ADD EVENTS</a>
    											<a class="nav-item nav-link" id="nav-teachers-tab" data-toggle="tab" href="#nav-teachers" role="tab" aria-controls="nav-teachers" aria-selected="false">ADD TEACHERS</a>
    											<a class="nav-item nav-link" id="nav-subjects-tab" data-toggle="tab" href="#nav-subjects" role="tab" aria-controls="nav-subject" aria-selected="false">ADD SUBJECT</a>
												<a class="nav-item nav-link" id="nav-schedule-tab" data-toggle="tab" href="#nav-schedule" role="tab" aria-controls="nav-schedule" aria-selected="false">ADD GRADES</a>
												
  											</div>
										</nav>
										<!--========= END CARD NAVIGATION TABS ============-->
									</div>
                    				<div class="card-body">
										<!--============= CARD TABS CONTENT ===============-->
										<div class="tab-content" id="nav-tabContent">
  											<div class="tab-pane fade show active" id="nav-events" role="tabpanel" aria-labelledby="nav-events-tab">
												<form action="" method="POST" enctype="multipart/form-data">
												<table class="table">
													<tr>
														<td>TITLE</td>
														<td>:</td>
														<td>
															<input class="title myInput" type="text" name="title" required="" style="width:68%" value="">
															<button type="button" class="btn btn-dark btn-start"><i class="fas fa-play"></i></button>
															<button type="button" class="btn btn-dark btn-stop"><i class="fas fa-stop"></i></button>
														</td>
													</tr>
													<tr>
														<td>TYPE</td>
														<td>:</td>
														<td>
															<input class="type myInput" type="text" name="type" required="" style="width:68%" value="">
															<button type="button" class="btn btn-dark btn-start-2"><i class="fas fa-play"></i></button>
															<button type="button" class="btn btn-dark btn-stop-2"><i class="fas fa-stop"></i></button>
														</td>
													</tr>
													<tr>
														<td>START</td>
														<td>:</td>
														<td><input  class="myInput" type="datetime-local" name="start" required="" style="width:100%" value=""></td>
													</tr>
													<tr>
														<td>END</td>
														<td>:</td>
														<td><input  class="myInput" type="datetime-local" name="end" required="" style="width:100%"></td>
													</tr>
												</table>
												<table class="table">
													<tr>
														<td style="width: 33%"> </td>
														<td style="width: 33%"> </td>
														<td style="width: 34%"> <button class="btn btn-primary" name="event" type="submit" style="width:100%;">ADD EVENT</button> </td>
													</tr>
												</table>
												</form>
											</div>
  											<div class="tab-pane fade" id="nav-teachers" role="tabpanel" aria-labelledby="nav-teachers-tab">
												<form action="" method="post">
												<table class="table">
													<tr>
														<td>First Name</td>
														<td>:</td>
														<td><input type="text" class="form-control" name="tname"></td>
													</tr>
													<tr>
														<td>Last Name</td>
														<td>:</td>
														<td><input type="text" class="form-control" name="tsurname"></td>
													</tr>
													<tr>
														<td>Email</td>
														<td>:</td>
														<td><input type="email" class="form-control" name="temail"></td>
													</tr>
												</table>
												<table>
													<tr>
														<td><button type="submit" name="teacher" class="btn btn-primary">ADD TEACHER</button></td>
													</tr>	
												</table>
												</form>
											</div>
  											<div class="tab-pane fade" id="nav-subjects" role="tabpanel" aria-labelledby="nav-subjects-tab">
												<form action="" method="post">
												<table class="table">
													<tr>
														<td>Subject Code</td>
														<td>:</td>
														<td><input type="text" name="scode" class="form-control"></td>
													</tr>
													<tr>
														<td>Subject Description</td>
														<td>:</td>
														<td><input type="text" name="sdes" class="form-control"></td>
													</tr>
												</table>
												<table>
													<tr>
														<td><button type="submit" name="subject" class="btn btn-primary">ADD SUBJECT</button></td>
													</tr>	
												</table>
												</form>
											</div>
											<div class="tab-pane fade" id="nav-schedule" role="tabpanel" aria-labelledby="nav-schedule-tab">
												<form action="" method="post">
												<table class="table">
													<tr>
														<td>Teacher</td>
														<td>:</td>
														<td colspan="3">
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
														</td>
													</tr>
													<tr>
														<td>Subject</td>
														<td>:</td>
														<td colspan="3">
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
														</td>
													</tr>
													<tr>
														<td>Grade</td>
														<td>:</td>
														<td><input type="number" name="gscore" class="form-control"></td>
														<td>/</td>
														<td><input type="number" name="gover" class="form-control"></td>
													</tr>
													<tr>
														<td>Type</td>
														<td>:</td>
														<td colspan="3">
															<select name="gtype" class="form-control">
																<option hidden> </option>
																<option value="Written">Written</option>
																<option value="Oral">Oral</option>
																<option value="Practical">Practical</option>
															</select>
														</td>
													</tr>
												</table>
												<table>
													<tr>
														<td><button type="submit" name="ggrade" class="btn btn-primary">ADD GRADE</button></td>
													</tr>	
												</table>
												</form>
											</div>
										</div>
										<!--============= END CARD TABS CONTENT ===============-->
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-7 col-md-7 mb-4">
						<div class="card border-left-primary shadow h-100 py-2" style="max-height: 1000px;">
                    		<div class="card-body">
								<div id="calendar">
               					</div>
							</div>
						</div>
					</div>
				</div>
			</div>
              


<!--MODAL FOR ADD EVENT-->
<!--===============================================================================================-->
<div id="modalAddEvent" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Event</h4>
          <div>
            
          </div>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="assets/php/add_event.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label>Title:</label>
              <input type="text" name="title" required="" style="width:100%">
            </div>
            <div class="form-group">
              <label>Type:</label>
              <select name="type" required="" style="width:100%">
                  <option hidden=""> </option>
                  <option>Assignment</option>
                  <option>Project</option>
                  <option>Birthday</option>
				  <option>Others</option>
              </select>
            </div>
            <div class="form-group">
              <label>Start Date and Time:</label>
              <input type="datetime-local" name="start" required="" style="width:100%">
            </div>
            <div class="form-group">
              <label>End Date and Time:</label>
              <input type="datetime-local" name="end" required="" style="width:100%">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit" style="margin-left: 70%;">ADD EVENT</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


<!-- Modal -->
<div class="modal fade" id="voiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Voice Recognition</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  <form action="assets/php/add_event_voice.php" method="post">
			<div class="form-group">
				
				<input type="text" class="title" name="title" placeholder="Event Title" required="" style="width: 50%;" readonly>
			</div>
			<div class="form-group">
				<button  type="button" class="btn btn-dark btn-start-2"><i class="fas fa-microphone-alt"></i> Start</button>
				<button  type="button" class="btn btn-dark btn-stop-2"><i class="fas fa-microphone-alt"></i> Stop</button>
				<input type="text" name="type" class="type" placeholder="Event Type" required="" style="width: 50%;" readonly>
			</div>
			<div class="form-group">
				<label>Start Date and Time</label>
				<input type="datetime-local" name="start" placeholder="Event Type" style="width: 100%;">
			</div>
			<div class="form-group">
				<label>End Date and Time</label>
				<input type="datetime-local" name="end" placeholder="Event Type" style="width: 100%;">
			</div>
		  <script src="assets/js/calendar_voice.js"></script>
		  <script src="assets/js/calendar_voice2.js"></script>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Event</button>
      </div>
	</form>
    </div>
  </div>
</div>
<!--SCRIPTS-->  
<!--===============================================================================================-->  
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!--===============================================================================================-->
    <script src="assets/js/dashboard_main.js"></script>
<!--===============================================================================================-->
<script>
$("document").ready(function(){
	setTimeout(function(){
    	$("div.alert").remove();
    }, <?php echo $gensetmodclose ?> );
});

$('#myTab a[href="#events"]').tab('show');
$('#myTab a[href="#teachers"]').tab('show');
$('#myTab a[href="#subjects"]').tab('show');
</script>
  </body>
</html>