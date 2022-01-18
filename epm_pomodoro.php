<?php
include ("assets/php/php_epm_profile.php");
include ("assets/php/php_epm_genset.php");
include ("assets/php/summary.php");

if(!isset($_SESSION['User'])){
	header("Location: index.php");
	exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
   <title>POMODORO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link rel="stylesheet" href="assets/css/animation.css">
	<link rel="stylesheet" href="assets/css/summary.css">
	<link rel="stylesheet" href="assets/css/chart.css">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/general.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/pomodoro.css">


  </head>
  
<?php echo '<body class="page-top" style="background-image:url(data:image/jpeg;base64,'.base64_encode($gensetbackground).');background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">' ?>    
<div class="wrapper d-flex">
	<nav id="sidebar" class="" style="background-color: maroon;">
		<div class="custom-menu">
			
        </div>
	  	<div class="img bg-wrap text-center py-4">
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
            <li class="active">
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
                        <div class="col-lg-1 col-md-1 col-sm-1">
                        
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <div class="row">
                                <div id="timer">
                                    <div id="time">
                                        <span id="minutes">25</span>
                                        <span id="colon">:</span>
                                        <span id="seconds">00</span>
                                    </div>
                                    <div id="filler"></div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <table class="table" style="table-layout:fixed !important">
                                    <tr>
                                        <td><button id="work" class="form-control btn btn-sm btn-primary">Start</button></td>
                                        <td><button id="short-break" class="form-control btn btn-sm btn-success">Short Break</button></td>
                                        <td><button id="long-break" class="form-control btn btn-sm btn-success">Long Break</button></td>
                                        <td><button id="stop" class="form-control btn btn-sm btn-danger">Stop</button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1">
                        
                        </div>
                    </div>
                </div>
			</div>
<footer class="fixed-bottom" style="color:white; background-color: black;">
	<p>&copy; Gino Toralba & The rest of DS04 EST 2021</p>
</footer>
</div>
<!--SCRIPTS-->  
<!--===============================================================================================-->  
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!--===============================================================================================-->
<script src="assets/js/dashboard_main.js"></script>
<!--===============================================================================================-->

<script>
var pomodoro = {
    started : false,
    minutes : 0,
    seconds : 0,
    fillerHeight : 0,
    fillerIncrement : 0,
    interval : null,
    minutesDom : null,
    secondsDom : null,
    fillerDom : null,
    init : function(){
      var self = this;
      this.minutesDom = document.querySelector('#minutes');
      this.secondsDom = document.querySelector('#seconds');
      this.fillerDom = document.querySelector('#filler');
      this.interval = setInterval(function(){
        self.intervalCallback.apply(self);
      }, 1000);
      document.querySelector('#work').onclick = function(){
        self.startWork.apply(self);
      };
      document.querySelector('#short-break').onclick = function(){
        self.startShortBreak.apply(self);
      };
      document.querySelector('#long-break').onclick = function(){
        self.startLongBreak.apply(self);
      };
      document.querySelector('#stop').onclick = function(){
        self.stopTimer.apply(self);
      };
    },
    resetVariables : function(mins, secs, started){
      this.minutes = mins;
      this.seconds = secs;
      this.started = started;
      this.fillerIncrement = 200/(this.minutes*60);
      this.fillerHeight = 0;  
    },
    startWork: function() {
      this.resetVariables(25, 0, true);
    },
    startShortBreak : function(){
      this.resetVariables(5, 0, true);
    },
    startLongBreak : function(){
      this.resetVariables(15, 0, true);
    },
    stopTimer : function(){
      this.resetVariables(25, 0, false);
      this.updateDom();
    },
    toDoubleDigit : function(num){
      if(num < 10) {
        return "0" + parseInt(num, 10);
      }
      return num;
    },
    updateDom : function(){
      this.minutesDom.innerHTML = this.toDoubleDigit(this.minutes);
      this.secondsDom.innerHTML = this.toDoubleDigit(this.seconds);
      this.fillerHeight = this.fillerHeight + this.fillerIncrement;
      this.fillerDom.style.height = this.fillerHeight + 'px';
    },
    intervalCallback : function(){
      if(!this.started) return false;
      if(this.seconds == 0) {
        if(this.minutes == 0) {
          this.timerComplete();
          return;
        }
        this.seconds = 59;
        this.minutes--;
      } else {
        this.seconds--;
      }
      this.updateDom();
    },
    timerComplete : function(){
      this.started = false;
      this.fillerHeight = 0;
    }
};
window.onload = function(){
  pomodoro.init();
};
</script>
  </body>
</html>