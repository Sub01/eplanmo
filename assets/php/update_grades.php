<?php
session_start();

if(isset($_POST["update"])){
    $id = $_POST['id'];
    $teacher = $_POST['teacher'];
    $subject = $_POST['subject'];
    $score = $_POST['score'];
    $over = $_POST['over'];
    $type = $_POST['type'];
    $sql = "UPDATE `grades` SET `Subject_Code`='$subject,`Teacher`='$teacher',`Score`='$score',`Over`='$over',`Type`=$type WHERE ID='$id'";
    $result = $db->query($sql);
    if($result){
			$_SESSION['status'] = "success";
   			$_SESSION['message'] = "Grade Successfully Updated";
   			header("Location: /epm_grades.php");
   			exit();
    }
    else{
			$_SESSION['status'] = "error";
   			$_SESSION['message'] = "Failed to Update Grade!";
   			header("Location: /epm_grades.php");
   			exit();
		}
}
?>