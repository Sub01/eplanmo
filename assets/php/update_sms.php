<?php
include 'config.php';
session_start();
//##########################################################################
// ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
// Visit www.itexmo.com/developers.php for more info about this API
//##########################################################################
function itexmo($number,$message,$apicode,$passwd){
        $url = 'https://www.itexmo.com/php_api/api.php';
        $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );
        $context  = stream_context_create($param);
        return file_get_contents($url, false, $context);
}
//##########################################################################


$sql = "SELECT *, DATEDIFF(`Start`,NOW()) as Comp FROM `events` WHERE SMS_Code='1'";
$result = $db->query($sql);
while($row = mysqli_fetch_assoc($result)){
    $contact = $row['Contact'];
    $message = "Hi There! " .$row['Name']. ", Your Event ". $row['Title']. "is ".$row['Comp']." days away"
    $sent = itexmo($contact,$message,'TR-FEITA551619_PCMVG','uwxe7mqr28');
    $sql2 = "UPDATE events SET SMS_Code=0 WHERE Contact='$contact'";
    $result2 = $db->query($sql2);
    exit();
}
?>