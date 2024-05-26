<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once('vendor/Autoload.php');
$mail = new PHPMailer();
$mail->CharSet =  "utf-8";
$mail->IsSMTP();
// enable SMTP authentication
$mail->SMTPAuth = true;                  
// GMAIL username
$mail->Username = "joshkm2441@gmail.com";
// GMAIL password
$mail->Password = "samozi2441";
$mail->SMTPSecure = "ssl";  
// sets GMAIL as the SMTP server
$mail->Host = "smtp.gmail.com";
// set the SMTP port for the GMAIL server
$mail->Port = "465";
$mail->From='joshkm2441@gmail.com';
$mail->FromName='Joshua Mutuse';
$mail->AddAddress('joshmutuse@yahoo', 'Joshua Mutuse');
$mail->Subject  =  'SMTP Mail Testing';
$mail->IsHTML(true);
$mail->Body    = 'Hi there , This is just a testing mail';
if($mail->Send())
{
	echo "Message was Successfully Send :)";
}
else
{
	echo "Mail Error - >".$mail->ErrorInfo;
}
?>