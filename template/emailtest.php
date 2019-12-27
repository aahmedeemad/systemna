<?php 
$pageTitle = "SYSTEMNA | Email Test";
include "../template/header.php"; 

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Include the Composer generated autoload.php file. */
require '../composer/vendor/autoload.php';

/* Set the script time zone to UTC. */
date_default_timezone_set('Etc/UTC');

/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$mail = new PHPMailer(TRUE);

$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);

/* Open the try/catch block. */
try {
   /* Set the mail sender. */
   $mail->setFrom('systemnamiu@gmail.com', 'A.Emad from SYSTEMNA');

   /* Add a recipient. */
   $mail->addAddress('ahmed3madeldin@gmail.com', 'xXxN00bMaster69xXx');

   /* Set the subject. */
   $mail->Subject = 'SPAM TIME!';

   /* Set the mail message body. */
   $mail->Body = 'I will spam the hell out of you :)';

   /* Use SMTP. */
   $mail->isSMTP();

   /* Google (Gmail) SMTP server. */
   $mail->Host = 'smtp.gmail.com';

   /* SMTP port. */
   $mail->Port = 587;

   /* Set authentication. */
   $mail->SMTPAuth = true;
   $mail->SMTPSecure = 'tls';

   /* Username (email address). */
   $mail->Username = 'systemnamiu@gmail.com';

   /* Google account password. */
   $mail->Password = 'tpwvzpocyggbhmlr';

   /* Send the mail. */
   $mail->send();

   /* Prints message after mail is sent. */
   echo 'Success';
}
catch (Exception $e)
{
   /* PHPMailer exception. */
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   /* PHP exception (note the backslash to select the global namespace Exception class). */
   echo $e->getMessage();
}

include "../template/footer.php";
?>