<?php
    $nid = $_POST['nid'];
    $nteacher = $_POST['nteacher'];
    $nsubject = $_POST['nsubject'];
    $nscore = $_POST['nscore'];
    $nover = $_POST['nover'];
    $ntype = $_POST['ntype'];
    $sql = "UPDATE `grades` SET `Subject_Code`='$nsubject,`Teacher`='$nteacher',`Score`='$nscore',`Over`='$nover',`Type`=$ntype WHERE ID='$nid'";
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

?>