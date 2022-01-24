<?php 
$sql = "SELECT * FROM users WHERE Email='$email'";
$result = $db-> query($sql);
if ($result-> num_rows >0) {
    $row = mysqli_fetch_assoc($result);
		
	$name = $row['Name'];
	$surname = $row['Surname'];
	$code = $row['Code'];
		
	//==========================  INSTANTIATE MAILER
	$mail = new PHPMailer(true);
	$mail->isHTML(true);
	$mail->isSMTP();
	$mail->CharSet = "utf-8";
		
	//==========================  GOOGLE ACCOUNT CREDENTIALS
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = "true";
	$mail->Username = "mh.tokio@gmail.com";
	$mail->Password = "cwovxtcdrzoxjmmp";
	$mail->SMTPSecure = "ssl";
	$mail->Port = "465";
		
	//==========================  EMAIL INFORMATIONS
	$mail->setFrom("mh.tokio@gmail.com","E-Plan Mo");
	$newname = $name. " " .$surname;
	$mail->addAddress("$email", $name);
		
	$email_template = 'epm_mail_template.html';
	$message = file_get_contents($email_template);
	$message = str_replace('%user%', $newname, $message);
	$message = str_replace('%code%', $code, $message);
		
	$mail->msgHTML($message);
		
	if($mail->send()){
		$script = "<script> $(document).ready(function(){ $('#modalResendSuccess').modal('show'); }); </script>";
	}else{
		$script = "<script> $(document).ready(function(){ $('#modalResendFailed').modal('show'); }); </script>";
	}
}

?>