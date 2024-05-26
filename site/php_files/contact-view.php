<?php
ini_set("SMTP",'myserver');
ini_set("SMTP","mail.gmail.com");
ini_set("smtp_port",465);
ini_set("sendmail_from", "joshkm2441@gmail.com");
$headers = "MIME-Version: 1.0"."\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once "vendor/autoload.php";
require_once  "vendor/PHPMailer/PHPMailer/src/Exception.php";
require_once  "vendor/PHPMailer/PHPMailer/src/PHPMailer.php";
require_once  "vendor/PHPMailer/PHPMailer/src/SMTP.php";
require_once "mail.php";

$mail = new PHPMailer(true);

$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];

try{
    $mail->SMTPDbug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Username = 'joshkm2441@gmail.com';   //username
    $mail->Password = 'samozi2441';   //password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;                    //smtp port

    $mail->setFrom('joshkm2441@gmail.com', 'Joshua Mutuse');
    $mail->addAddress('joshmutuse@yahoo.com', 'Joshua Mutuse');
    $mail->addReplyTo('joshkm2441@gmail.com', 'Sender Name');

    //$mail->addAttachment(__DIR__ . '/attachment1.png');
    //$mail->addAttachment(__DIR__ . '/attachment2.png');

    $mail->isHTML(true);
    $mail->Subject = 'Email Subject';
    $mail->Body    = '<b>Email Body</b>';
    $mail->AltBody = 'Plain text meessage body for non-HTML email client. Gmail SMTP email body.';
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
}

?>
<?php
//require_once('mail.php');
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	//echo "error; you need to submit the form!";

$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];
}
//Validate first
if(empty($name)||empty($visitor_email))
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}
?>
<?php
$email_from = 'joshkm2441@gmail.com';
//<== update the email address
$email_subject = "modal_feedback";
$email_body = "You have received a new message from the user $name.\r\n".
    "Here is the message:\r\n $message".

$to = "joshuamutuse970@gmail.com";
//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
  echo "Thank you for your email.";
//header('Location: thank-you.html');



// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}

?>
*/
